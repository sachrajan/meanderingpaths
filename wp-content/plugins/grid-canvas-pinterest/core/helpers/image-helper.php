<?php

if(!defined( 'ABSPATH' )){
   exit;
}

class GC_Image_Helper{
	
	public static function get_post_images($post_id){
		$image_ids = array();
		
		$featured_id = self::get_featured_image_id($post_id);
		if($featured_id !== 0){
			$image_ids[]= $featured_id;
		}
		
		$gallery_image_ids = self::get_gallery_image_ids($post_id);
		$content_image_ids = self::get_post_content_image_ids($post_id);
		$attachment_ids = self::get_attachments($post_id);
		
		$image_ids = array_merge($image_ids, $gallery_image_ids, $content_image_ids, $attachment_ids);
		$image_ids = array_values(array_unique($image_ids));
		
		$images = self::get_images_data($image_ids);
		
		return $images;
	}
	
	public static function get_images_data($image_ids){
		$images = array();
		if(!empty($image_ids)){
			foreach ($image_ids as $img_id ) {
				$image_data = self::get_image_data($img_id);
				if(!empty($image_data)){
					$images[]=$image_data;
				}
			}
		}
		
		return $images;
	}
	
	public static function get_image_data($image_id){
		$image_data = array();
		
		$att_data = wp_get_attachment_metadata( $image_id );
		if($att_data){
			$image_data['width'] = $att_data['width'];
			$image_data['height'] = $att_data['height'];
			$image_data['src'] =  wp_get_attachment_url($image_id);
			$image_data['sizes'] = array();
			$image_data['id'] = $image_id;
			
			$orig_ratio = $image_data['width'] / $image_data['height'];
			
			if(isset($att_data['sizes']) && is_array($att_data['sizes'])){
				foreach ($att_data['sizes'] as $size => $size_data) {
					
					$src_data = wp_get_attachment_image_src($image_id, $size);
					if(!empty($src_data) && isset($src_data[0])){
						
						$ratio = $size_data['width'] / $size_data['height'];
						
						if(abs($orig_ratio - $ratio) < 0.1){
							//the cropped image is with the same ratio as the original image
							//we can use this image as a smaller size image
							$image_data['sizes'][$size] = array(
								'width' => $size_data['width'],
								'height' => $size_data['height'],
								'src' => $src_data[0]
							);
						}
						
						if($size == 'medium'){
							//use the medium size as a thumbnail
							$image_data['thumbnail'] = $src_data[0];
						}
					}
				}
			}
			
		}
		
		return $image_data;
	}
	
	
	public static function get_featured_image_id($post_id){
		$thumb = get_post_thumbnail_id($post_id);
		return intval($thumb);
	}
	
	public static function get_attachments($post_id){
		$image_ids = array();
		
		$attachments = get_children( array(
				'order'=> 'ASC',
				'orderby'=>'menu_order',
				'post_parent' => $post_id,
				'post_type' => 'attachment',
				'post_mime_type' =>'image'
			) );
			
		if(!empty($attachments)){
			$image_ids = array_values(wp_list_pluck($attachments, 'ID'));
		}
		return $image_ids;
	}
	
	public static function get_gallery_image_ids($post_id){
		$image_ids = array();
		$galleries = get_post_galleries($post_id, false);
		if(!empty($galleries)){
			foreach ($galleries as $g ) {
				if(!empty($g['ids'])){
					$ids = array_map('intval', explode(',',$g['ids']));
					$image_ids = array_merge($image_ids, $ids);
				}
			}
		}
		
		return $image_ids;
	}
	
	public static function get_post_content_image_ids($post_id){
		$image_ids = array();
		$post = get_post($post_id);
		
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/iU', $post->post_content, $matches);
		
		if(!empty($matches[1])){
			foreach ($matches[1] as $src ) {
				$img_id = self::get_attachment_id_from_url($src);
				if($img_id !== 0){
					$image_ids[]= $img_id;
				}
			}
		}

		return $image_ids;
	}
	
	// code from: http://wpscholar.com/blog/get-attachment-id-from-wp-image-url/
	public static function get_attachment_id_from_url($url) {
		$attachment_id = 0;
		$dir = wp_upload_dir();
		
		if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
			$file = basename( $url );
			$query_args = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'fields'      => 'ids',
				'meta_query'  => array(
					array(
						'value'   => $file,
						'compare' => 'LIKE',
						'key'     => '_wp_attachment_metadata',
					),
				)
			);
			
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post_id ) {
					$meta = wp_get_attachment_metadata( $post_id );
					$original_file = basename( $meta['file'] );
					$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
					if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
						$attachment_id = $post_id;
						break;
					}
				}
			}
		}
		return $attachment_id;
	}
}