<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('admin/include/head'); ?>
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
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
                <h1 class="page-title">Edit Patient</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/home">Home</a> <span class="divider">/</span></li>
                <li><a href="#">Patients</a> <span class="divider">/</span></li>
                <li class="active">Edit Patient</li>
            </ul>
            <div class="container-fluid">
                <div class="row-fluid">
                    <form id="add_page" method="post" action="" name="add_page">
                        <div class="btn-toolbar">
                            <button class="btn btn-primary" id="submit"><i class="icon-save"></i> Update</button>
                            <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
                            <!-- <a href="#myModal" data-toggle="modal" class="btn">Delete</a>-->
                            <div class="btn-group"> </div>
                        </div>
                        <div class="well">
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane active in" id="home">  
                                    <input type="hidden" name="id" value="<?php echo $patient->id ?>" />
                                    <label>First Name <span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('first_name',$patient->first_name) ?>" class="input" name="first_name">
                                    <label class="help-inline error"><?php echo form_error('first_name'); ?></label>

                                    <label>Last Name <span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('last_name',$patient->last_name) ?>" class="input" name="last_name">
                                    <label class="help-inline error"><?php echo form_error('last_name'); ?></label>

                                    <label>Email <span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('email',$patient->email) ?>" class="input" name="email">
                                    <label class="help-inline error"><?php echo form_error('email'); ?></label>
                                    
                                    <label>Password</label>
                                    <input type="password" value="" class="input" name="password">
                                    <label class="help-inline error"><?php echo form_error('password'); ?></label>

                                    <label>Conform Password</label>
                                    <input type="password" value="" class="input" name="conf_password">
                                    <label class="help-inline error"><?php echo form_error('conf_password'); ?></label>

                                    <label>Contact No</label>
                                    <input type="text" value="<?php echo set_value('contact_no',$patient->contact_no) ?>" class="input" name="contact_no">
                                    <label class="help-inline error"><?php echo form_error('contact_no'); ?></label>

                                    <label>Address</label>
                                    <input type="text" value="<?php echo set_value('address',$patient->address) ?>" class="input" name="address">


                                    <label>Status:</label>
                                    <?php echo set_select('is_active',$patient->is_active) ?>
                                    <?php echo form_dropdown('is_active', array('1' => "Active", '0' => "De-Active")); ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Delete Confirmation</h3>
                        </div>
                        <div class="modal-body">
                            <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the patient?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            <button class="btn btn-danger" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                    <?php $this->load->view('admin/include/footer'); ?>
                </div>
            </div>
        </div>

    </body>
</html>