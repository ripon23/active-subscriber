<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head',array('title'=>lang('cms_news_page_title'))); ?>
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
        <h2>
        
		<?php 
		$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
		echo lang('cms_news_page_title');
		?>
        </h2>
        <hr>
        <?php foreach($news_lists as $news): ?>
            <div class="media">
              <a class="media-left" href="<?php echo base_url().'news/details/'.$news->news_id;?>">
                <img class="img-thumbnail" src="<?php echo base_url();?>resource/img/news/<?php echo  ($news->thumbnail==NULL || $news->thumbnail=="")?"defauld-image.jpg":$news->thumbnail;?>" alt="<?php echo  ($news->thumbnail==NULL || $news->thumbnail=="")?"defauld-image.jpg":$news->thumbnail;?>">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="<?php echo base_url().'news/details/'.$news->news_id;?>"><?php echo ($language=='bn')? ($news->news_title_bn==NULL || $news->news_title_bn=='')?$news->news_title_en:$news->news_title_bn : $news->news_title_en?></a></h4>
                <div class="date"><strong><?php echo date("d M Y", strtotime($news->create_date));?></strong></div>
                
                <?php echo ($language=='bn')? ($news->news_details_bn==NULL || $news->news_details_bn=='')? strip_tags(string_limit_words($news->news_details_en,40)):strip_tags(string_limit_words($news->news_details_bn,40)) : strip_tags(string_limit_words($news->news_details_en,40))?>
                <br>
        <a href="<?php echo base_url().'news/details/'.$news->news_id;?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-align-justify"></span> <?php echo lang('details')?></a>
              </div>
            </div>
            <hr>
            <?php endforeach;
			echo $links;
			?>
			
    </div>


    <div class="col-md-4">
        <?php echo $this->load->view('main_sideber'); ?>
    </div>
</div>	

<?php echo $this->load->view('footer'); ?>
