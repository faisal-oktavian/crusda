<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('az_remove_separator')){
        function az_remove_separator($key ='') {
            $ci = &get_instance();

            echo $key.'----';
            $data = str_replace(".", "", $key);
            echo $data;die;
            return $data;
        }
    }

    if(!function_exists('az_thousand_separator')){
        function az_thousand_separator($key ='') {
            $ci = &get_instance();

            $data = number_format($key, 0, "", ".");
          
            return $data;
        }
    }