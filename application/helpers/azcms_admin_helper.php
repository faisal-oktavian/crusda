<?php
defined('BASEPATH') OR exit('No direct script access allowed');   
    
    if(!function_exists('az_select_outlet')){
        function az_select_outlet($id = 'outlet', $class='', $attr='outlet') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_outlet');
            $select->set_placeholder('Pilih Outlet');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idoutlet'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_outlet_all')){
        function az_select_outlet_all($id = 'outlet', $class='', $attr='outlet') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_outlet_all');
            $select->set_placeholder('Pilih Outlet');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idoutlet'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if (!function_exists('get_url_key')) {
        function az_get_url_key($table, $name, $idpost) {
            $ci =& get_instance();
            $url_key = url_title($name, '-', true);
             if (strlen($idpost) > 0) {
               $ci->db->where('id'.$table .' != '. $idpost);
            }
            $ci->db->where('url_key', $url_key);
            $ci->db->where('status', 1);
            $data = $ci->db->get($table);

            if ($data->num_rows() > 0) {
                $db_url_key = $data->row()->url_key;
                $x_url_key = explode('-', $db_url_key);
                $end_url_key = end($x_url_key);
                if (is_numeric($end_url_key)) {
                    $url_key = $url_key.'-'.($end_url_key + 1);
                }
                else {
                    $url_key = $url_key.'-1';
                }
            }
            return $url_key;
        }
    }

    if(!function_exists('az_select_nama_urusan')){
        function az_select_nama_urusan($id = 'urusan', $class='', $attr='urusan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_urusan_pemerintah');
            $select->set_placeholder('Pilih Urusan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idurusan_pemerintah'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_bidang_urusan')){
        // function az_select_nama_bidang_urusan($id = 'bidang_urusan', $class='', $attr='bidang_urusan', $parent = 'idurusan_pemerintah') {
        function az_select_nama_bidang_urusan($id = 'bidang_urusan', $class='', $attr='bidang_urusan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            // $select->set_select_parent($parent);
            $select->set_url('data/get_bidang_urusan');
            $select->set_placeholder('Pilih Bidang Urusan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idbidang_urusan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }
    
    if(!function_exists('az_select_nama_bidang_urusan_parent')){
        function az_select_nama_bidang_urusan_parent($id = 'bidang_urusan', $class='', $attr='bidang_urusan', $parent = 'idurusan_pemerintah') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_select_parent($parent);
            $select->set_url('data/get_bidang_urusan_parent');
            $select->set_placeholder('Pilih Bidang Urusan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idbidang_urusan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_program')){
        // function az_select_nama_program($id = 'program', $class='', $attr='program', $parent = 'idbidang_urusan') {
        function az_select_nama_program($id = 'program', $class='', $attr='program') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            // $select->set_select_parent($parent);
            $select->set_url('data/get_program');
            $select->set_placeholder('Pilih Program');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idprogram'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_program_parent')){
        function az_select_nama_program_parent($id = 'program', $class='', $attr='program', $parent = 'idbidang_urusan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_select_parent($parent);
            $select->set_url('data/get_program_parent');
            $select->set_placeholder('Pilih Program');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idprogram'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_kegiatan')){
        // function az_select_nama_kegiatan($id = 'kegiatan', $class='', $attr='kegiatan', $parent = 'idbidang_urusan') {
        function az_select_nama_kegiatan($id = 'kegiatan', $class='', $attr='kegiatan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            // $select->set_select_parent($parent);
            $select->set_url('data/get_kegiatan');
            $select->set_placeholder('Pilih Kegiatan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idkegiatan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_kegiatan_parent')){
        function az_select_nama_kegiatan_parent($id = 'kegiatan', $class='', $attr='kegiatan', $parent = 'idprogram') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_select_parent($parent);
            $select->set_url('data/get_kegiatan_parent');
            $select->set_placeholder('Pilih Kegiatan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idkegiatan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }
    
    if(!function_exists('az_select_nama_sub_kegiatan')){
        // function az_select_nama_sub_kegiatan($id = 'kegiatan', $class='', $attr='kegiatan', $parent = 'idbidang_urusan') {
        function az_select_nama_sub_kegiatan($id = 'sub_kegiatan', $class='', $attr='sub_kegiatan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            // $select->set_select_parent($parent);
            $select->set_url('data/get_sub_kegiatan');
            $select->set_placeholder('Pilih Sub Kegiatan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idsub_kegiatan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_sub_kegiatan_parent')){
        function az_select_nama_sub_kegiatan_parent($id = 'sub_kegiatan', $class='', $attr='sub_kegiatan', $parent = 'idkegiatan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_select_parent($parent);
            $select->set_url('data/get_sub_kegiatan_parent');
            $select->set_placeholder('Pilih Sub Kegiatan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idsub_kegiatan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_akun_belanja')){
        function az_select_nama_akun_belanja($id = 'akun_belanja', $class='', $attr='akun_belanja') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_akun_belanja');
            $select->set_placeholder('Pilih Akun Belanja');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idakun_belanja'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_kategori')){
        function az_select_nama_kategori($id = 'kategori', $class='', $attr='kategori') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_kategori');
            $select->set_placeholder('Pilih Kategori');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idkategori'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }
    
    if(!function_exists('az_select_nama_subkategori')){
        function az_select_nama_subkategori($id = 'sub_kategori', $class='', $attr='sub_kategori') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_subkategori');
            $select->set_placeholder('Pilih Sub Kategori');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idsub_kategori'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_satuan')){
        function az_select_nama_satuan($id = 'satuan', $class='', $attr='satuan') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_satuan');
            $select->set_placeholder('Pilih Satuan');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idsatuan'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_uraian_parent')){
        function az_select_nama_uraian_parent($id = 'paket_belanja_detail_sub', $class='', $attr='paket_belanja_detail_sub', $parent = 'idpaket_belanja') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_select_parent($parent);
            $select->set_url('data/get_paket_belanja_detail_sub_parent');
            $select->set_placeholder('Pilih Uraian');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idpaket_belanja_detail_sub'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_nama_ruang')){
        function az_select_nama_ruang($id = 'ruang', $class='', $attr='ruang') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            // $select->set_select_parent($parent);
            $select->set_url('data/get_room');
            $select->set_placeholder('Pilih Ruang');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idruang'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_sumber_dana')){
        function az_select_sumber_dana($id = 'sumber_dana', $class='', $attr='sumber_dana') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_sumber_dana');
            $select->set_placeholder('Pilih Sumber Dana');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idsumber_dana'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }

    if(!function_exists('az_select_kode_rekening')){
        function az_select_kode_rekening($id = 'kode_rekening', $class='', $attr='kode_rekening') {
            $ci =& get_instance();
            $ci->load->library('encrypt');
            $azapp = $ci->load->library('AZApp');
            $select = $ci->azapp->add_select2();
            $select->set_id($id);
            $select->set_url('data/get_kode_rekening');
            $select->set_placeholder('Pilih Kode Rekening');
            if (strlen($class) > 0) {
                $select->add_class($class);
            }
            if (strlen($attr) > 0) {
                $select->add_attr('data-id', $ci->encrypt->encode($attr.'.idkode_rekening'));
                $select->add_attr('w', 'true');
            }
            
            return $select->render();
        }
    }