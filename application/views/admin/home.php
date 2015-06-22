<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('admin/include/head'); ?>
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
   
  <?php $this->load->view('admin/include/header'); ?>  


  <?php $this->load->view('admin/include/left_sidebar'); ?>
 
    <div class="content">
        
        <div class="header">
            <div class="stats">
   <!-- <p class="stat"><span class="number">53</span>tickets</p>
    <p class="stat"><span class="number">27</span>tasks</p>
    <p class="stat"><span class="number">15</span>waiting</p> -->
</div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home">Home</a> <span class="divider">/</span></li>
            <li class="active">Dashboard</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">

    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Just a quick note:</strong> Hope you like the theme!
    </div>

    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Latest Stats</a>
        <div id="page-stats" class="block-body collapse in">

            <div class="stat-widget-container">
             <div class="stat-widget">
                    <div class="stat-button">
                        <p class="title">Welcome</p>
                        <p class="detail">Dashboard</p>
                    </div>
                </div>
             </div>
        </div>
    </div>
</div>

                     <?php $this->load->view('admin/include/footer'); ?>
                    
            </div>
        </div>
    </div>
    


  
    
  </body>
</html>


