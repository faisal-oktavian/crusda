<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->helper('az_auth');
        az_check_auth('warehouse');
        $this->table = 'warehouse';
        $this->controller = 'warehouse';
        $this->load->helper('az_crud');
    }

	public function index(){
		$this->load->library('AZApp');
		$azapp = $this->azapp;
		$crud = $azapp->add_crud();
		$this->load->helper('az_role');

		$crud->set_column(array('#', 'Jenis', 'Nama Gudang', azlang('Action')));
		$crud->set_width(array('10px, 140px, , 120px'));
		$crud->set_id($this->controller);
		$crud->set_default_url(true);

		$v_modal = $this->load->view('warehouse/v_warehouse', '', true);
		$crud->set_form('form');
		$crud->set_modal($v_modal);
		$crud->set_modal_title(azlang("Master Gudang"));
		$v_modal = $crud->generate_modal();
		
		$crud = $crud->render();
		$crud .= $v_modal;	
		$azapp->add_content($crud);

		$data_header['title'] = azlang('Master Gudang');
		$data_header['breadcrumb'] = array('warehouse', 'master', 'warehouse');
		$azapp->set_data_header($data_header);
		
		echo $azapp->render();	
	}

	public function get() {
		$this->load->library('AZApp');
		$crud = $this->azapp->add_crud();
		$idoutlet = $this->session->userdata('idoutlet');

		$crud->set_select('idwarehouse, warehouse_type, warehouse_name');
		$crud->set_filter('warehouse_type, warehouse_name');
		$crud->set_sorting('warehouse_type, warehouse_name');
		$crud->set_id($this->controller);

		$crud->add_where("warehouse.status > 0");
		$crud->set_table($this->table);
		$crud->set_order_by('warehouse_name');
		// $crud->set_custom_style('custom_style');
		echo $crud->get_table();
	}

	// function custom_style($key, $value, $data) {
	// 	if($key == 'action') {
	// 		if(azarr($data, 'warehouse_type') == 'Gudang Jasa') {
	// 			if($this->session->userdata('idrole') != null) {
	// 				return '<button class="btn btn-default btn-xs btn-edit-warehouse" data_id="'.azarr($data, 'idwarehouse').'"><span class="glyphicon glyphicon-pencil"></span> Edit</button>';
	// 			}
	// 		}
	// 	}

	// 	return $value;
	// }

	public function save(){
		$data = array();
		$data_post = $this->input->post();
		$idpost = azarr($data_post, 'id'.$this->table);
		$data['sMessage'] = '';

		$warehouse_type = azarr($data_post, 'warehouse_type');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('warehouse_name', "Nama Gudang", 'required|trim|max_length[200]');
		$this->form_validation->set_rules('warehouse_type', "Jenis Gudang", 'required|trim|max_length[50]');	

		$err_code = 0;
		$err_message = '';

		if($this->form_validation->run() == TRUE){
			// save
			$data_save = array(
				'warehouse_name' => azarr($data_post, 'warehouse_name'),
				'warehouse_type' => azarr($data_post, 'warehouse_type'),
			);

			$response_save = az_crud_save($idpost, $this->table, $data_save);
			$err_code = azarr($response_save, 'err_code');
			$err_message = azarr($response_save, 'err_message');
			$insert_id = azarr($response_save, 'insert_id');

			$this->db->where('status', 1);
			$product = $this->db->get('product');
			foreach($product->result() as $key => $value) {
				$idproduct = $value->idproduct;

				$this->db->where('idproduct', $idproduct);
				$this->db->where('idwarehouse', $insert_id);
				$check = $this->db->get('stock');
				if($check->num_rows() == 0) {
					$data_stock = array(
						'idwarehouse' => $insert_id,
						'idproduct' => $idproduct,
						'stock' => 0,
						'stock_waste' => 0,		
					);
					$stock_save = az_crud_save('', 'stock', $data_stock);
				}
			}
		}
		else {
			$err_code++;
			$err_message = validation_errors();
		}

		$data["sMessage"] = $err_message;
		echo json_encode($data);
	}

	public function edit() {
		az_crud_edit('idwarehouse, warehouse_name, warehouse_type');
	}

	public function delete() {
		$id = $this->input->post('id');
		az_crud_delete($this->table, $id);

		$this->db->where('status', 1);
		$this->db->where('idwarehouse', $id);
		$this->db->delete('stock');
	}
}
