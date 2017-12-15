<?php

/**
 * Generates user-friendly subscription info, depending on the passed subscription
 * status.
 */
class GC_Subscription_Info{
	
	protected $subscription;
	protected $plan;
	protected $in_beta;
	
	public function __construct($subscription){
		$this->subscription = $subscription;
		$this->plan = $subscription->plan;
		$this->in_beta = GC_Version::is_in_beta();
	}
	
	public function generate(){
		$status = $this->subscription->status;
		
		$info = array(
			array('label' => __('Status', 'grid-canvas-pinterest'), 'value' => $this->get_status_text()),
			array('label' => __('Plan name', 'grid-canvas-pinterest'), 'value' => $this->plan->name)
		);
		
		$price = $this->get_price();
		if($price){
			$info[] =array('label' => __('Price', 'grid-canvas-pinterest'), 'value' => $price);
		}
		
		if(!$this->is_inactive()){
			$info[]= array(
				'label' => __('Generations', 'grid-canvas-pinterest'), 
				'value' => $this->subscription->generations_used.' used of '.$this->plan->generations
			);
		}
		
		if($status == 'trialing' && !$this->in_beta){
			$trial_end = new DateTime($this->subscription->trial_end);
			$trial_end = $trial_end->format(get_option('date_format'));
			$info[]= array('label' => __('Trial ends', 'grid-canvas-pinterest'), 'value'=>$trial_end);
		}
		
		if($status == 'active' || $this->in_beta){
			$info[]= array(
				'label' => __('Generations will reset on', 'grid-canvas-pinterest'), 
				'value' => $this->get_current_period_end_text());
		}elseif($this->is_canceled_but_active()){
			$info[]= array(
				'label' => __('Subscription period ends', 'grid-canvas-pinterest'), 
				'value' => $this->get_current_period_end_text());
		}
		
		return $info;
	}
	
	protected function get_price(){
		if($this->in_beta){
			return __('Free while in beta', 'grid-canvas-pinterest');
		}
		
		if(in_array($this->subscription->status, array('canceled', 'trialing'))){
			//no need to display price to the trialing and canceled subscriptions
			//when not in beta
			return false;
		}
		
		return sprintf("$%s / %s", $this->plan->price, $this->plan->interval);
	}
	
	protected function is_inactive(){
		if($this->subscription->status == 'canceled'){
			$now = new DateTime();
			$current_period_end = new DateTime($this->subscription->current_period_end);
			if($current_period_end < $now){
				return true;
			}
		}
		return false;
	}
	
	protected function is_canceled_but_active(){
		if($this->subscription->status == 'canceled'){
			$now = new DateTime();
			$current_period_end = new DateTime($this->subscription->current_period_end);
			if($current_period_end > $now){
				return true;
			}
		}
		return false;
	}
	
	protected function get_current_period_end_text(){
		$current_period_end = new DateTime($this->subscription->current_period_end);
		return $current_period_end->format(get_option('date_format'));
	}
	
	
	protected function get_status_text(){
		if($this->is_inactive()){
			//set the status label to inactive only when it's canceled and
			//the current_period_end has passed
			return 'inactive';
		}elseif($this->subscription->status == 'past_due'){
			return 'past due';
		}
		return $this->subscription->status;
	}
	
	
}