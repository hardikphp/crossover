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
                <h1 class="page-title">Add Report</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/home">Home</a> <span class="divider">/</span></li>
                <li><a href="#">Reports</a> <span class="divider">/</span></li>
                <li class="active">Add Report</li>
            </ul>
            <div class="container-fluid">
                <div class="row-fluid">
                    <form id="add_page" method="post" action="" name="add_page">
                        <div class="btn-toolbar">
                            <button class="btn btn-primary" id="submit"><i class="icon-save"></i> Save</button>
                            <a href="<?php echo base_url();?>admin/reports" class="btn"> Cancel</a>
                            <div class="btn-group"> </div>
                        </div>
                        <div class="well">
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane active in" id="home">  
                                    <label>Select patient</label>
                                    <?php echo set_select('id') ?>
                                    <?php echo form_dropdown('id', $patients); ?> 
                                    
                                    <label>Doctor id</label>
                                    <input type="text" value="<?php echo set_value('doctor_id') ?>" class="input" name="doctor_id">
                                    <label class="help-inline error"><?php echo form_error('doctor_id'); ?></label>
                                    
                                    <label>Test title<span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('title') ?>" class="input" name="title">
                                    <label class="help-inline error"><?php echo form_error('title'); ?></label>

                                    <label>Test description<span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('desc') ?>" class="input" name="desc">
                                    <label class="help-inline error"><?php echo form_error('desc'); ?></label>
                                    
                                    <label>Diagnosis<span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('diagnosis') ?>" class="input" name="diagnosis">
                                    <label class="help-inline error"><?php echo form_error('diagnosis'); ?></label>
                                    
                                    <label>Examination title <span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('extitle') ?>" class="input" name="extitle">
                                    <label class="help-inline error"><?php echo form_error('extitle'); ?></label>
                                    
                                    
                                    <label>Examination detail <span class="error">*</span></label>
                                    <input type="text" value="<?php echo set_value('exdetail') ?>" class="input" name="exdetail">
                                    <label class="help-inline error"><?php echo form_error('exdetail'); ?></label>
                                    <label>Status:</label>
                                    <?php echo set_select('is_active') ?>
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
                            <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the report?</p>
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