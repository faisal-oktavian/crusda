<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('az_add_filter_text')){
        function az_add_filter_text($data ='') {
            $value = "<input type='text' class='form-control full-width form-filter' id='".$data."' name='".$data."' data-filter='".$data."'/>";         
            return $value;
        }
    }

    if(!function_exists('az_add_filter_select')){
        function az_add_filter_select($id = "", $data = array(), $class = "", $attr = array()) {
            $attr_data = "";
            foreach ($attr as $key => $value) {
                $attr_data .= $key." = '".$value."' ";
            }

            $value = "<select class='form-control full-width form-filter select ".$class."' id='".$id."' name='".$id."' ".$attr_data." data-filter='".$id."'>";
            $val = '<option value="">SEMUA</option>';
            foreach ($data as $key => $values) {
                $val .= "<option value='".htmlspecialchars($key)."'>".htmlspecialchars($values)."</option>";
            }
            $value .= $val;
            $value .= "</select>";

            return $value;
        }
    }

    if(!function_exists('az_crud_delete')){
        function az_crud_delete($table, $id, $return = false, $delete = false) {
            $ci =& get_instance();
            $err_code = 0;
            $err_message = '';

            if (is_array($id)) {
                $ci->db->where_in("id".$table, $id);
            }
            else {
                $ci->db->where("id".$table, $id);
            }

            $arr_delete = array(
                'status' => 0,
                'updated' => Date('Y-m-d H:i:s'),
                'updatedby' => $ci->session->userdata('username')
            );

            if ($delete) {
                $ci->db->delete($table);
            }
            else {
                if (!$ci->db->update($table, $arr_delete)) {
                    $err = $ci->db->error();
                    $err_code = $err["code"];
                    $err_message = $err["message"];
                }
            }

            $data_return = array(
                'err_code' => $err_code,
                'err_message' => $err_message
            );

            if ($return) {
                return $data_return;
            }

            echo json_encode($data_return);
        }
    }

    if(!function_exists('az_crud_edit')) {
        function az_crud_edit($data = '', $return = false, $where = '', $table = '') {
            $ci =& get_instance();
            $select = $data;
            if (strlen($data) == 0) {
                $select = $ci->table_column;
            }
            $ci_table = $table;
            if (strlen($table) == 0) {
                $ci_table = $ci->table;
            }

            $id = $ci->input->post('id');

            $ci->db->select($select);
            $ci->db->where($where."id".$ci_table, $id);

            $rdata = $ci->db->get($ci_table)->result_array();
            
            if ($return) {
                return $rdata;
            }

            echo json_encode($rdata);
        }
    }

    if(!function_exists('az_crud_save')) {
        function az_crud_save($idpost, $table, $data) {
            $ci =& get_instance();           

            // $data['updated'] = Date('Y-m-d H:i:s');
            $data['updated'] = get_time_micro();
            $data['updatedby'] = $ci->session->userdata('username');

            $err_code = 0;
            $err_message = '';
            $insert_id = $idpost;

            if($idpost == ""){
                $data["created"] = Date("Y-m-d H:i:s");
                $data["createdby"] = $ci->session->userdata("username");
                if(!$ci->db->insert($table, $data)){
                    $err = $ci->db->error();
                    $err_code = $err["code"];
                    $err_message = $err["message"];
                }
                else {
                    $insert_id = $ci->db->insert_id();
                }
            }
            else {
                $ci->db->where('id'.$table, $idpost);
                if (!$ci->db->update($table, $data)) {
                    $err = $ci->db->error();
                    $err_code = $err["code"];
                    $err_message = $err["message"];
                }
            }

            $return = array(
                'err_code' => $err_code,
                'err_message' => $err_message,
                'insert_id' => $insert_id
            );

            return $return;
        }
    }

    if(!function_exists('az_crud_update')) {
        function az_crud_update($idpost, $table, $data, $where) {
            $ci =& get_instance();           

            // $data['updated'] = Date('Y-m-d H:i:s');
            $data['updated'] = get_time_micro();
            $data['updatedby'] = $ci->session->userdata('username');

            $err_code = 0;
            $err_message = '';
            $insert_id = $idpost;

            if($where == null) {
                $ci->db->where('id'.$table, $idpost);
                if (!$ci->db->update($table, $data)) {
                    $err = $ci->db->error();
                    $err_code = $err["code"];
                    $err_message = $err["message"];
                }
            } else {
                $ci->db->where($where);
                if (!$ci->db->update($table, $data)) {
                    $err = $ci->db->error();
                    $err_code = $err["code"];
                    $err_message = $err["message"];
                }
            }

            $return = array(
                'err_code' => $err_code,
                'err_message' => $err_message,
                'insert_id' => $insert_id
            );

            return $return;
        }
    }

    if(!function_exists('az_crud_date')) {
        function az_crud_date($date, $type = 'Y-m-d H:i:s') {
            if (strlen($date) == 0) {
                return NULL;
            }
            else {
                return Date($type, strtotime($date));
            }
        }
    }

    if(!function_exists('az_crud_number')) {
        function az_crud_number($number) {
            $number = str_replace('.', '', $number);
            return str_replace(',', '.', $number);
        }
    }

     if(!function_exists('get_time_micro')){
        function get_time_micro() {
            $t = microtime(true);
            $micro = sprintf("%06d",($t - floor($t)) * 1000000);
            $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
            return $d->format("Y-m-d H:i:s.u");
        }
    }
