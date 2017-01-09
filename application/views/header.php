<!-- Fixed navbar -->
    <!--<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <?php echo anchor('', lang('website_title'), 'class="site_title"'); ?> 		
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           
            
            <li class="dropdown">
              
           
           	 <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        	<span class="glyphicon glyphicon-font" aria-hidden="true"></span> <?php 
							if($this->session->userdata('site_lang'))
							echo ucfirst($this->session->userdata('site_lang'));
							else
							echo "English";							
							?> <b class="caret"></b></a>

                        <ul class="dropdown-menu" role="menu">
                        <li><?php echo anchor('langswitch/switchLanguage/english', 'English'); ?></li>
						<li><?php echo anchor('langswitch/switchLanguage/bangla', 'Bangla'); ?></li>
             </ul>
           
           
            </li>
            
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php if ($this->authentication->is_signed_in()) : ?>
                        	<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $account->username; ?> <b class="caret"></b></a>
						<?php else : ?>
                        	<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b class="caret"></b></a>
						<?php endif; ?>

                        <ul class="dropdown-menu" role="menu">
							<?php if ($this->authentication->is_signed_in()) : ?>
                                <li class="dropdown-header">Account Info</li>
								<li><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
								<li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
								<?php if ($account->password) : ?>
									<li><?php echo anchor('account/account_password', lang('website_password')); ?></li>
								<?php endif; ?>
								
                                <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Admin Panel</li>
                                    <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
                                        <li><?php echo anchor('account/manage_users', lang('website_manage_users')); ?></li>
                                    <?php endif; ?>

                                    <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
                                        <li><?php echo anchor('account/manage_roles', lang('website_manage_roles')); ?></li>
                                    <?php endif; ?>

                                    <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
                                        <li><?php echo anchor('account/manage_permissions', lang('website_manage_permissions')); ?></li>
                                    <?php endif; ?>
                                <?php endif; ?>

								<li class="divider"></li>
								<li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
							<?php else : ?>
								<li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
							<?php endif; ?>

                        </ul>
                    </li>

            
            
          </ul>
        </div>
      </div>
    </nav>-->
    
    <div class="container">
	<div class="row">
    	<!-- Main component for a primary marketing message or call to action -->
        <div class="col-md-12">
            <div class="top_banner" style="position: relative; ">
                <!--<div class="ribbon-wrapper-green">
                    <div class="ribbon-green">beta</div>
                </div>-->
                <?php 
				$language = ($this->session->userdata('site_lang')=='bangla')? 'bn':'en';
				if($language=='bn')
				echo anchor('', '<img src='.RES_DIR.'/img/bgb_logo.png alt=GramCar class="img-responsive"/>'); 
				else
				echo anchor('', '<img src='.RES_DIR.'/img/bgb_logo.png alt=GramCar class="img-responsive"/>'); 
				?>             		
            </div>
        </div>
	
    <?php echo $this->load->view('main_nav'); ?>
    
    </div> <!-- /row -->