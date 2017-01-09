<!DOCTYPE html>
<html>
<head>
	
	<?php 
	$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
	echo $this->load->view('head',array('title'=>($language=='bn')? ($news->news_title_bn==NULL || $news->news_title_bn=='')?$news->news_title_en:$news->news_title_bn : $news->news_title_en)); ?>
</head>
<body>
<?php
function string_limit_words($string,$word_limit)					
{					
	$words = explode(' ',$string);					
	return join(' ', array_slice($words,0,$word_limit));							
}		
?>
<?php echo $this->load->view('header',array('active' => 'news')); ?>
<div class="row">
    <div class="col-md-8">        
        <h3>
        
		<?php 
		
		echo ($language=='bn')? ($news->news_title_bn==NULL || $news->news_title_bn=='')?$news->news_title_en:$news->news_title_bn : $news->news_title_en
		?>
        </h3>
        <hr>
        <?php //if($news->news_image!=NULL || $news->news_image!=""):?>
        <!--<img class="img-thumbnail pull-left" style="margin-right:10px;" src="<?php echo base_url();?>resource/img/news/<?php echo $news->news_image;?>">-->
		<?php //endif;?>
        <div class="detais-content">
        <?php
		
		echo ($language=='bn')? ($news->news_details_bn==NULL || $news->news_details_bn=='')?$news->news_details_en:$news->news_details_bn : $news->news_details_en
		?>
        </div>

    </div>


    <div class="col-md-4">
         <?php echo $this->load->view('main_sideber'); ?>
    </div>
</div>	

<?php echo $this->load->view('footer'); ?>
