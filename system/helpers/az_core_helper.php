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
    
    if(!function_exists('az_generate_random')){
        function az_generate_random($key = 0) {
            $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $string = '';
            for ($i = 0; $i < $key; $i++) {
              $string .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $string;
        }
    }

    if(!function_exists('az_remove_separator')){
        function az_remove_separator($key ='') {
            $data = str_replace(".", "", $key);
            $data = str_replace(",", ".", $data);   
            return $data;
        }
    }

    if(!function_exists('az_thousand_separator')){
        function az_thousand_separator($key ='') {
            $data = number_format($key, 0, "", ".");          
            return $data;
        }
    }

    if(!function_exists('az_thousand_separator_decimal')){
        function az_thousand_separator_decimal($key ='') {
            $data = number_format($key, 2, ",", ".");          
            return $data;
        }
    }

    if(!function_exists('az_terbilang_format')){
        function az_terbilang_format($x) {
            $x = abs($x);
            $angka = array("", "satu", "dua", "tiga", "empat", "lima",
            "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($x <12) {
                $temp = " ". $angka[$x];
            } else if ($x <20) {
                $temp = az_terbilang_format($x - 10). " belas";
            } else if ($x <100) {
                $temp = az_terbilang_format($x/10)." puluh". az_terbilang_format($x % 10);
            } else if ($x <200) {
                $temp = " seratus" . az_terbilang_format($x - 100);
            } else if ($x <1000) {
                $temp = az_terbilang_format($x/100) . " ratus" . az_terbilang_format($x % 100);
            } else if ($x <2000) {
                $temp = " seribu" . az_terbilang_format($x - 1000);
            } else if ($x <1000000) {
                $temp = az_terbilang_format($x/1000) . " ribu" . az_terbilang_format($x % 1000);
            } else if ($x <1000000000) {
                $temp = az_terbilang_format($x/1000000) . " juta" . az_terbilang_format($x % 1000000);
            } else if ($x <1000000000000) {
                $temp = az_terbilang_format($x/1000000000) . " milyar" . az_terbilang_format(fmod($x,1000000000));
            } else if ($x <1000000000000000) {
                $temp = az_terbilang_format($x/1000000000000) . " trilyun" . az_terbilang_format(fmod($x,1000000000000));
            }     
            return $temp;
        }
    }
 
    if (!function_exists('az_terbilang')) {
        function az_terbilang($x, $style=1) {
            if($x<0) {
                $hasil = "minus ". trim(az_terbilang_format($x));
            } else {
                $hasil = trim(az_terbilang_format($x));
            }     
            switch ($style) {
                case 1:
                    $hasil = strtoupper($hasil);
                    break;
                case 2:
                    $hasil = strtolower($hasil);
                    break;
                case 3:
                    $hasil = ucwords($hasil);
                    break;
                default:
                    $hasil = ucfirst($hasil);
                    break;
            }     
            return $hasil;
        }
    }

    if (!function_exists('az_get_user_type')) {
        function az_get_user_type($iduser) {
            $ci = &get_instance();
            $ci->db->where("user_group.iduser", $iduser);
            $ci->db->join("group", "group.idgroup = user_group.idgroup");
            $ci->db->join("user", "user.iduser = user_group.iduser");
            $data = $ci->db->get("user_group");

            if ($data->num_rows() > 0) {
                return $data->row()->group_name;
            }
            else {
                return null;
            }
        }
    }

    if (!function_exists('az_check_login')) {
        function az_check_login($type = "") {
            $ci = &get_instance();
            if (strlen($ci->session->userdata("iduser")) == 0) {
                redirect(app_url()."login");
            }
            else {
                if (is_array($type)) {
                    if (!in_array($ci->session->userdata("user_type"), $type)) {
                        redirect(app_url());
                    }
                }
                else {
                    if (strlen($type) > 0) {
                        if ($ci->session->userdata("user_type") != $type) {
                            redirect(app_url());
                        }                    
                    }
                }
            }
        }
    }

    if (!function_exists('az_check_date')) {
        function az_check_date($str = "") {
            $date_time = explode(' ',$str);
            if(count($date_time)==2) {
                $date = $date_time[0];
                $date_values = explode('-',$date);
                if (count($date_values)!=3) {
                    return FALSE;
                }
                if (!is_numeric($date_values[0])) {
                    return FALSE;
                }
                if (!is_numeric($date_values[1])) {
                    return FALSE;
                }
                if (!is_numeric($date_values[2])) {
                    return FALSE;
                }
                if(!checkdate( (int) $date_values[1], (int) $date_values[0], (int) $date_values[2])) {
                    return FALSE;
                }
                $time = $date_time[1];
                $time_values = explode(':',$time);
                if (count($time_values) != 3) {
                    return FALSE;
                }
                if (!is_numeric($time_values[0])) {
                    return FALSE;
                }
                if (!is_numeric($time_values[1])) {
                    return FALSE;
                }
                if (!is_numeric($time_values[2])) {
                    return FALSE;
                }
                if((int) $time_values[0]>23 || (int) $time_values[1]>59 || (int) $time_values[2]>59) {
                    return FALSE;
                }
                return TRUE;
            }
            return FALSE;
        }

        if (!function_exists('az_get_month')) {
            function az_get_month($key = '') {
                $data = array(
                    '01' => azlang('January'),
                    '02' => azlang('February'),
                    '03' => azlang('Maret'),
                    '04' => azlang('April'),
                    '05' => azlang('May'),
                    '06' => azlang('June'),
                    '07' => azlang('July'),
                    '08' => azlang('August'),
                    '09' => azlang('September'),
                    '10' => azlang('October'),
                    '11' => azlang('November'),
                    '12' => azlang('December'),
                );
                if (strlen($key) > 0) {
                    return $data[$key];
                }
                return $data;
            }
        }
    }


    if(!function_exists('az_convert_month')){
        function az_convert_month($month = '') {
            $arr_month = array(
                azlang('January'),
                azlang('Febuary'),
                azlang('March'),
                azlang('April'),
                azlang('May'),
                azlang('June'),
                azlang('July'),
                azlang('August'),
                azlang('September'),
                azlang('October'),
                azlang('November'),
                azlang('December')
            );

            return $arr_month[($month - 1)];
        }
    }

    if(!function_exists('az_css')){
        function az_css() {
            $str = '';
            $ci = &get_instance();
            $ci->config->load("js_css");
                
            $css = $ci->config->item('css');
            $app_css = $ci->config->item('app_css');
            $end_css = $ci->config->item('end_css');


            foreach((array) $css AS $item){
                $str .= '<link rel="stylesheet" href="'.base_url().'assets/plugins/'.$item.'" type="text/css" />'."\n";
            }

            foreach((array) $app_css AS $item){
                $str .= '<link rel="stylesheet" href="'.base_url().AZAPP.'assets/plugins/'.$item.'" type="text/css" />'."\n";
            }

            if (isset($ci->az_css_plugin)) {
                foreach ($ci->az_css_plugin as $key => $value) {
                    $str .= '<link rel="stylesheet" href="'.base_url().'assets/plugins/'.$value.'" type="text/css" />'."\n";
                }
            }
            if (isset($ci->az_app_css_plugin)) {
                foreach ($ci->az_app_css_plugin as $key => $value) {
                    $str .= '<link rel="stylesheet" href="'.base_url().AZAPP.'assets/plugins/'.$value.'" type="text/css" />'."\n";
                }
            }
            
            foreach((array) $end_css AS $item){
                $str .= '<link rel="stylesheet" href="'.base_url().'assets/plugins/'.$item.'" type="text/css" />'."\n";
            }

            if (is_file(APPPATH.'assets/plugins/az_theme/az_theme_custom.css')) {
                $str .= '<link rel="stylesheet" href="'.base_url().AZAPP.'assets/plugins/az_theme/az_theme_custom.css?v'.Date('YmdHis').'" type="text/css" />'."\n";   
            }

            return $str;
        }
    }

    if(!function_exists('az_js')){
        function az_js() {
            $str = '';
            $ci = &get_instance();
            $ci->config->load("js_css");
            
            $js = $ci->config->item('js');
            $app_js = $ci->config->item('app_js');
            
            foreach((array) $js AS $item){
                $str .= '<script type="text/javascript" src="'.base_url().'assets/plugins/'.$item.'"></script>'."\n";
            }

            foreach((array) $app_js AS $item){
                $str .= '<script type="text/javascript" src="'.base_url().AZAPP.'assets/plugins/'.$item.'"></script>'."\n";
            }
            if (isset($ci->az_js_plugin)) {
                foreach ($ci->az_js_plugin as $key => $value) {
                    $str .= '<script type="text/javascript" src="'.base_url().'assets/plugins/'.$value.'"></script>'."\n";
                }
            }
            if (isset($ci->az_app_js_plugin)) {
                foreach ($ci->az_app_js_plugin as $key => $value) {
                    $str .= '<script type="text/javascript" src="'.base_url().AZAPP.'assets/plugins/'.$value.'"></script>'."\n";
                }
            }


            return $str;
        }
    }

    if(!function_exists('az_add_js')){
        function az_add_js($view, $data = '') {
            $ci =& get_instance();
            $js = $ci->load->view($view, $data, true);
            $js = str_replace('<script>', '', $js);
            return $js;
        }
    }