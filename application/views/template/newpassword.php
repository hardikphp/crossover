<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Crossover</title>
</head>
<body>
<div class="main_body">
  <div class="logo" style="padding:10px 10px 10px 20px;"><img src="<?php echo site_url(); ?>/images/logo.png" alt="Crossover"/></div>
  <div class="content"  style="color:#333333;padding:10px 10px 10px 20px;">
    <div class="title">
      <label style="color:#333333;">Hi</label> <label style="color:#3FAAD9;"><?php echo $name; ?> </label>
    </div>
    <br />
    <div class="middle" style="color:#333333;padding:5px 0 5px 0;"> Changing your password is simple. Please use the link below before 24 hours. </div>
    <div class="middle" style="color:#3FAAD9;"><a href="<?php echo $link;?>" target="_blank" style="color:#3FAAD9;"><?php echo $link; ?></a><br />
    <br />
    <br />
    <div class="middle" style="color:#333333;"> Thank you,<br />
    The Crossover Team </div>
    </div>
</div>
</div>
</body>
</html>