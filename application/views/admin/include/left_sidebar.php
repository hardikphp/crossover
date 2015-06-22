<?php
$ci = & get_instance();
$current_controller = $ci->router->fetch_class();
?>
<div class="sidebar-nav">
    <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Dashboard</a>

    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Patient Management<span class="label label-info">+1</span></a>
    <ul id="accounts-menu" class="nav nav-list collapse <?php echo (in_array($current_controller, array("patients","groups")))?"in":"" ?>">
        <li ><a href="<?php echo base_url(); ?>admin/patients">Patients</a></li>
       
    </ul>


    <a href="#cms-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Report Management<span class="label label-info">+1</span></a>
    <ul id="cms-menu" class="nav nav-list collapse <?php echo (in_array($current_controller, array("reports")))?"in":"" ?>">
        <li ><a href="<?php echo base_url(); ?>admin/reports">Reports</a></li>
    </ul>

</div>


