<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Builder_Assets{
	
	public function __construct(){
		$this->base_file = GC_PLUGIN_FILE;
		$this->version = GC_Version::get();
	}
	
	public function init(){
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_assets') );
		add_action( 'admin_print_scripts', array($this, 'init_js') );
	}
	
	protected function is_post_screen(){
		global $current_screen;
		
		return $current_screen->base=='post';
	}
	
	public function enqueue_assets(){
		
		if ( $this->is_post_screen() ) {
			$this->enqueue_scripts();
			$this->enqueue_styles();
		}
		
	}
	
	protected function enqueue_scripts(){
		wp_enqueue_media();
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('underscore');
		wp_enqueue_script('backbone');
		wp_enqueue_script('jquery-ui-draggable');
		
		wp_enqueue_script('gc_fitjs', 
			plugins_url('app/js/lib/fit.min.js', $this->base_file), 
			array(), 
			$this->version);
		
		wp_enqueue_script('gc_app', 
			plugins_url('app/js/app.js', $this->base_file), 
			array('jquery', 'underscore', 'backbone', 'jquery-ui-draggable', 'gc_fitjs'), 
			$this->version);
		
			
		wp_enqueue_script('gc_sharrre', 
			plugins_url('js/lib/jquery.sharrre.min.js', $this->base_file), 
			array('jquery'), 
			$this->version);
		
		wp_enqueue_script('gc_main', 
			plugins_url('js/grid-canvas.js', $this->base_file), 
			array('gc_app', 'gc_sharrre'), 
			$this->version);
		
	}
	
	protected function enqueue_styles(){
		wp_enqueue_style( 'gc_app_css', 
			plugins_url('app/css/style.css', $this->base_file ), 
			array(), 
			$this->version );
			
		wp_enqueue_style( 'gc_main_css', 
			plugins_url('css/style.css', $this->base_file ), 
			array('gc_app_css'), 
			$this->version );
			
	}
	
	public function init_js(){
		if ( $this->is_post_screen() ) {
			global $post;
			
			$options = array(
				'nonce' => GC_Ajax::generate_nonce(),
				'postId' => intval($post->ID),
				'generatedImages' => GC_Generated_Image::get_all_with_share_options($post->ID),
				'postTitle' => $post->post_title
			);

			$strings = array(
				'createImage' => __('Create a new image', 'grid-canvas-pinterest'),
				'dragImages' => __('Drag & drop images', 'grid-canvas-pinterest'),
				'selectGrid' => __('Select Grid', 'grid-canvas-pinterest'),
				'selectSize' => __('Select Size', 'grid-canvas-pinterest'),
				'selectImages' => __('Select Images', 'grid-canvas-pinterest'),
				'add' => __('Add', 'grid-canvas-pinterest'),
				'generateImage' => __('Generate image', 'grid-canvas-pinterest'),
				'loadingImages' => __('Loading post images...', 'grid-canvas-pinterest'),
				'loadingImageData' => __('Loading image data...', 'grid-canvas-pinterest'),
				'generatingImage' => __('Generating image...', 'grid-canvas-pinterest'),
				'ajaxError' => __('Error making an AJAX request', 'grid-canvas-pinterest'),
				'share' => __('Share', 'grid-canvas-pinterest'),
				'download' => __('Download', 'grid-canvas-pinterest')
			);

			$options = apply_filters('gc_js_options', $options);
			?>
			<script type="text/javascript">
				window.GC_WP || (window.GC_WP = {});
				GC_WP.options = <?php echo json_encode($options); ?>;
				GC_WP.strings = <?php echo json_encode($strings); ?>;
			</script>
			<?php
		}

	}
	
}