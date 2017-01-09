<!DOCTYPE html>
<html>
<head>
<?php echo $this->load->view('head', array('title'=>lang('menu_photo_gallery'))); ?>
<link rel="stylesheet" href="<?php echo base_url().RES_DIR; ?>/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo base_url().RES_DIR; ?>/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("area[rel^='prettyPhoto']").prettyPhoto();
		
		$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
		$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
	
		$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
			custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
			changepicturecallback: function(){ initialize(); }
		});
	
		$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
			custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
			changepicturecallback: function(){ _bsap.exec(); }
		});
	});
	</script>
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
        
        <?php 
		if(isset($images) && count($images)>0):?>
		<div class="gallery clearfix">
		<?php foreach($images as $image): ;?> 
            
                <div class="col-md-2 span gallery-photo">
                    <a class="thumbnail" href="<?php echo base_url().'resource/img/gallery/'.$image->image_file?>" rel="prettyPhoto[gallery]" title="<?php echo ($language=='bn')? ($image->image_caption_bn==NULL || $image->image_caption_bn=='')?$image->image_caption_en:$image->image_caption_bn : $image->image_caption_en?>"><img src="<?php echo base_url().'resource/img/gallery/'.$image->image_thumb?>"/></a>
                    
                   
                </div>
            
        <?php endforeach;?>
        </div>
        <?php
		else:
		?>
        <div class="col-md-12">
        	<?php echo lang('image_not_found');?>
        </div>
        <?php 
		endif;
		?>       
        
        
</div>	

<?php echo $this->load->view('footer'); ?>
