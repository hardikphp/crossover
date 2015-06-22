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

                <table>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td><?php echo $subject; ?></td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td><?php echo $message; ?></td>
                    </tr>
                </table>

                <br />
                <br />
                <div class="middle" style="color:#333333;"> Thank you,<br />
                    The Crossover Team </div>
            </div>
        </div>
        </div>
    </body>
</html>