<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	06-04-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("AZ.php");

class CI_AZDatetime extends CI_AZ {
	protected $format = "DD-MM-YYYY HH:mm:ss";
	protected $autofill = 'true';

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function set_format($data) {
		return $this->format = $data;
	}

	public function set_autofill($data) {
		return $this->autofill = $data;
	}

	public function render() {
		$style = '';
		if (count($this->style) > 0) {
			$style = " style='";
		}
		foreach ($this->style as $key => $value) {
			$style .= $key.':'.$value.';';
		}
		if (count($this->style) > 0) {
			$style  .= "' ";
		}

		$data_attr = "";
		foreach ($this->attr as $key => $value) {
			$data_attr .= " ".$key."='".$value."'";
		}

		$data = '
			<div class="input-group az-datetime" '.$style.'>
	            <input type="text" '.$data_attr.' class="form-control'.$this->class.'" id="'.$this->id.'" name="'.$this->name.'" value="'.$this->value.'"/>
	            <span class="input-group-addon">
	            <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	        </div>
	    ';

	    $js = "
	    	jQuery('#".$this->id."').datetimepicker({
	        	format: '".$this->format."',
	        	useCurrent: ".$this->autofill.",
	    	});
		";

		$ci =& get_instance();
		$ci->load->library('AZApp');
		$azapp = $ci->azapp;
		$azapp->add_js_ready($js);

	    return $data;
	}


}