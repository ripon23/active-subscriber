<!DOCTYPE html>
<html>
<head>
  <?php echo $this->load->view('head', array('title' => lang('users_page_name'))); ?>
</head>
<body>

<?php echo $this->load->view('header'); ?>

  <div class="row">

    <div class="col-md-2 sidebar">
      <?php echo $this->load->view('account/account_menu', array('current' => 'manage_users')); ?>
    </div>

    <div class="col-md-10">

      <h2><?php echo lang('users_page_name'); ?></h2>
		<hr>
      <!--<div class="well">
        <?php //echo lang('users_description'); ?>
      </div>-->
		<form class="form-horizontal" role="form" id="create-site-form"  name="create-site-form" action="./account/manage_users" method="post">  
    <table class="table table-bordered">
      
      <tr class="info">
        
        <td>
        <input id="user_name" name="user_name" type="text" placeholder="<?=lang('user_name')?>" value="<?php echo set_value('user_name');?>" class="form-control input-sm">	
        </td>
        <td>
        <div class="col-md-12">
        <select name="role_id" class="form-control input-sm" id="user_role">
            <option value=""><?php echo lang('select_all'); ?></option>            
            <?php foreach ($all_roles as $role) : ?>
            <option value="<?php echo $role->id; ?>" <?php if(set_value('role_id')==$role->id) echo "selected";?> ><?php echo $role->name; ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        </td>
        <td>
        <input id="email" name="email" type="text" placeholder="<?=lang('email')?>" value="<?php echo set_value('email');?>" class="form-control input-sm">
        </td>        
        <td>
        <input id="fullname" name="fullname" type="text" placeholder="<?=lang('fullname')?>" value="<?php echo set_value('fullname');?>" class="form-control input-sm">
        </td>
         <td>
         
         <input type="submit" class="btn btn-info" name="search_submit" value="<?=lang('action_search')?>">
        
        </td>
      </tr>
      
    </table>
    </form>
    	<table class="table table-condensed table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo lang('users_username'); ?></th>
              <th><?php echo lang('fullname'); ?></th>
              <th><?php echo lang('settings_email'); ?></th>              
              <th>
                <?php if( $this->authorization->is_permitted('create_users') ): ?>
                  <a href="account/manage_users/save" class="btn btn-primary btn-small"><?php echo lang('website_create'); ?></a>
                <?php endif; ?>
              </th>
            </tr>
          </thead>
      <?php if( count($all_accounts) > 0 ) : ?>
        
          <tbody>

            <?php foreach( $all_accounts as $acc ) : ?>
              <tr>
                <td><?php echo $acc['id']; ?></td>
                <td>
                  <?php echo $acc['username']; ?>
                  <?php if( $acc['is_banned'] ): ?>
                    <span class="label label-important"><?php echo lang('users_banned'); ?></span>
                  <?php elseif( $acc['is_admin'] ): ?>
                    <span class="label label-info"><?php echo lang('users_admin'); ?></span>
                  <?php endif; ?>
                </td>
                <td><?php echo $acc['fullname']; ?></td>
                <td><?php echo $acc['email']; ?></td>
                
                <td>
                  <?php if( $this->authorization->is_permitted('update_users') ): ?>
                    <a href="account/manage_users/save/<?php echo $acc['id']; ?>" class="btn btn-default btn-sm"><?php echo lang('website_update'); ?></a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>        
         
      <?php else: ?>      
      	<tfoot>
        <tr>
        	<td colspan="5">
            	Data Not found
            </td>
        </tr>
      <?php endif;?>
      	<tr>
        	<td colspan="5"><?php echo $links; ?></td>
        </tr>
        </tfoot>
      </table>
      
     
    </div>
  </div>
  
<?php echo $this->load->view('footer'); ?>

</body>
</html>