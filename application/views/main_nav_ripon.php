<?php
$activeurl1= $this->uri->segment(1);
$activeurl2= $this->uri->segment(2);
$activeurl3= $this->uri->segment(3);
$activeurl=$activeurl1."/".$activeurl2."/".$activeurl3;
//echo $activeurl;
?>
<div class="col-md-12">

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" ><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#"><?=lang('menu_overview')?></a></li>
        <li><a href="#"><?=lang('menu_about_us')?></a></li> 
        <li><a href="#"><?=lang('menu_contact_us')?></a></li> 
        
		<?php if ($this->authentication->is_signed_in()) : ?>
        <li <?php echo $activeurl=='dashboard//'?' class="active"':'' ?>><a href="./dashboard"><?=lang('menu_dashboard')?></a></li>       
        <?php endif; ?>  
        
      </ul>
     <form class="navbar-form navbar-right" role="search" id="search-form"  name="search-form" action="./dashboard/patient_barcode_search" method="post">
             
     <div class="input-group">
        <!--<div class="input-group-btn search-panel">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span id="search_concept">Filter by</span> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#contains">Contains</a></li>
              <li><a href="#its_equal">It's equal</a></li>
              <li><a href="#greather_than">Greather than ></a></li>
              <li><a href="#less_than">Less than < </a></li>
              <li class="divider"></li>
              <li><a href="#all">Anything</a></li>
            </ul>
        </div>-->             
        <input type="text" class="form-control input-sm" name="search_param" placeholder="<?=lang('website_search_term')?>" value="<?=set_value('search_param')?>">
        <span class="input-group-btn">
            <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </span>
     </div>            
    </form>
              
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


</div> <!-- col-md-12 -->
            
            