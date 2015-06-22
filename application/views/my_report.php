<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Crossover-Reports</title>
        <?php $this->load->view('common/head'); ?>
        <style>
            form.form-filter {
                overflow: hidden;
                margin-bottom: 10px;
            }
            form.form-filter fieldset {
                border: 1px solid #E5E5E5;
                margin: 0;
                padding: 10px;
            }
            form.form-filter fieldset legend {
                border: medium none;
                color: #333333;
                line-height: 20px;
                margin: 0;
                width: auto;
            }
            form.form-filter ul.search {
                clear: both;
                list-style: none outside none;
                margin: 0;
                overflow: hidden;
                padding: 0;
            }
            form.form-filter ul.search li {
                float: left;
                /*width: 230px;*/
                padding-right: 10px;
                margin-bottom: 5px;
            }
            form.form-filter ul.search li label
            {
                display: block;
            }
            form.form-filter ul.search li.action {
                margin-top: 25px;
            }
            .error{
                color: #A94442;
            }

            .filter-out{
                display: none;
            }
            .filter-in{
                display: block;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view("common/header", $meta) ?>

        <section id="contact" class="contact" style="text-align: justify">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>My Reports</h2>
                        <?php $this->load->view('common/partial'); ?>
                        <div class="panel panel-default filter-panel {{ Input::get('filter',false)?'filter-in':'filter-out'}}">
                            <div class="panel-heading">
                                <h3 class="panel-title">Searching</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-filter form-inline" role="form">
                                    <ul class="search">
                                        <li>
                                            <div class='form-group'>
                                                <label for="title" class="control-label">Document Title</label>
                                                <input type="text" name="title" value="<?php echo $this->input->get('title'); ?>" class="form-control" />
                                            </div>
                                        </li>
                                        <li class="action">
                                            <div class='form-group'>
                                                <input type="submit" value="Search" class="btn btn-info submit" />
                                                <!--<a href="<?php echo base_url("reports/index/") ?>" class="btn btn-default">Cancel</a>-->
                                            </div>
                                        </li>
                                        <li class="action">
                                            <div class='form-group'>
                                                <a href="<?php echo base_url("reports") ?>" class="btn btn-default" style="height: 43px;line-height:30px ">Cancel</a>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($documents) > 0) {
                                    $i = 1;
                                    foreach ($documents as $document) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $document->title ?></td>
                                            <td colspan=3""><a href="<?php echo base_url("/reports/view/" . $document->id); ?>" target="_blank" class="btn btn-info">View Detail</a>
                                            <a href="<?php echo base_url("/reports/download/" . $document->id); ?>" class="btn btn-info">Download</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!--Pagination-->
                        <ul class="pagination">
                            <?php echo $pages; ?>
                        </ul>
                        <!--/Pagination-->

                    </div>
                </div>
            </div>
        </section>
        <?php $this->load->view("common/footer"); ?>
    </body>
</html>