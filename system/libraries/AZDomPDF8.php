<?php
/**
 * AZApp
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Lib/dompdf8/autoload.inc.php");
use Dompdf\Dompdf;

class CI_AZDomPDF8 extends CI_AZ {

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function instance() {
		return new Dompdf();
	}


}