<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('az_encode_url')){
        function az_encode_url($key = '') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $encode = $ci->encrypt->encode($key);
            $encode = str_replace(array('+', '/', '='), array('-', '_', '~'), $encode);
            $encode = urlencode($encode);
            return $encode;
        }
    }

    if(!function_exists('az_decode_url')){
        function az_decode_url($key = '') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $decode = urldecode($key);
            $decode = str_replace(array('-', '_', '~'), array('+', '/', '='), $decode);
            $decode = $ci->encrypt->decode($decode);
            return $decode;
        }
    }
