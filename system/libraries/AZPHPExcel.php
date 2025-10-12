<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	25-04-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Lib/PHPExcel.php");

class CI_AZPHPExcel extends CI_AZ {

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function instance() {
		return new PHPExcel();
	}
}