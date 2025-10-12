<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends CI_Controller {
	public function __construct() {
        parent::__construct();
		
        $this->table = 'product_category';
        $this->controller = 'product_category';
		
		$this->load->helper('az_crud');
        $this->load->helper('az_auth');
        $this->load->helper('az_config');

		az_check_auth('product_category');
    }

	public function index(){
		$this->load->library('AZApp');
		$azapp = $this->azapp;
		$crud = $azapp->add_crud();

		$crud->set_column(array('#', 'Nama Kategori', 'Aktif', azlang('Action')));
		// $crud->set_width('10px,100px,,,20px,50px,120px');
		$crud->set_id($this->controller);
		$crud->set_default_url(true);

		$v_modal = $this->load->view('product_category/v_product_category', '', true);
		$crud->set_form('form');
		$crud->set_modal($v_modal);
		$crud->set_modal_title("Kategori");
		$v_modal = $crud->generate_modal();
		
		$crud = $crud->render();
		$crud .= $v_modal;	
		$azapp->add_content($crud);

		$data_header['title'] = "Kategori";
		$data_header['breadcrumb'] = array('warehouse', 'master', 'product_category');
		$azapp->set_data_header($data_header);
		
		echo $azapp->render();	
	}

	public function get() {
		$this->load->library('AZApp');
		$crud = $this->azapp->add_crud();
	
		$crud->set_select('idproduct_category, product_category_name, is_active');
		$crud->set_filter('product_category_name');
		$crud->set_sorting('product_category_name');
		$crud->set_id($this->controller);
		$crud->add_where("status > 0");
		$crud->set_table($this->table);
		$crud->set_order_by('idproduct_category');
		$crud->set_custom_style('custom_style');
		echo $crud->get_table();
	}

	function custom_style($key, $value, $data) {
		if ($key == 'is_active') {
			$lbl = 'danger';
			$tlbl = 'TIDAK AKTIF';
			if ($value) {
				$lbl = 'success';
				$tlbl = 'AKTIF';
			}
			$label = "<label class='label label-".$lbl."'>".$tlbl."</label>";
			return $label;
		}
		return $value;
	}

	public function save(){
		$data = array();
		$data_post = $this->input->post();
		$idpost = azarr($data_post, 'id'.$this->table);
		$data['sMessage'] = '';

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('product_category_name', 'Nama Kategori', 'required|trim|max_length[200]');

		$err_code = 0;
		$err_message = '';

		if($this->form_validation->run() == TRUE){
			$product_category_name = azarr($data_post, 'product_category_name');

			$data_save = array(
				'product_category_name' => $product_category_name,
				'is_active' => azarr($data_post, 'is_active'),
			);

			$response_save = az_crud_save($idpost, $this->table, $data_save);
			$err_code = azarr($response_save, 'err_code');
			$err_message = azarr($response_save, 'err_message');
			$insert_id = azarr($response_save, 'insert_id');
		}
		else {
			$err_code++;
			$err_message = validation_errors();
		}

		$data["sMessage"] = $err_message;
		echo json_encode($data);
	}

	public function edit() {
		az_crud_edit('idproduct_category, product_category_name, is_active');
	}

	public function delete() {
		$id = $this->input->post('id');
		az_crud_delete($this->table, $id);
	}
}