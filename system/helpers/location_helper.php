<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

	if ( ! function_exists('get_province')) {
        function get_province($idprovince) {
            $ci =& get_instance();
            $ci->load->helper('array');
            $ci->load->library('RajaOngkir');

            $province = $ci->rajaongkir->province($idprovince);
            $province = json_decode($province, true);
            $province = element('rajaongkir', $province, array());
            $province = element('results', $province, array());
            $province = element('province', $province, '');

            return $province;
        }
    }

    if ( ! function_exists('get_city')) {
        function get_city($idcity) {
            $ci =& get_instance();
            $ci->load->helper('array');
            $ci->load->library('RajaOngkir');

            $city = $ci->rajaongkir->get_city($idcity);
            $city = json_decode($city, true);
            $city = element('rajaongkir', $city, array());
            $city = element('results', $city, array());
            $city = element('city_name', $city, '');

            return $city;  
        }
    }

    if ( ! function_exists('get_district')) {
        function get_district($iddistrict) {
            $ci =& get_instance();
            $ci->load->helper('array');
            $ci->load->library('RajaOngkir');

            $district = $ci->rajaongkir->get_subdistrict($iddistrict);
            $district = json_decode($district, true);
            $district = element('rajaongkir', $district, array());
            $district = element('results', $district, array());
            $district = element('subdistrict_name', $district, '');

            return $district;
        }
    }