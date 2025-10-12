<?php
defined('BASEPATH') OR exit('No direct script access allowed');   
    if (!function_exists('azlang')) {
        function azlang($data = "") {
            $ci = &get_instance();

            $language = $ci->session->userdata('azlang');
            if (strlen($language) == 0) {
                $language = 'indonesian';
            }

            $ci->lang->load('app', $language);
            $return = $ci->lang->line($data);
            if (strlen($return) == 0) {
                $return = $data;
            }
            return $return;
        }
    }