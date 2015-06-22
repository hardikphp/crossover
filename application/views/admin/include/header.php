 <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo $this->session->userdata('user_name'); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?php echo base_url();?>admin/home/logout/">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="<?php echo base_url();?>admin/home"><span class="first">Crossover</span> <span class="second"></span></a>
        </div>
    </div>