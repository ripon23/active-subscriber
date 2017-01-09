<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
</head>
<body>
<?php echo $this->load->view('header'); ?>
<div class="cl-md-12">
	<?php if ($this->session->flashdata('parmission')):?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-info-sign"></span>
        	<strong>Warning!</strong>
			<?php
            echo  $this->session->flashdata('parmission');
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <?php endif;?>
</div>
<div class="row">
<div class="col-md-9">
<div class="well well-lg" style="overflow:hidden;">

<?php
if($this->authorization->is_permitted('view_aponjon_member'))
{
?> 
<div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><?=lang('menu_aponjon_register')?></h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
        	<li><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <a href="./aponjon_register/view_data/"><?=lang('view_aponjon_member_list')?> </a></li>
        	<li>&nbsp;</li>
            <li>&nbsp;</li>
        </ul>       
        
      </div>
    </div>
</div>
<?php 
}
?>



<?php
if($this->authorization->is_permitted('cms_view_news'))
{
?>
<div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading ">
        <h3 class="panel-title"><?php echo lang('menu_news_mangement')?></h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
            <li><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/news"><?php echo lang('menu_news_list')?> </a></li>
            <li><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/news/save"> <?php echo lang('menu_news_add')?> </a></li>
            <li>&nbsp;</li>           
            
        </ul>
      </div>
    </div>
</div>
<?php 
}
?>

<?php
if($this->authorization->is_permitted('cms_view_page'))
{
?>
<div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo lang('menu_page_mangement')?></h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
            <li><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/pages"><?php echo lang('menu_page_list')?> </a></li>
            <li><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/pages/save"> <?php echo lang('menu_page_add')?> </a></li>
            <li>&nbsp;</li>         
            
        </ul>
      </div>
    </div>
</div>
<?php 
}
?>

<?php
if($this->authorization->is_permitted('cms_view_gallery'))
{
?>
<div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading ">
        <h3 class="panel-title"><?php echo lang('menu_gallery_mangement')?></h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
            <li><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/gallery"><?php echo lang('menu_gallery_list')?> </a></li>
            <li><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/gallery/save"> <?php echo lang('menu_gallery_add')?> </a></li>
            <li>&nbsp;</li>           
            
        </ul>
      </div>
    </div>
</div>
<?php 
}
?>
<?php
if($this->authorization->is_permitted('cms_view_slide'))
{
?>
<div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading ">
        <h3 class="panel-title"><?php echo lang('menu_slide_mangement')?></h3>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled">
            <li><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/slider"><?php echo lang('menu_slide_list')?> </a></li>
            <li><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <a href="<?php echo base_url();?>cms/slider/save"> <?php echo lang('menu_slide_add')?> </a></li>
            <li>&nbsp;</li>           
            
        </ul>
      </div>
    </div>
</div>
<?php 
}
?>

</div>
</div>


<div class="col-md-3">
<div class="well well-lg">

    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title"><?=lang('menu_staff_search')?></h3>
      </div>
      <div class="panel-body">
                <form class="navbar-form navbar-right" role="search" id="search-form"  name="search-form" action="./dashboard/staff_search" method="post">             
                <div class="input-group">                        
                    <input type="text" class="form-control input-sm" name="search_param" placeholder="<?=lang('staff_id')?>" value="<?=set_value('search_param')?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>            
                </form>
      </div>
    </div>
    
    

</div>
</div>
</div>

<?php echo $this->load->view('footer'); ?>
