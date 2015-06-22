<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/include/head'); ?>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="<?php echo base_url();?>admin/login"><span class="first">Crossover</span> <span class="second">Admin</span></a>
        </div>
    </div>
    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Sign In</p>
            <div class="block-body">
            <label class="error"><?php if(isset($message_error)){ echo $message_error;} ?></label>
                <form method="post" name="login" id="login" action="<?php echo base_url();?>admin/login/validate_credentials">
                    <label>Username</label>
                    <input type="text" class="span12" name="user_name">
                    <label>Password</label>
                    <input type="password" class="span12" name="password">
                    <?php  echo form_submit('submit', 'Login', 'class="btn btn-primary pull-right"'); ?>
                    <label class="remember-me"><input type="checkbox"> Remember me</label>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
       
    </div>
</div>

    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


