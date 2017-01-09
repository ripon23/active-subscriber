<div class="panel panel-default">
    <div class="panel-heading"><strong> <h4 style="margin:0;"><?php echo lang('menu_news')?> </h4></strong></div>
    <div class="panel-body">
       <?php 
		$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
		foreach($news_list as $news): ?>
        <div class="media">
          <a class="media-left " href="<?php echo base_url().'news/details/'.$news->news_id;?>">
            <span class="img-thumbnail">
            <img src="<?php echo base_url();?>resource/img/news/<?php echo  ($news->thumbnail==NULL || $news->thumbnail=="")?"defauld-image.jpg":$news->thumbnail;?>" alt="<?php echo  ($news->thumbnail==NULL || $news->thumbnail=="")?"defauld-image.jpg":$news->thumbnail;?>">
          	</span>
          </a>
          
          <div class="media-body">
            <h5 class="media-heading"><a href="<?php echo base_url().'news/details/'.$news->news_id;?>"><?php echo ($language=='bn')? ($news->news_title_bn==NULL || $news->news_title_bn=='')?$news->news_title_en:$news->news_title_bn : $news->news_title_en?></a></h5>
            <div class="date"><?php echo date("d M Y", strtotime($news->create_date));?></div>
          </div>
        </div>
        <hr>
        <?php endforeach;?>
        <a href="news/" class="btn btn-link pull-right"><?php echo lang('website_view').' '.lang('select_all')?></a>
                                
   	</div>
</div>

<!--<div class="panel panel-default">
    <div class="panel-heading"><strong> <h4 style="margin:0;"><?php echo lang('menu_statistics')?> </h4></strong></div>
    <div class="panel-body">
    The server at www.lipsum.com is taking too long to respond.
	<ul>
    	<li>The site could be temporarily unavailable or too busy. Try again in a few moments.</li>
    	<li>If you are unable to load any pages, check your computer's network connection.</li>
    	<li>If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.</li>
    </ul>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><strong> <h4 style="margin:0;"><?php echo lang('menu_yearly_progress')?> </h4></strong></div>
    <div class="panel-body">
       The server at www.lipsum.com is taking too long to respond.
	<ul>
    	<li>The site could be temporarily unavailable or too busy. Try again in a few moments.</li>
    	<li>If you are unable to load any pages, check your computer's network connection.</li>
    	<li>If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.</li>
    </ul>                           
    </div>
</div>-->