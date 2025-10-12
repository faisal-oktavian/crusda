<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	13-02-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("AZ.php");

class CI_AZApp extends CI_AZ {
	protected $CI;
	protected $content = '';
	protected $data_header = array();
	protected $click = '';
	protected $crud = '';
	protected $select2 = '';
	protected $datetime = '';
	protected $dompdf = '';
	protected $phpexcel = '';
	protected $js_link = '';
	protected $header = '';
	protected $footer = '';

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function add_content($content) {
		return $this->content .= $content;
	}

	public function add_js_link($js) {
		return $this->js_link .= $js;
	}

	public function set_data_header($header) {
		return $this->data_header = $header;
	}
	
	public function add_crud() {
		$this->CI->load->library("AZAppCRUD");
		return new $this->CI->azappcrud;
	}

	public function add_modal() {
		$this->CI->load->library("AZModal");
		return new $this->CI->azmodal;
	}

	public function add_select2() {
		$this->CI->load->library("AZSelect2");
		return new $this->CI->azselect2;
	}

	public function add_datetime() {
		$this->CI->load->library("AZDatetime");
		return new $this->CI->azdatetime;
	}

	public function add_dompdf() {
		$ver = explode('.', phpversion());
		if(intval($ver[0]) >= 7) {
			$this->CI->load->library("AZDomPDF8");
			$azdompdf = new $this->CI->azdompdf8;
		} else {
			$this->CI->load->library("AZDomPDF");
			$azdompdf = new $this->CI->azdompdf;
		}

		return $azdompdf->instance();
	}

	public function add_phpexcel() {
		$this->CI->load->library("AZPHPExcel");
		$azphpexcel = new $this->CI->azphpexcel;
		return $azphpexcel->instance();
	}

	public function add_image() {
		$this->CI->load->library("AZImage");
		return new $this->CI->azimage;
	}

	public function add_file() {
		$this->CI->load->library("AZFile");
		return new $this->CI->azfile;
	}

	public function set_header($header) {
		return $this->header = $header;
	}
	public function set_footer($footer) {
		return $this->footer = $footer;
	}

	public function generate_menu() {
   		$this->CI->config->load('menu');
   		$menu = $this->CI->config->item('menu');

   		echo '<pre>';
   		print_r($menu);die;
	}

	public function render() {
		$this->CI->config->load("config");       
        $theme = $this->CI->config->item('theme');

		$azapp = '';
		$header_app = APPPATH.'views/v_header.php';
		$header_app_def = DEFPATH.'views/v_header.php';
		$header_def_theme = DEFPATH.'views/themes/'.$theme.'/v_header.php';
		$header_app_theme = APPPATH.'views/themes/'.$theme.'/v_header.php';

		if (file_exists($header_app) || file_exists($header_app_def)) {
			$app_def_data['data_header'] = $this->data_header;
			$app_def_data = array_merge($app_def_data, $this->data_header);
			$header = $this->CI->load->view("v_header", $app_def_data, true);
		}
		else if (file_exists($header_app_theme) || file_exists($header_def_theme)) {
			$app_def_data['data_header'] = $this->data_header;
			$app_def_data = array_merge($app_def_data, $this->data_header);
			$header = $this->CI->load->view('themes/'.$theme."/v_header", $app_def_data, true);	
		}
		else {
			ob_start();
			$data_header = $this->data_header;
			$header = include BASEPATH.'views/themes/'.$theme.'/v_header.php';
			$header = ob_get_clean();
		}

		if (strlen($this->header) > 0) {
			$app_def_data['data_header'] = $this->data_header;
			$app_def_data = array_merge($app_def_data, $this->data_header);
			$header = $this->CI->load->view($this->header, $app_def_data, true);
		}

		$azapp .= $header;
		$azapp .= $this->content;
		
		// $azapp .= $this->CI->load->view("v_footer", '', true);
		$footer_app = APPPATH.'views/v_footer.php';
		$footer_app_def = DEFPATH.'views/v_footer.php';
		$footer_def_theme = DEFPATH.'views/themes/'.$theme.'/v_footer.php';
		$footer_app_theme = APPPATH.'views/themes/'.$theme.'/v_footer.php';
		if (file_exists($footer_app) || file_exists($footer_app_def)) {
			$footer = $this->CI->load->view("v_footer", '', true);
		}
		else if (file_exists($footer_app_theme) || file_exists($footer_def_theme)) {
			$footer = $this->CI->load->view('themes/'.$theme."/v_footer", '', true);	
		}
		else {
			ob_start();
			$footer = include BASEPATH.'views/themes/'.$theme.'/v_footer.php';
			$footer = ob_get_clean();
		}

		if (strlen($this->footer) > 0) {
			$footer = $this->CI->load->view($this->footer, '', true);	
		}

		$azapp .= $footer;

		ob_start();
		include BASEPATH.'views/js_core.php';
		$js_core = ob_get_clean();
		$js_core = str_replace('<script>', '', $js_core);

		$this->js .= $this->minify_js($js_core);

		$js_general = $this->CI->load->view('js/general', '', true);
		$js_general = str_replace('<script>', '', $js_general);
		$this->js .= $js_general;
		
		// $this->js .= $this->minify_js($this->js_view);
		$this->js .= $this->js_view;

		$js = "<script type='text/javascript'>";
		$js .= $this->minify_js($this->js);

		$js .= "jQuery(document).ready(function(){";
		$js .= $this->minify_js($this->js_ready);
		$js .= "});";

		$js .= "</script>";

		$azapp .= $js;

		$azapp .= $this->js_link;

		return $azapp;
	}

	function minify_js($input) {
        if(trim($input) === "") return $input;
        return preg_replace(
                array(
                    // Remove comment(s)
                    '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
                    // Remove white-space(s) outside the string and regex
                    '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
                    // Remove the last semicolon
                    '#;+\}#',
                    // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
                    '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
                    // --ibid. From `foo['bar']` to `foo.bar`
                    '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
                ),
                array(
                    '$1',
                    '$1$2',
                    '}',
                    '$1$3',
                    '$1.$3'
                ),
            $input);
    }

    function js_system() {

    }
}