<!-- HEADER
    ================================================== -->
<header>
    <div class="navbar navbar-custom navbar-static-top sticky" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- LOGO -->
                <a class="navbar-brand logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.jpg" alt="logo"></a>
            </div> <!-- end navbar-header -->
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right menu-effect">
                     <li><a href="<?php echo base_url();?>">Home</a></li>
                      <?php
                    if (!get_userdata("userarea")) {
                        ?>
                        <li><a href="<?php echo base_url(); ?>auth/login">Login</a></li>
                    <?php } else {
                        ?>
                        <li><a href="<?php echo base_url(); ?>reports">Reports</a></li>
                        <li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
                    <?php } ?>
                </ul>
            </div> <!--/.nav-collapse -->
        </div> <!-- end container -->
    </div>
</header><!-- end header -->