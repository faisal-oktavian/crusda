<?php 
    $this->load->helper('az_config');
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="<?php echo base_url().AZAPP_FRONT.'assets/logo/favicon.png';?>" />
        <title><?php echo az_get_config('app_name');?> - LOGIN</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/az-core/az-core.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/az-core/az-core-left-theme.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url().AZAPP;?>assets/plugins/az_theme/az_theme.css?v2.1" type="text/css" />
        <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <style type="text/css">
            .login-container-content {
                box-shadow: 0 5px 13px 3px rgba(166, 166, 166, 0.14);
                background: #fff;
            }
            .btn-three {
                background: #6acbfc;
            }
            @media (max-width: 767px) {
                .bg-login {
                    width: auto;
                }
            }
            .form-control {
                border: 1px solid #6acbfc38;
                color: #6acbfc;
            }
                .form-control:focus {
                    border-color: #9bdeff;
                    box-shadow: 0 0 8px rgb(156, 223, 252);
                }
        </style>
	</head>
	<body style="background-color:rgb(209, 237, 255);width:100%;overflow-x:hidden;">
        <div class="background-wrap">
            <img class="bg-login" src="<?php echo base_url().AZAPP;?>assets/images/header.jpg?v2">
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="login-container">
                    <div class="login-container-content">
                        <div class="login-logo">
                            <img src="<?php echo base_url().AZAPP_FRONT;?>assets/logo/logo.png"/>
                        </div>
                        <form method="POST" action="login/process">
                            <?php 
                                $err_login = $this->session->flashdata("error_login");
                                if (strlen($err_login) > 0) {
                                    echo "<div class='login-error-message'>".$err_login."</div>";
                                }
                            ?>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <br>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <br>
                            <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                            <br>
                            <div class="txt-right">
                                <button type="submit" class="btn btn-info btn-three">Login</button>
                            </div>
                            <br>
                            <div class="login-copyright">
                                Copyright &copy; 2018 <a target="_blank" href="http://www.printsoft.com">Printsoft</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </body>
</html>
<script type="text/javascript">
    setTimeout(function(){
        jQuery(".login-error-message").hide("slow")
    }, 5000);
</script>