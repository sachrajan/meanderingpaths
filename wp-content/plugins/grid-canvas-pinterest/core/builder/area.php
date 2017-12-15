<?php

class GC_Area{
	
	protected $image = null;
	protected $layout_options = null;
	protected $max_image_size = 1500;
	
	public function __construct($options){
		if (isset($options['image'])){
			$this->image = $options['image'];
		}
		$this->layout_options = $options['layout_options'];
		$this->includes();
	}
	
	protected function includes(){
		GC_Helper::include_file('core/helpers/', 'aq_resizer.php');
	}
	
	public function export_for($canvas_size){
		$export = array();
		
		if($this->image !== null){
			$src = $this->get_best_image_src($canvas_size);
			$export['image'] = array(
				'src' => $src,
				'position' => $this->image['position']
			);
		}
		
		//keep only the w, h, x and y values for the request
		$export['layout_options'] = array(
			'w' => $this->layout_options['w'],
			'h' => $this->layout_options['h'],
			'x' => $this->layout_options['x'],
			'y' => $this->layout_options['y']
		);
		
		return $export;
	}
	
	protected function get_best_image_src($canvas_size){
		if(!empty($this->image['image_size_id'])){
			//a small size already exists
			return $this->image['src'];
		}
		
		$img_data = wp_get_attachment_metadata( $this->image['id'] );
		
		$width = $img_data['width'];
		$height = $img_data['height'];
		
		if($width < $this->max_image_size && $height < $this->max_image_size){
			//no need to resize images with size up to 1500px
			return $this->image['src'];
		}
		
		$canvas_width = $canvas_size['width'];
		$canvas_height = $canvas_size['height'];
		
		$area_width = $canvas_width*$this->layout_options['width'];
		$area_height = $canvas_height*$this->layout_options['height'];
		
		if($area_width >= $area_height){
			return $this->get_resized_image($this->image['src'], $area_width, null);
		}else{
			return $this->get_resized_image($this->image['src'], null, $area_height);
		}
	}
	
	protected function get_resized_image($src, $width = null, $height = null){
		$resized = gc_aq_resize( $src, $width, $height);
		if(!$resized){
			//the Aqua Resizer script could not crop the image, return the original image
			$resized = $src;
		}
		return $resized;
	}
}