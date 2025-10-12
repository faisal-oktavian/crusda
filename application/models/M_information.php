<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class M_information extends CI_Model {

	function get_information() {
		$this->db->where('status', 1);
        $this->db->where('key != "app_name" ');
		$data = $this->db->get('config');
		return $data;
	}

	function save_information($key, $value) {
		$this->db->where('key', $key);
		$this->db->update('config', $value);
	}
}