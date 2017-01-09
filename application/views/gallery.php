<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title'=>lang('menu_photo_gallery'))); ?>
</head>
<body>
<?php echo $this->load->view('header',array('active' => 'gallery')); ?>
<div class="row">
    <div class="col-md-12">
        
        <h2><?php 
			$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
			echo lang('menu_photo_gallery')?></h2>
			<hr>
            
        </div>
        <?php foreach($galleries as $gallery): ;?>
        
        <div class="col-md-3">
              <a href="<?php echo base_url().'gallery/images/'.$gallery->gallery_id?>" class="thumbnail">
        	<img src="<?php echo base_url().'resource/img/gallery/'?><?php echo ($gallery->thumbnail==NULL || $gallery->thumbnail=="")? "default.jpg":$gallery->thumbnail?>" class="img-responsive" alt="Responsive image">
                <div class="caption">
                	<h4>
                <?php echo ($language=='bn')? ($gallery->gallery_name_bn==NULL || $gallery->gallery_name_bn=='')?$gallery->gallery_name_en:$gallery->gallery_name_bn : $gallery->gallery_name_en?>
                	</h4>
                </div>
            </a>
        </div>
        <?php endforeach;?>
        
        
</div>	

<?php echo $this->load->view('footer'); ?>
