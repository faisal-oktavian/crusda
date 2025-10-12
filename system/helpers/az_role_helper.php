<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('az_get_role')){
        function az_get_role($parent = 0) {
            $ci =& get_instance();
            $ci->db->where('parent', $parent);
            $ci->db->where('status', 1);
            $data = $ci->db->get('role');

            $arr_menu = array();
            foreach ($data->result() as $key => $value) {
                $subrole = array();
                if (strlen($value->idrole) > 0) {
                    $subrole = az_get_role($value->idrole); 
                }

                $arr_menu[] = array(
                    'idrole' => $value->idrole,
                    'title' => $value->title,
                    'subrole' => $subrole
                );
            }

            return $arr_menu;
        }
    }

    if(!function_exists('az_generate_role_option')){
        function az_generate_role_option($data_role = array(), $sub_count = 0) {
            $ret = '';
            $sub_count++;
            
            foreach ($data_role as $key => $value) {    
                $sub = '';
                if (count($value['subrole']) > 0) {
                    $sub .= az_generate_role_option($value['subrole'], $sub_count);
                }

                $separate = '';
                for ($i=1; $i < $sub_count; $i++) { 
                    $separate .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }

                $ret .= '<option value="'.$value['idrole'].'">';
                $ret .= $separate.azarr($value, 'title');
                $ret .= '</option>';
                $ret .= $sub;
            }

            return $ret;
        }
    }