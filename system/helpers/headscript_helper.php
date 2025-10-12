<?php
defined('BASEPATH') OR exit('No direct script access allowed');   

    if(!function_exists('add_js')){
        function add_js($file='')
        {
            $str = '';
            $ci = &get_instance();
            $header_js  = $ci->config->item('header_js');
     
            if(empty($file)){
                return;
            }
     
            if(is_array($file)){
                if(!is_array($file) && count($file) <= 0){
                    return;
                }
                foreach($file AS $item){
                    $header_js[] = $item;
                }
                $ci->config->set_item('header_js',$header_js);
            }else{
                $str = $file;
                $header_js[] = $str;
                $ci->config->set_item('header_js',$header_js);
            }
        }
    }
     
    //Dynamically add CSS files to header page
    if(!function_exists('add_css')){
        function add_css($file='')
        {
            $str = '';
            $ci = &get_instance();
            $header_css = $ci->config->item('header_css');
     
            if(empty($file)){
                return;
            }
     
            if(is_array($file)){
                if(!is_array($file) && count($file) <= 0){
                    return;
                }
                foreach($file AS $item){   
                    $header_css[] = $item;
                }
                $ci->config->set_item('header_css',$header_css);
            }else{
                $str = $file;
                $header_css[] = $str;
                $ci->config->set_item('header_css',$header_css);
            }
        }
    }
     
    if(!function_exists('put_headers')){
        function put_headers()
        {
            $str = '';
            $ci = &get_instance();
            $header_css = $ci->config->item('header_css');
            $header_js  = $ci->config->item('header_js');
     
            foreach($header_css AS $item){
                $str .= '<link rel="stylesheet" href="'.base_url().'assets/plugins/'.$item.'" type="text/css" />'."\n";
            }
     
            foreach($header_js AS $item){
                $str .= '<script type="text/javascript" src="'.base_url().'assets/plugins/'.$item.'"></script>'."\n";
            }
     
            return $str;
        }
    }

    if(!function_exists('generate_menu')){
        function generate_menu($active_menu = '', $active_submenu = '', $submenu = '') {
            $ci = &get_instance();
            $arr_menu = $ci->config->item('menu');

            $div_submenu = '';
            if (strlen($submenu) > 0) {
                $arr_menu = $ci->config->item('menu');
                $arr_menu = $arr_menu[$submenu]['submenu'];
                $div_submenu = '-submenu';
            }
            $return = "";
            foreach ($arr_menu as $key => $menu) {
                $active = "";
                if ($menu['name'] == $active_menu) {
                    $active = "active ";
                }
                $active2 = "";
                if ($menu['name'] == $active_submenu) {
                    $active2 = " active ";
                }
                $return .= '<li>
                    <a href="'.app_url().$menu['url'].'">
                        <div class="'.$active.$active2.'menu-container'.$div_submenu.'">';

                if (strlen($menu['icon']) > 0) {
                    $return .= '<div>
                                <img src="'.base_url().'assets/images/icon/'.$menu['icon'].'"/>
                            </div>';
                }

                $return .= '<div>
                                '.$menu['name'].'
                            </div>
                        </div>
                    </a>';
                
                if (count($menu['submenu']) > 0) {
                    $return .= '<ul><div class="submenu-caret"></div><div class="submenu-box">';
                    $return .= generate_menu($active_menu, $active_submenu, $key);
                    $return .= '</div></ul>';
                }
                $return .= '</li>';
            }

            return $return;
        }
    }