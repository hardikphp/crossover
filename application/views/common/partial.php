<?php
//Error FlashData
if (get_flashdata("error")) {
    ?>
<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> <?php echo get_flashdata("error"); ?>. 
    </div>
    <?php
}
//Waring FlashData
if (get_flashdata("waring")) {
    ?>
    <div class="alert alert-warning " role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Warning!</strong> <?php echo get_flashdata("waring"); ?>. 
    </div>
    <?php
}
//Success FlashData
if (get_flashdata("success")) {
    ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success !</strong> <?php echo get_flashdata("success"); ?>. 
    </div>
    <?php
}
//Info FlashData
if (get_flashdata("info")) {
    ?>
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo get_flashdata("info"); ?>. 
    </div>
    <?php
}
?>