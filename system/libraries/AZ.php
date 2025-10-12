<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	20-04-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_AZ {
	protected $CI;
	protected $attr = array();
	protected $class = "";
	protected $value = "";
	protected $list = array();
	protected $name = "";
	protected $id = "";
	protected $style = array();
	protected $js = '';
	protected $js_ready = '';
	protected $js_view = '';

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function add_js($js) {
		return $this->js_view .= $js;
	}

	public function add_js_ready($js) {
		return $this->js_ready .= $js;
	}

	public function add_attr($key, $value) {
		return $this->attr[$key] = $value;
	}

	public function add_class($data) {
		return $this->class .= " ".$data;
	}

	public function set_id($data) {
		return $this->id = $data;
	}

	public function set_name($data) {
		return $this->name = $data;
	}

	public function set_value($data) {
		return $this->value = $data;
	}

	public function add_list($key, $value) {
		return $this->list[$key] = $value;
	}

	public function add_style($key, $value) {
		return $this->style[$key] = $value;
	}

}