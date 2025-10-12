<?php
    $ci =& get_instance();
    $ci->load->helper("az_core");
    $ci->load->helper('az_menu');
    $ci->load->helper('az_config');
    $ci->load->helper('array');
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="<?php echo base_url().AZAPP_FRONT.'assets/logo/logo saja png - putih.png';?>" />

        <title>Admin - <?php echo az_get_config('app_name');?></title>

        <?php
        	echo az_css();
        ?>
        <script type="text/javascript">
            var base_url = "<?php echo base_url();?>"; 
            var app_url = "<?php echo app_url();?>";
        </script>  
	</head>
	<body>
        <div class="az-loading">
            <div>
                <img src="<?php echo base_url().AZAPP;?>assets/images/loading.gif?v3">
            </div>
        </div>

        <div class="az-ltheme">
            <!-- <div class="az-ltheme-image-header">
                <div class="image-header">
                    <img src="<?php echo base_url().AZAPP.'assets/images/header.jpg';?>"/>
                </div>
                <div class="header-content">
                    <div class="image-logo">
                        <img src="<?php echo base_url().AZAPP_FRONT.'assets/logo/logo.png';?>"/>
                    </div>
                    <div class="app-info">
                    </div>
                    <div class="account-box">
                        <div class="account">
                            <div class="account-container">
                                <div class="icon-user">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div>
                                    <?php echo $ci->session->userdata("name");?>
                                </div>
                            </div>
                            <div class="account-detail">
                                <div class="account-detail-content">
                                    <a href="<?php echo app_url().'account/change_password';?>"><button type="button" class="btn btn-primary az-btn-primary"><i class="fa fa-key"></i> <?php echo azlang('Change Password');?></button></a>
                                    <a href="<?php echo app_url().'login/logout';?>"><button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> <?php echo azlang('Logout');?></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="az-ltheme-body">
                <div class="az-menu-trigger-mobile"></div>
                <div class="az-ltheme-left" id="beautify-left">
                    <div class="az-menu-logo">
                        <img src="<?php echo base_url().AZAPP_FRONT.'assets/logo/logo saja png - putih.png';?>"/>
                    </div>
                    <?php
                        $outlet_name = $this->session->userdata('outlet_name');
                        if (strlen($outlet_name) == 0) {
                            $outlet_name = az_get_config('app_name');
                        }
                        if(strlen($outlet_name) > 0){ 
                    ?>
                        <div class="az-menu-outlet">
                            <i class=""></i><?php echo $outlet_name; ?>                                    
                        </div>
                    <?php } ?>
                    <div class="az-menu">
                        <?php 
                            $breadcrumb = azarr($data_header, 'breadcrumb', array());
                            echo az_generate_menu($breadcrumb);
                        ?>
                    </div>
                </div>
                <div class="az-ltheme-right" id="beautify-right">
                    <div class="az-content">
                        <div class="az-ltheme-header">
                            <button class="btn btn-beautify-menu" state="active">
                                <i class="fa fa-bars"></i>
                            </button>
                            <?php 
                                $active_lang = $ci->session->userdata('azlang');
                                if (strlen($active_lang) == 0) {
                                    $active_lang = 'indonesian';
                                    $ci->session->set_userdata('azlang', 'indonesian');
                                }
                                $arr_language = array();
                                $arr_language[] = array(
                                    'code' => 'id',
                                    'name' => 'Indonesian',
                                    'active' => '',
                                );
                                $arr_language[] = array(
                                    'code' => 'en',
                                    'name' => 'English',
                                    'active' => '',
                                );

                                if ($active_lang == 'indonesian') {
                                    $arr_language[0]['active'] = 'active';    
                                }
                                else {
                                    $arr_language[1]['active'] = 'active';
                                }

                            ?>
                            <div class="az-header-toolbar">
                                <button class="az-header-toolbar-user">
                                    <div class="az-header-toolbar-user-circle">
                                        <i class="fa fa-user-circle"></i>
                                        <!-- <i class="fa fa-user"></i> -->
                                    </div>
                                    &nbsp;
                                    <span class="text-capitalize"><?php echo $this->session->userdata('name') ?></span>
                                </button>
                                <div class="account-detail">
                                    <label class="text-disabled">Akun</label>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                               <i class="fa fa-store text-success"></i> &nbsp;<?php echo $outlet_name ?>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="<?php echo app_url().'account/change_password';?>">
                                               <i class="fa fa-key text-primary"></i> &nbsp;<?php echo azlang('Change Password') ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="<?php echo app_url().'login/logout';?>">
                                                <i class="fa fa-power-off text-danger"></i> &nbsp;<?php echo azlang('Logout') ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- <div class="account-detail-content">
                                        <a href="<?php echo app_url().'account/change_password';?>"><button type="button" class="btn btn-primary az-btn-primary"><i class="fa fa-key"></i> <?php echo azlang('Change Password');?></button></a>
                                        <a href="<?php echo app_url().'login/logout';?>"><button type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> <?php echo azlang('Logout');?></button></a>
                                    </div> -->
                                </div>
                            </div>
                            <div class="az-header-toolbar hide">
                                <div class="container-language">
                                    <div><?php echo azlang('Language');?> &nbsp;</div>
                                    <?php 
                                        foreach ($arr_language as $key => $value) {
                                            $url = app_url().'core/change_language/'.$value['code'];
                                            if ($value['active'] == 'active') {
                                                $url = 'javascript:void(0)';
                                            }
                                    ?>
                                    <div class="az-language-list"><a href="<?php echo $url;?>"><button class="btn btn-primary az-btn-primary <?php echo $value['active'];?>" title="<?php echo azlang($value['name']);?>"><?php echo strtoupper($value['code']);?></button></a></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="az-content-title">
                                <?php 
                                    echo azarr($data_header, 'title');
                                ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="az-breadcrumb">
                                    <!-- <span class="title">Judul</span> <i class="fa fa-chevron-right"></i> Sub judul <i class="fa fa-chevron-right"></i> sub judul lagi -->
                                    <?php echo az_generate_breadcrumb($breadcrumb);?>
                                </div>
                            </div>
                        </div>
                        <div class="az-content-container">
                        
                    