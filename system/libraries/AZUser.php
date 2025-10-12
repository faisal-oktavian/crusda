<?php
/**
 * AZApp
 * @author	M. Isman Subakti
 * @copyright	28-04-2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_AZUser {
	protected $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
	}

	public function add_user($iduser, $group) {
		$this->CI->db->where("group_name", $group);
        $rgroup = $this->CI->db->get("group");
        if ($rgroup->num_rows() > 0) {
            $idgroup = $rgroup->row()->idgroup;
            
            $data_user = array(
                "idgroup" => $idgroup,
                "iduser" => $iduser,
                "created" => Date("Y-m-d H:i:s"),
                "createdby" => $this->CI->session->userdata("username")
            );

            $this->CI->db->insert("user_group", $data_user);
        }
        else {
            return "Group not valid";
        }
	}

}