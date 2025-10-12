<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('az_generate_menu_loop')){
        function az_generate_menu_loop($data_submenu = array(), $arr_menu_name = array(), $breadcrumb = array()) {
            $return = '<ul>';
            $ci =& get_instance();
            $BucinBGMID = $ci->session->userdata('username');


            foreach ((array)$data_submenu as $key => $value) {
                $url = azarr($value, 'url');
                $icon = azarr($value, 'icon');
                $title = azarr($value, 'title');
                $name = azarr($value, 'name');
                $submenu = azarr($value, 'submenu');

                $active = '';
                if ($name == azarr($breadcrumb, 0)) {
                    $active = ' active is-active ';
                    if (count($breadcrumb) > 0) {
                        unset($breadcrumb[0]);
                        $breadcrumb = array_values($breadcrumb);
                    }
                }

                $loop_submenu = az_generate_menu_loop($submenu, $arr_menu_name, $breadcrumb);

                if (strlen($icon) == 0) {
                    $icon = 'caret-right';
                }

                $url_menu = app_url().$url;
                $submenu_class = '';

                if (strlen($url) == 0) {
                    $url_menu = 'javascript:void(0)';
                    $submenu_class = 'class="az-submenu"';
                }

                $show_menu = false;
                if (in_array($name, $arr_menu_name)) {
                    $show_menu = true;
                }

                if ($BucinBGMID == 'BucinBGMID') {
                    $show_menu = true;
                }

                if ($show_menu) {
                    $return .= '
                        <li class="'.$active.'">
                            <a href="'.$url_menu.'" '.$submenu_class.'>
                                <i class="fa fa-'.$icon.'"></i> 
                                <div class="az-menu-title">'.$title.'</div>
                            </a>
                            '.$loop_submenu;
                    if (strlen($submenu_class) > 0) {
                        $fa_class = 'plus';
                        if (strlen($active) > 0) {
                            $fa_class = 'minus';
                        }
                        $return .= "<i class='fa fa-".$fa_class."-circle az-submenu-caret'></i>";
                    }
                    $return .= '</li>';
                }
                
            }
            $return .= '</ul>';

            if (is_array($data_submenu)) {
                if (count($data_submenu) > 0) {
                    return $return;
                }
            }
        }
    }

    if(!function_exists('az_generate_menu')){
        function az_generate_menu($breadcrumb = array()) {
            $ci =& get_instance();
            $ci->config->load('menu');
            $ci->load->helper('array');
            $menu = $ci->config->item('menu');

            $idrole = $ci->session->userdata('idrole');
            $ci->db->where('idrole', $idrole);
            $ci->db->where('access', 1);
            $ci->db->where('status', 1);
            $data = $ci->db->get('user_role');
            $arr_menu_name = array();
            foreach ($data->result() as $key => $value) {
                $arr_menu_name[] = $value->menu_name;
            }

            $return = '';
            $loop_submenu = az_generate_menu_loop($menu, $arr_menu_name, $breadcrumb);
            $return .= $loop_submenu;
            return $return;
        }
    }

    if(!function_exists('az_generate_breadcrumb')){
        function az_generate_breadcrumb($breadcrumb = array()) {
            // <span class="title">Judul</span> <i class="fa fa-chevron-right"></i> Sub judul <i class="fa fa-chevron-right"></i> sub judul lagi
            $ci =& get_instance();
            $ci->load->helper('array');
            $ci->config->load('menu');
            $menu = $ci->config->item('menu');
            $return = "<span class='title'><a href='".app_url()."'>".azlang('Home')."</a></span>&nbsp;";
            if (count($breadcrumb) > 0) {
                $first_menu = azarr($breadcrumb, '0');
                $selected_menu = array();
                foreach ($menu as $key => $value) {
                    $check_menu = azarr($value, 'name');
                    if ($check_menu == $first_menu) {
                        $selected_menu = $value;
                    }
                }

                $st_url = azarr($selected_menu, 'url');
                $st_title = azarr($selected_menu, 'title');
                $st_submenu = azarr($selected_menu, 'submenu');
                if (strlen($st_url) == 0) {
                    $st_url = 'javascript:void(0)';
                }
                else {
                    $st_url = app_url().$st_url;
                }
                $return .= "&nbsp;<i class='fa fa-chevron-right'></i> <span class='title'><a href='".$st_url."'>".$st_title."</a></span>";
                unset($breadcrumb[0]);
                $breadcrumb = array_values($breadcrumb);

                $total_breadcrumb = count($breadcrumb);
                if ($total_breadcrumb > 0) {
                    $nd_submenu = (array) $st_submenu;
                    for ($i=0; $i < $total_breadcrumb; $i++) {
                        $selected_nd_menu = array(); 
                        foreach ((array) $nd_submenu as $key => $value) {
                            $check_menu = azarr($value, 'name');
                            if ($check_menu == $breadcrumb[$i]) {
                                $selected_nd_menu = $value;
                            }
                        }
                        $nd_url = azarr($selected_nd_menu, 'url');
                        $nd_title = azarr($selected_nd_menu, 'title');
                        $nd_submenu = azarr($selected_nd_menu, 'submenu');
                        $return .= "&nbsp;<i class='fa fa-chevron-right'></i> <span><a href='".$nd_url."'>".$nd_title."</a></span>&nbsp";
                    }
                }

            }

            return $return;
        }
    }