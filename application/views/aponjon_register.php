<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
</head>
<body>
<?php echo $this->load->view('header',array('active' => 'aponjon')); ?>
<div class="row">
    <div class="col-md-8">
    	
		
		<?php if (isset($error_msg)):?>
        <div class="alert alert-warning">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<span class="glyphicon glyphicon-alert"></span><strong>  <?php echo "".$error_msg?> </strong>
        </div>
        <?php endif;?>
        
    	<?php if (isset($success_msg)):?>
        <div class="alert alert-success">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<strong><span class="glyphicon glyphicon-saved"></span> <?php echo "".$success_msg?> </strong>
        </div>                	  
        <?php endif;?>                            
            
            
        <h2><?php echo lang('menu_aponjon_register')?></h2>
        <form role="form"  id="email-form"  name="email-form" action="" method="post" >
      
      <div class="well well-sm"><strong><span class="pull-left" style=" color:red; font-size:22px; margin-right:10px;">*</span> <?php echo lang('contact_requird_field')?> </strong></div>
      
      
      <div class="form-group">
        <label for="name"><?php echo lang('subscriber_type')?></label>
        <div class="input-group">
          <select name="subscriber_type" id="subscriber_type" class="form-control" >
                        <option value=""><?php echo lang('select_subscriber_type'); ?></option>
                    	<option value="Pregnant Women" <?php if(set_value('subscriber_type')=="Pregnant Women") echo "selected";?> >Pregnant Women</option>            
                       	<option value="New Mother" <?php if(set_value('subscriber_type')=="New Mother") echo "selected";?>>New Mother</option>                                             
	      </select>
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span></div>
          <?php if(form_error('subscriber_type')):?>
          <span class="text-danger"><?php echo form_error('subscriber_type');?></span>
          <?php endif?>
      </div>
      
              
      <div class="form-group">
        <label for="name"><?php echo lang('contact_name_field')?></label>
        <div class="input-group">
          <input type="text" class="form-control" name="name" id="name" placeholder="<?php echo lang('contact_name_placeholder')?>" >
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span></div>
          <?php if(form_error('name')):?>
          <span class="text-danger"><?php echo form_error('name');?></span>
          <?php endif?>
      </div>
      
      <div class="form-group">
        <label for="name"><?php echo lang('cell_no')?></label>
        <div class="input-group">
          <input type="text" class="form-control" name="cell_no" id="cell_no" placeholder="<?php echo lang('cell_no_placeholder')?>" >
          <span class="input-group-addon"><i class="glyphicon form-control-feedback"><span style=" color:red; font-size:9px;">*</span></i></span>
        </div>
          <?php if(form_error('cell_no')):?>
          <span class="text-danger"><?php echo form_error('cell_no');?></span>
          <?php endif?>
      </div>
     
     
     <div class="form-group">
        <label for="name"><?php echo lang('services_model')?></label>
        <div class="input-group">
          <select name="services_model" id="services_model" class="form-control">
                        <option value=""><?php echo lang('select_services_model'); ?></option>
                    	<option value="SMS">SMS</option>            
                       	<option value="Voice">Voice</option>                                             
	      </select>
          <span class="input-group-addon"></span></div>
          <?php if(form_error('services_model')):?>
          <span class="text-danger"><?php echo form_error('services_model');?></span>
          <?php endif?>
      </div>
     
     
     <div class="form-group">
        <label for="name"><?php echo lang('gatekeeper_cell_no')?></label>
        <div class="input-group">
          <input type="text" class="form-control" name="gatekeeper_cell_no" id="gatekeeper_cell_no" placeholder="<?php echo lang('gatekeeper_cell_no_placeholder')?>">
          <span class="input-group-addon"></span></div>
          <?php if(form_error('gatekeeper_cell_no')):?>
          <span class="text-danger"><?php echo form_error('gatekeeper_cell_no');?></span>
          <?php endif?>
      </div>
      
      <div class="form-group">
        <label for="name"><?php echo lang('relationship_with_gatekeeper')?></label>
        <div class="input-group">
           <select name="relationship_with_gatekeeper" id="relationship_with_gatekeeper" class="form-control">
                        <option value=""><?php echo lang('select_relationship_with_gatekeeper'); ?></option>
                    	<option value="Guardian">Guardian</option>            
                       	<option value="Husband">Husband</option>
                        <option value="Mother">Mother</option>            
                       	<option value="Mother-in-law">Mother-in-law</option>                                             
	      </select>
                    
          <span class="input-group-addon"></span></div>
          <?php if(form_error('relationship_with_gatekeeper')):?>
          <span class="text-danger"><?php echo form_error('relationship_with_gatekeeper');?></span>
          <?php endif?>
      </div>
      
      
      <?php if (isset($recaptcha)) :
						echo $recaptcha;
						if (isset($sign_up_recaptcha_error)) : ?>
							<span class="field_error"><?php echo $sign_up_recaptcha_error; ?></span>
						<?php endif; ?>
	 <?php endif; ?>
      
    
      <button type="submit" name="submit" class="btn btn-primary btn-info"><span class="glyphicon glyphicon-send"></span> <?php echo lang('button_register')?></button>
      
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
