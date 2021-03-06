<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Crossover</title>
        <?php $this->load->view('common/head'); ?>
        <style>
            body{overflow-y:scroll;}
            form p{
                color: inherit !important;
            }
            .panel-login {
                border-color: #ccc;
                -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
                -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
                box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            }
            .panel-login>.panel-heading {
                color: #00415d;
                background-color: #fff;
                border-color: #fff;
                text-align:center;
            }
            .panel-login>.panel-heading a{
                text-decoration: none;
                color: #666;
                font-weight: bold;
                font-size: 15px;
                -webkit-transition: all 0.1s linear;
                -moz-transition: all 0.1s linear;
                transition: all 0.1s linear;
            }
            .panel-login>.panel-heading a.active{
                color: #029f5b;
                font-size: 18px;
            }
            .panel-login>.panel-heading hr{
                margin-top: 10px;
                margin-bottom: 0px;
                clear: both;
                border: 0;
                height: 1px;
                background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
                background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
                background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
                background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            }
            .btn-login {
                background-color: #59B2E0;
                outline: none;
                color: #fff !important;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #59B2E6;
            }
            .btn-login:hover,
            .btn-login:focus {
                color: #fff;
                background-color: #53A3CD;
                border-color: #53A3CD;
            }
            .forgot-password {
                text-decoration: underline;
                color: #888;
            }
            .forgot-password:hover,
            .forgot-password:focus {
                text-decoration: underline;
                color: #666;
            }

            .btn-register {
                background-color: #1CB94E;
                outline: none;
                color: #fff!important;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #1CB94A;
            }
            .btn-register:hover,
            .btn-register:focus {
                color: #fff;
                background-color: #1CA347;
                border-color: #1CA347;
            }
        </style>
    </head>

    <body >
        <?php $this->load->view("common/header", $meta) ?>

        <section id="contact" class="contact" style="text-align: justify">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-login">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="<?php echo base_url() ?>auth/login"  id="login-form-link">Login</a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="<?php echo base_url() ?>auth/singup" class="active" id="register-form-link">Register</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php $this->load->view('common/partial'); ?>
                                        <form id="register-form" action="#" method="post" role="form" style="display: block;">
                                            <div class="form-group <?php echo (form_error("first_name")) ? "has-error" : "" ?>">
                                                <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="">
                                                <span class="help-block"><?php echo form_error("first_name") ?></span>
                                            </div>
                                            <div class="form-group <?php echo (form_error("last_name")) ? "has-error" : "" ?>">
                                                <input type="text" name="last_name" id="last_name" tabindex="2" class="form-control" placeholder="Last Name" value="">
                                                <span class="help-block"><?php echo form_error("last_name") ?></span>
                                            </div>
                                            <div class="form-group <?php echo (form_error("email")) ? "has-error" : "" ?>">
                                                <input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="Email Address" value="">
                                                <span class="help-block"><?php echo form_error("email") ?></span>
                                            </div>
                                            <div class="form-group <?php echo (form_error("password")) ? "has-error" : "" ?>">
                                                <input type="password" name="password" id="password" tabindex="4" class="form-control" placeholder="Password">
                                                <span class="help-block"><?php echo form_error("password") ?></span>
                                            </div>
                                            <div class="form-group <?php echo (form_error("conf_password")) ? "has-error" : "" ?>">
                                                <input type="password" name="conf_password" id="confirm-password" tabindex="5" class="form-control" placeholder="Confirm Password">
                                                <span class="help-block"><?php echo form_error("conf_password") ?></span>
                                            </div>
                                            <div class="form-group <?php echo (form_error("contact_no")) ? "has-error" : "" ?>">
                                                <input type="text" name="contact_no" id="contact_no" tabindex="5" class="form-control" placeholder="Contact No" value="">
                                                <span class="help-block"><?php echo form_error("contact_no") ?></span>
                                            </div>
                                            <div class="form-group <?php echo (form_error("organization")) ? "has-error" : "" ?>">
                                                <input type="text" name="organization" id="first_name" tabindex="6" class="form-control" placeholder="Organization" value="">
                                                <span class="help-block"><?php echo form_error("organization") ?></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="register-submit" id="register-submit" tabindex="7" class="form-control btn btn-register" value="Register Now" style="padding: 0px">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <?php $this->load->view("common/footer"); ?>
    </body>
</html>
