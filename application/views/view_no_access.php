<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
</head>
<body>
<?php echo $this->load->view('header'); ?>

<div class="row">
<div class="col-md-12">
<div class="well well-lg" style="overflow:hidden;">

    <div class="alert alert-danger alert-dismissible" role="alert">
    <?php
    echo $msg;
    ?>
    </div>
</div>
</div>
</div>

<?php echo $this->load->view('footer'); ?>
