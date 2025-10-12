<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>AZ xx - LOGIN</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/az-core/az-core.css" type="text/css" />
        <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
	</head>
	<body style="background-color:rgb(209, 237, 255);width:100%;overflow-x:hidden;">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="login-container">
                    <div class="login-container-content">
                        <div class="login-logo">
                            <img src="<?php echo base_url();?>application/azkasir/default/assets/images/logo.png"/>
                        </div>
                        <form method="POST" action="login/process">
                            <?php 
                                $err_login = $this->session->flashdata("error_login");
                                if (strlen($err_login) > 0) {
                                    echo "<div class='login-error-message'>".$err_login."</div>";
                                }
                            ?>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            Username
                            <input type="text" name="username" class="form-control">
                            <br>
                            Password
                            <input type="password" name="password" class="form-control">
                            <br><br>
                            <div class="txt-right">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="login-copyright">
            Copyright &copy; 2016 <a target="_blank" href="http://www.azostech.com">Azos Technology</a>
        </div>
        <div style="margin-top:30px;text-align:center">
            <b>ADMIN</b><br>
            user: administrator, pass: password
            <br><br>
            <b>KASIR</b><br>
            user: kasir1, pass: 1234
        </div>
    </body>
</html>
<script type="text/javascript">
    setTimeout(function(){
        jQuery(".login-error-message").hide("slow")
    }, 5000);
</script>