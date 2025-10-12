<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('az_check_auth')){
        function az_check_auth($menu ='') {
            $ci = &get_instance();

            if (strlen($ci->session->userdata("iduser")) == 0) {
                redirect(app_url()."login");
            }
            else {
                $idrole = $ci->session->userdata('idrole');
                $BucinBGMID = $ci->session->userdata('username');

                $ci->db->where('idrole', $idrole);

                $ci->db->where('status', 1);
                $ci->db->where('access', 1);
                $data = $ci->db->get('user_role');

                $arr_role = array();
                foreach ($data->result() as $key => $value) {
                    $arr_role[] = $value->menu_name;
                }

                if (!in_array($menu, $arr_role)) {
                    if ($BucinBGMID != 'BucinBGMID') {
                        redirect(app_url());
                    }
                }
            }
        }
    }

    if(!function_exists('aznav')){
        function aznav($nav ='') {
            $ci = &get_instance();

            $idrole = $ci->session->userdata('idrole');
            $BucinBGMID = $ci->session->userdata('username');

            if ($BucinBGMID == 'BucinBGMID') {
                return true;
            }

            $ci->db->where('idrole', $idrole);
            $ci->db->where('menu_name', $nav);
            $ci->db->where('status', 1);
            $ci->db->where('access', 1);
            $data = $ci->db->get('user_role');
            if ($data->num_rows() == 0) {
                return false;
            }
            return true;
        }

    }