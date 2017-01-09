<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
</head>
<body>
<?php echo $this->load->view('header',array('active' => 'contact_us')); ?>
<div class="row">
    <div class="col-md-8">
    	 <?php if (isset($error)):?>
        <div class="alert alert-warning">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<span class="glyphicon glyphicon-alert"></span><strong>  <?php echo lang('error_send_email')?> </strong>
        </div>
        <?php endif;?>
    	<?php if (isset($success)):?>
        <div class="alert alert-success">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<strong><span class="glyphicon glyphicon-saved"></span> <?php echo lang('success_send_email')?> </strong>
        </div>	  
        <?php endif;?>       
        <h2><?php echo lang('contact_page_title')?></h2>
        <form role="form"  id="email-form"  name="email-form" action="" method="post" >
        
        <div class="well well-sm"><strong><span class="pull-left" style=" color:red; font-size:22px; margin-right:10px;">*</span> <?php echo lang('contact_requird_field')?> </strong></div>
      <div class="form-group">
        <label for="name"><?php echo lang('contact_name_field')?></label>
        <div class="input-group">
          <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo lang('contact_name_placeholder')?>" required>
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span></div>
          <?php if(form_error('name')):?>
          <span class="text-danger"><?php echo form_error('name');?></span>
          <?php endif?>
      </div>
      <div class="form-group">
        <label for="email"><?php echo lang('contact_email_field')?></label>
        <div class="input-group">
          <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo lang('contact_email_placeholder')?>" required  >
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span>
        
        </div>
        <?php if(form_error('email')):?>
        <span class="text-danger"><?php echo form_error('email');?></span>
        <?php endif?>
      </div>
      <div class="form-group">
        <label for="subject"><?php echo lang('contact_subject_field')?></label>
        <div class="input-group">
          <input type="text" class="form-control" id="subject" name="subject" placeholder="<?php echo lang('contact_subject_placeholder')?>" required  >
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span></div>
          <?php if(form_error('subject')):?>
        <span class="text-danger"><?php echo form_error('subject');?></span>
        <?php endif?>
      
      </div>
      <div class="form-group">
        <label for="message"><?php echo lang('contact_message_field')?></label>
        <div class="input-group">
          <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span>
        </div>
        <?php if(form_error('message')):?>
        <span class="text-danger"><?php echo form_error('message');?></span>
        <?php endif?>
      </div>
      <!--<div class="form-group">
        <label for="InputReal">What is 4+3? (Simple Spam Checker)</label>
        <div class="input-group">
          <input type="text" class="form-control" name="InputReal" id="InputReal" required>
          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
      </div>-->
      <button type="submit" name="submit" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-send"></span> <?php echo lang('contact_submit')?></button>
      
		</form>
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
