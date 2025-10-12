<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

   if(!function_exists('az_select_province')){
        function az_select_province($list_select = array()) {
            $ci =& get_instance();
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id('province');
            $select->set_url('master_province/get_data');
            $select->set_placeholder(azlang('Select Province'));

            if (count($list_select) > 0) {
                $select->add_list($list_select[0], $list_select[1]);
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_city')){
        function az_select_city($list_select = array()) {
            $ci =& get_instance();
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id('city');
            $select->set_select_parent('idprovince');
            $select->set_url('master_city/get_data');
            $select->set_placeholder(azlang('Select City'));

            if (count($list_select) > 0) {
                $select->add_list($list_select[0], $list_select[1]);
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_district')){
        function az_select_district($list_select = array()) {
            $ci =& get_instance();
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id('district');
            $select->set_select_parent('idcity');
            $select->set_url('master_district/get_data');
            $select->set_placeholder(azlang('Select District'));

            if (count($list_select) > 0) {
                $select->add_list($list_select[0], $list_select[1]);
            }
            
            return $select->render();
        }
    }