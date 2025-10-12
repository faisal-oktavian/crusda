<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper('az_config');
    }

	public function index(){
		if (strlen($this->session->userdata("iduser")) > 0) {
			redirect(app_url()."home");
		}
		$this->load->view("v_login");
	}

	public function process() {
		$this->load->helper("array");
		$this->load->helper("az_core");
		
		$username = azarr($_POST, "username");
		$password = azarr($_POST, "password");

		$this->db->select('username, iduser, user.name as user_name, user.idrole, role.name as role_name');
		$this->db->where("username", $username);
		$this->db->where("password", md5($password));
		$this->db->where('user.status', 1);
		$this->db->join('role', 'role.idrole = user.idrole', 'left');
		$data = $this->db->get("user");

  	if ($data->num_rows() > 0) {
    	$data_username = $data->row()->username;
			$data_id = $data->row()->iduser;
			$data_nama_user = $data->row()->user_name;
			$data_idrole = $data->row()->idrole;
			$data_role_name = $data->row()->role_name;

			$this->session->set_userdata("username", $data_username);
			$this->session->set_userdata("iduser", $data_id);
			$this->session->set_userdata("name", $data_nama_user);
			$this->session->set_userdata('idrole', $data_idrole);
			$this->session->set_userdata('role_name', $data_role_name);

			redirect(app_url()."home");

    } else {
        $this->session->set_flashdata("error_login", azlang('Wrong Username/Password'));
				redirect(app_url()."login");
    }
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(app_url());
	}

}