<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_unit_detail extends CI_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->helper('az_auth');
        az_check_auth('sip_master_material','app_sip');
        $this->table = 'material_unit_detail';
        $this->controller = 'material_unit_detail';
        $this->load->helper('az_crud');
    }

	public function index(){
		$this->load->library('AZApp');
		$azapp = $this->azapp;
		$crud = $azapp->add_crud();
		$this->load->helper('az_role');

		$crud->set_column(array('#', "Nama Satuan", azlang('Action')));
		$crud->set_id($this->controller);
		$crud->set_default_url(true);

		$v_modal = $this->load->view('material_unit_detail/v_material_unit_detail', '', true);
		$crud->set_form('form');
		$crud->set_modal($v_modal);
		$crud->set_modal_title("Satuan Stok Detail");
		$v_modal = $crud->generate_modal();
		
		$crud = $crud->render();
		$crud .= $v_modal;	
		$azapp->add_content($crud);

		$data_header['title'] = "Satuan Stok Detail";
		$data_header['breadcrumb'] = array('warehouse', 'master', 'material_unit_detail');
		$azapp->set_data_header($data_header);
		
		echo $azapp->render();	
	}

	public function get() {
		$this->load->library('AZApp');
		$crud = $this->azapp->add_crud();
		$crud->set_select('idmaterial_unit_detail, material_unit_detail_name');
		$crud->set_filter('material_unit_detail_name');
		$crud->set_sorting('material_unit_detail_name');
		$crud->set_id($this->controller);
		$crud->add_where("status > 0");
		$crud->set_table($this->table);
		$crud->set_order_by('material_unit_detail_name');
		echo $crud->get_table();
	}

	public function save(){
		$data = array();
		$data_post = $this->input->post();
		$idpost = azarr($data_post, 'id'.$this->table);
		$data['sMessage'] = '';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('material_unit_detail_name', 'Nama Satuan Detail', 'required|trim|max_length[200]');

		$err_code = 0;
		$err_message = '';

		if($this->form_validation->run() == TRUE){
			$data_save = array(
				'material_unit_detail_name' => azarr($data_post, 'material_unit_detail_name'),
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
		az_crud_edit('idmaterial_unit_detail, material_unit_detail_name');
	}

	public function delete() {
		$id = $this->input->post('id');
		az_crud_delete($this->table, $id);
	}
}