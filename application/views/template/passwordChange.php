<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
.body
{
	color:#333333;
}
.content {
	padding:10px 10px 10px 20px;
}
.middle {
	padding:5px 0 5px 0;
}
.main_body
{
	background:#FFFFFF;
}
</style>
</head>
<body>
<div class="main_body" >
  <div class="logo" style="padding:10px 10px 10px 20px;"><img src="<?php echo site_url(); ?>/images/logo.png" alt="Crossover"/></div>
  <div class="content"  style="color:#333333;padding:10px 10px 10px 20px;">
    <div class="title">
       <label style="color:#333333;">Hi</label> <label style="color:#3FAAD9;">  <?php echo $name; ?> </label>
    </div>
    <br />
    <div class="middle" style="color:#333333;"> The password for your Crossover Account - <label style="color:#3FAAD9;"><?php echo $email;?></label> - was recently changed.<br />
      <br />
      <label style="color:#333333;">if you made those changes you don't need to do anything more.</label><br />
    </div>
    <br />
    <div class="middle" style="color:#333333;"> if you didn't change your password,your account might be hijacked. To get back into your account, you will need to reset your password. </div>
    <br />
    <div class="middle" style="color:#333333;"> <a href="<?php echo $link;?>" target="_blank" style="color:#3FAAD9;">Reset password</a></div>
    <br />
    <div class="middle" style="color:#333333;"> Sicerely,<br />
     The Crossover Team </div>
  </div>
</div>
</body>
</html>