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
                <h1 class="page-title">Reports</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>admin/home">Home</a> <span class="divider">/</span></li>
                <li class="active">Reports</li>
            </ul>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="btn-toolbar"> <a href="<?php echo base_url(); ?>admin/reports/add">
                            <button class="btn btn-primary" id="newreport"><i class="icon-plus"></i> Add Report</button>
                        </a>


                        <!-- <button class="btn">Import</button>
                    <button class="btn">Export</button>-->
                        <div class="btn-group"> <form name="project_search" action="" method="post" style="margin-left:10px; margin-top:25px;">
                                <input type="text" name="search" class="input" id="search" placeholder="Search" onBlur="submitform();" value="<?php echo (isset($_POST['search'])) ? $_POST['search'] : ''; ?>"> 
                            </form> </div>
                    </div>
                    <div class="well">
                        <form name="product_list" action="" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                       <th width="5%">Report ID</th>
                                        <th width="">Patient Name</th>
                                        <th width="">Report title</th>
                                        <th width="">Diagnostics</th>
                                        <th width="">Examination title</th>
                                        <th width="">Examination <br/> description</th>
                                        <th width="">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datas as $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $data->id ?></td>
                                            <td><?php echo $data->patientname ?></td>
                                            <td><?php echo $data->title ?></td>
                                            <td><?php echo $data->diagnosis ?></td>
                                            <td><?php echo $data->extitle ?></td>
                                            <td><?php echo $data->exdetail ?></td>
                                             <td><?php echo $data->created_at ?></td>
                                            <td>
                                                <a href="<?php echo base_url() ?>admin/reports/edit/<?php echo $data->id ?>" class="btn btn-info"><i class="icon-edit"></i></a>
                                                <a href="#myModal" role="button" data-toggle="modal" id="<?php echo $data->id; ?>" class="btn btn-danger"><i class="icon-remove"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </form>
                    </div>
                    <div class="pagination">
                        <ul>
                            <?php echo $pages; ?>
                        </ul>
                    </div>
                    <!--<div class="pagination">
              
                  <ul>
                      <li><a href="#">Prev</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">Next</a></li>
                  </ul>
              </div>
              
                    -->
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
                            <button class="btn btn-danger" data-dismiss="modal" id="delete" value="">Delete</button>
                        </div>
                    </div>
                    <?php $this->load->view('admin/include/footer'); ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            $(function () {
                $('#delete').click(function () {
                    var id = $(this).val();
                    window.location.href = "<?php echo base_url() ?>admin/reports/delete/" + id;
                });

            });

        </script>
    </body>
</html>