<?php 
if ( ! function_exists('thumb_image')) {
	function thumb_image($path = "", $size = "", $type = ""){
		$CI =& get_instance();
		$webconfig = $CI->config->item('webconfig');
		## DEFINE THE IMAGE ##
		$path_thumbs     = $webconfig['media-path-images-thumb'];
		$server_thumbs   = $webconfig['media-server-images-thumb'];
		$path_original   = $webconfig['media-path-images-original'];
		$server_original = $webconfig['media-server-images-original'];		
		if($path != "") {
			$str_path = "";
			$exp_img = explode(".", $path);
		
			if(isset($size) && $size != "") {
			   
				if(file_exists($path_thumbs.$exp_img[0]."_crop_".$size.".".$exp_img[1])) {
					$str_path = $server_thumbs.$exp_img[0]."_crop_".$size.".".$exp_img[1];
				} else {
					$str_path =  $webconfig['lokapala_template'].'images/'."no_images.jpg";	
				}
			}else{
				$str_path =  $webconfig['lokapala_template'].'images/'."no_images.jpg";	
			} 
			return $str_path;
		} else {			
			return $webconfig['lokapala_template'].'images/'."no_images.jpg";			
		}
	}
}

if ( ! function_exists('thumb_image_original')) {
	function thumb_image_original($path = ""){
		$CI =& get_instance();
		$webconfig = $CI->config->item('webconfig');
		## DEFINE THE IMAGE ##
		$path_thumbs     = $webconfig['media-path-images-thumb'];
		$server_thumbs   = $webconfig['media-server-images-thumb'];
		$path_original   = $webconfig['media-path-images-original'];
		$server_original = $webconfig['media-server-images-original'];		
		if($path != "") {
			$str_path = "";
			$exp_img = explode(".", $path);			
			
			if(file_exists($path_original.$path)) {		
				$str_path = $server_original.$path;				
			}else{
				$str_path =  $webconfig['lokapala_template'].'images/'."no_images.jpg";	
			} 
			return $str_path;
		} else {			
			return $webconfig['lokapala_template'].'images/'."no_images.jpg";			
		}
	}
}
