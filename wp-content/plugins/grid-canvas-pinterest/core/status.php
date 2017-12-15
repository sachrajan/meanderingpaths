<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Status{
	
	const TRANSIENT_ID = 'gc_status';
	const CACHE_INTERVAL = 21600; //21600 = 6 hours
	protected $status_data = array();
	protected $using_cache = false;
	
	public function __construct(){
		add_action( 'admin_init', array($this, 'init') );
	}
	
	public function init(){
		$this->load_status();
		$this->show_notifications();
	}
	
	public function load_status(){
		//no need to load the status if the account is not set
		if(!GC_Account::is_set()){
			return;
		}
		
		$cached_status = get_transient( self::TRANSIENT_ID );

		// check the cache
		if ( $cached_status === false ) {
			// transient doesn't exist, or is old, so refresh it

			$res = wp_remote_get( $this->get_api_request_url() );
			$cache_interval = self::CACHE_INTERVAL;
			$status_data = new stdClass();

			$is_error = is_wp_error($res);
			if(!$is_error){
				$body = json_decode( wp_remote_retrieve_body( $res ) );
				if(!empty($body) && is_a($body, 'stdClass')){
					$status_data = $this->do_on_new_status_loaded($body);
				}
			}else{
				$cache_interval = HOUR_IN_SECONDS; //make it check again in one hour
			}

			set_transient(self::TRANSIENT_ID, $status_data, $cache_interval);
		}else {
			// the transient is fresh, use it
			$this->using_cache = true;
			$status_data = $cached_status;
		}
		
		// Load the remote XML data into a variable and return it
		$this->status_data = $status_data;
	}
	
	protected function show_notifications(){
		if(!empty($this->status_data->notifications) && is_array($this->status_data->notifications)){
			foreach ( $this->status_data->notifications as $n ) {
				GC_Notice::create($n);
			}
		}
	}
	
	protected function do_on_new_status_loaded($status_data){
		if(isset($status_data->in_beta)){
			GC_Version::update_in_beta((int)$status_data->in_beta);
			unset($status_data->in_beta); #we don't need to store this in the transient
		}
		
		if(isset($status_data->subscription)){
			GC_Account::update_subscription($status_data->subscription);
			unset($status_data->subscription); #we don't need to store this in the transient
		}
		
		return $status_data;
	}
	
	protected function get_api_request_url(){
		$args = array(
			'version'=> GC_Version::get(),
			'email' => GC_Account::get_email(),
			'token' => GC_Account::get_token()
		);
		
		return GC_API_URL::build('status', $args);
	}
	
	
}

new GC_Status();