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
                        <!--//report view start here--> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        REGIONAL PHATHOLOGY LABORATRY<br/>   38 The Warren, Carshalton Beeches, Surrey SM5 4EH
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div>
                            <div id="myTabContent" class="tab-content">
                                <div id="home_first" style="width: 50%;float: left;"> 
                                    <label>Patient Name: </label>
                                    <span><?php echo ucfirst($report->patientname); ?></span>

                                </div> 
                                <div class="tab-pane active in" id="home_second" style="width: 50%;float: left;"> 
                                    <label>Case #: </label>
                                    <span><?php echo $report->id; ?></span>
                                </div>
                                <div id="home_first" style="width: 50%;float: left;"> 
                                    <label>Doctor ref ID: </label>
                                    <span><?php echo $report->doctor_id; ?></span>

                                </div> 
                                <div class="tab-pane active in" id="home_second" style="width: 50%;float: left;"> 
                                    <label>Address: </label>
                                    <span><?php echo $report->address; ?></span>
                                </div>

                            </div>

                        </div>

                        <div style="border:2px solid #ddd;float: left; width: 100%">
                            <center><h3><?php echo strtoupper($report->title); ?></h3></center>   
                            <div id="home_first" class="panel-body"> 
                                <label>Diagnosis: </label>
                                <span><?php echo ucfirst($report->diagnosis); ?></span>
                            </div> 
                        </div>
                        <div style="border:2px solid #ddd;float: left; width: 100%">
                            <div id="home_first" class="panel-body"> 
                                <label><?php echo ucfirst($report->extitle); ?></label>
                                <span><?php echo ucfirst($report->exdetail); ?></span>
                            </div>
                        </div>
                        <div class="panel-body right-span">
                            <span><?php echo $report->created_at; ?></span>
                        </div>
                        <center>
                            
                            <div class="btn-group panel-body">
                                <a href="<?php echo base_url("/reports/download/" . $report->id); ?>" class="btn btn-info">PRINT</a></td>
                        </div>
                        </center>
                    </div>
                
                </div>
            </div>
        </section>
        <?php $this->load->view("common/footer"); ?>
    </body>
</html>