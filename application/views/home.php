<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
    <script>
		$('.carousel').carousel({
		  interval: 1000,
		  pause:"hover"
		})
	</script>
</head>
<body>
<?php echo $this->load->view('header',array('active' => 'home')); ?>
<?php
function string_limit_words($string,$word_limit)					
{					
	$words = explode(' ',$string);					
	return join(' ', array_slice($words,0,$word_limit));							
}		
?>
<div class="row">
    <div class="col-md-8">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
            <?php 
			$i = 0;
			foreach($sliders as $slider): ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i?>" class="<?php echo ($i==0)? "active":""?>"></li>
            <?php 
			$i++;
			endforeach;?>    
            </ol>
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            	<?php 
				$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
				$i = 1;
				foreach($sliders as $slider): ?>
                <div class="item <?php echo ($i==1)? "active":""?>">
                  <img src="<?php echo base_url();?>resource/img/sliders/<?php echo $slider->slide_image?>" alt="<?php echo ($language=='bn')? ($slider->image_caption_bn==NULL || $slider->image_caption_bn=='')?$slider->image_caption_en:$slider->image_caption_bn : $slider->image_caption_en?>">
                  <div class="carousel-caption">
                    <h5>
					<?php echo ($language=='bn')? ($slider->image_caption_bn==NULL || $slider->image_caption_bn=='')?$slider->image_caption_en:$slider->image_caption_bn : $slider->image_caption_en?>
                    </h5>
                  </div>
                </div>
                <?php 
				$i++;
				endforeach;?>                
            </div>
            
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
		</div>
        <h3>
			<?php echo ($language=='bn')? ($overview->page_title_bn==NULL || $overview->page_title_bn=='')?$overview->page_title_en:$overview->page_title_bn : $overview->page_title_en?>
        </h3>
        <?php echo ($language=='bn')? ($overview->page_details_bn==NULL || $overview->page_details_bn=='')?string_limit_words($overview->page_details_en,300):string_limit_words($overview->page_details_bn,350) : string_limit_words($overview->page_details_en,300);?>
        <!--
        <a href="<?php echo base_url(); ?>overview" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-align-justify"></span> <?php echo lang('details')?></a>
        -->

    </div>

    <div class="col-md-4">
        <?php echo $this->load->view('main_sideber'); ?>
    </div>
</div>	

<?php echo $this->load->view('footer'); ?>