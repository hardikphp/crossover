<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Crossover</title>
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
                color: #fff;
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
                                        <a href="<?php echo base_url() ?>auth/forgotpassword" class="active" id="login-form-link">Forget Password</a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="<?php echo base_url() ?>auth/login" id="register-form-link">Login</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php $this->load->view('common/partial'); ?>
                                        <form id="forget_password_form" action="" method="post" role="form" style="display: block;" name="forget_password_form">
                                            <div class="form-group <?php echo (form_error("email")) ? "has-error" : "" ?>">
                                                <input type="email" name="email" id="username" tabindex="1" class="form-control" placeholder="Email Address" value="" >
                                                <span class="help-block"><?php echo form_error("email") ?></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Done" style="padding: 0px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <a href="<?php echo base_url(); ?>auth/singup" tabindex="5" class="forgot-password">Create a new account?</a>
                                                        </div>
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

<!--        <div class="container">
            <form method="post" action="" name="forget_password_form">

                <?php $this->load->view('common/partial'); ?>
                <br/>
                <label for="email">Email:</label>
                <input type="text" name="email" value="<?php echo set_value('email') ?>" />
                <span><?php echo form_error("email") ?></span>
                <br/>

                <div class="btn-toolbar">
                    <button class="btn btn-primary" id="submit"><i class="icon-save"></i>Done</button>
                    <a href="<?php echo base_url() ?>" class="btn">Cancel</a>
                     <a href="#myModal" data-toggle="modal" class="btn">Delete</a>
                    <div class="btn-group"> </div>
                </div>
            </form>
        </div>-->

        <?php $this->load->view("common/footer"); ?>
    </body>
</html>