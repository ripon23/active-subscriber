<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head',array('title'=>lang('menu_overview'))); ?>
</head>
<body>
<?php echo $this->load->view('header',array('active' => 'overview')); ?>
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
        <?php echo $this->load->view('main_sideber'); ?>
    </div>
</div>	

<?php echo $this->load->view('footer'); ?>
