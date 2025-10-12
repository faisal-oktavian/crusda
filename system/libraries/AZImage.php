<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	06-04-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("AZ.php");

class CI_AZImage extends CI_AZ {
	protected $image_url = "";
	protected $image_default = "assets/images/no-image.jpg";
	protected $image_width = "";
	protected $image_height = "";

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function set_image_url($data) {
		return $this->image_url = $data;
	}

	public function set_image_width($data) {
		return $this->image_width = $data;
	}
	
	public function set_image_height($data) {
		return $this->image_height = $data;
	}

	public function render() {
		$data = "<div class='az-image-container az-image-container-".$this->id."'>";
		$data .= "	<div class='az-image az-image-".$this->id."'>";
		$data .= "		<div class='az-image-x az-image-x-".$this->id."'>X</div>";
		if (strlen($this->image_url) > 0) {
			$data .= "	<img class='az-content-image-".$this->id."' src='".$this->image_url."'/>";
		}
		else {
			$data .= "	<img class='az-content-image-".$this->id."' src='".base_url()."assets/images/no-image.jpg'/>";
		}

		$data .= "		<div class='az-image-file-div az-image-file-div-".$this->id."'>";	
		$data .= "			<div class='div-choose-image div-choose-image-".$this->id."'><button class='btn btn-choose-image-".$this->id."' type='button'>".azlang('Choose Image')."</button></div>";
		$data .= "			<input type='file' name='image-".$this->id."' id='image_".$this->id."' class='az-image-file' accept='image/*'/>";
		$data .= "		</div>";

		$data .= "	</div>";

		$data .= "</div>";

		//css
		$data .= "<style type='text/css'>";
		if (strlen($this->image_width) > 0) {
			$data .= "	
				.az-image-".$this->id." img {
					width: ".$this->image_width.";
				}
			";
		}
		if (strlen($this->image_height) > 0) {
			$data .= "	
				.az-image-".$this->id." img {
					height: ".$this->image_height.";
				}
			";
		}
		$data .= "</style>";

		//js
		
		$data_js = "
			if ('".$this->image_url."' != '') {
				jQuery('.az-image-file-div-".$this->id."').hide();
			}
			jQuery('body').on('click', '.az-image-x-".$this->id."', function() {
				jQuery('.az-image-".$this->id." img').attr('src', base_url+'".$this->image_default."');
				jQuery(this).hide();
				jQuery('.az-image-file-div-".$this->id."').show();
			});

		    jQuery('body').on('change', '.az-image-file#image_".$this->id."', function(){
		        var content_image = jQuery('.az-content-image-".$this->id."');
		        show_image_".$this->id."(this, content_image);
		    });

		    
			function show_image_".$this->id."(input, content_image) {
		        if (input.files && input.files[0]) {
		            var reader = new FileReader();
		            reader.onload = function (e) {
		                content_image.attr('src', e.target.result);
		                jQuery('.az-image-file-div-".$this->id."').hide();
		                jQuery('.az-image-x-".$this->id."').show();
		            };

		            reader.readAsDataURL(input.files[0]);;
		        }
		    }	
		";

		$ci =& get_instance();
		$ci->load->library('AZApp');
		$azapp = $ci->azapp;
		$azapp->add_js_ready($data_js);

	    return $data;
	}


}