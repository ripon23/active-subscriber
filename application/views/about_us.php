<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head',array('title'=>lang('menu_about_us'))); ?>
</head>
<body>
<?php echo $this->load->view('header',array('active' => 'about_us')); ?>
<div class="row">
    <div class="col-md-8">        
        <h2>
        
		<?php 
		$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
		echo ($language=='bn')? ($overview->page_title_bn==NULL || $overview->page_title_bn=='')?$overview->page_title_en:$overview->page_title_bn : $overview->page_title_en?>
        </h2>
        <?php echo ($language=='bn')? ($overview->page_details_bn==NULL || $overview->page_details_bn=='')?$overview->page_details_en:$overview->page_details_bn : $overview->page_details_en?>

    </div>


    <div class="col-md-4">
    	<div class="panel panel-default">
        	<div class="panel-heading"><strong> <?php echo lang('contact_office_location')?></strong></div>
            <div class="panel-body">
        	<?php echo lang('contact_office_address')?>
            </div>
        </div>
        <div class="panel panel-default">
        	<div class="panel-heading"><strong> <h3 style="margin:0;"><?php echo lang('contact_map')?> </h3></strong></div>
            <div class="panel-body">                      
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.4118388442816!2d90.3651023145621!3d23.768344584580543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0a8b9b3e269%3A0xb23c66de39bdf242!2sDnet!5e0!3m2!1sen!2sbd!4v1479486323022" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
             </div>
        </div>
    </div>
</div>	

<?php echo $this->load->view('footer'); ?>
