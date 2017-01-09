<?php
class Aponjon_register extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl','date'));
		$this->load->library(array('account/authentication', 'account/authorization','form_validation','account/recaptcha'));
		$this->load->model(array('account/account_model'));
		
		date_default_timezone_set('Asia/Dhaka');  // set the time zone UTC+6
		
		$language = $this->session->userdata('site_lang');
		if(!$language)
		{
		$this->lang->load('general', 'english');
		$this->lang->load('menu', 'english');
		$this->lang->load('contact', 'english');
		$this->lang->load('email/contact_us', 'english');

		}
		else
		{
		$this->lang->load('general', $language);
		$this->lang->load('menu', $language);
		$this->lang->load('contact', $language);
		$this->lang->load('email/contact_us', $language);
		}
		
	}

	function index()
	{
		maintain_ssl();

		$recaptcha_result = $this->recaptcha->check();

		// Store recaptcha pass in session so that users only needs to complete captcha once
		if ($recaptcha_result === TRUE) $this->session->set_userdata('sign_up_recaptcha_pass', TRUE);
		
		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		
	
		
		
		$this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
		$this->form_validation->set_rules(
		  array(
			array(
			  'field' => 'subscriber_type',
			  'label' => 'Subscriber type',
			  'rules' => 'required'),
			array(
			  'field' => 'name', 
			  'label' => 'Name', 
			  'rules' => 'trim|required|max_length[100]'), 
			array(
			  'field' => 'cell_no', 
			  'label' => 'Cell No', 
			  'rules' => 'trim|required|min_length[11]|max_length[11]')
		  ));
		  
		// Run form validation
		if ($this->form_validation->run())
		{			
			
	
			if ( ! ($this->session->userdata('sign_up_recaptcha_pass') == TRUE || $recaptcha_result === TRUE))
			{
				$data['sign_up_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? "Recaptcha incorrect" : "recaptcha required";
			}
			else
			{
				
			// Remove recaptcha pass
			$this->session->unset_userdata('sign_up_recaptcha_pass');
			
			$table_data=array(
						'subscriber_type'=>$this->input->post('subscriber_type'),
						'name'=>$this->input->post('name'),
						'cell_no'=>$this->input->post('cell_no'),
						'services_model'=>$this->input->post('services_model'),
						'gatekeeper_cell_no'=>$this->input->post('gatekeeper_cell_no'),
						'relationship_with_gatekeeper'=>$this->input->post('relationship_with_gatekeeper'),						
						'create_date_time'=>mdate('%Y-%m-%d %H:%i:%s', now())					
						);
			
			$success_or_fail=$this->general_model->save_into_table('aponjon_member', $table_data);	
			
			if($success_or_fail)
					$data['success_msg']="Register successfully";
				else
					$data['error_msg']="Registration Unsuccessfull";				
			}
		}

		$data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));
		$this->load->view('aponjon_register', isset($data) ? $data : NULL);	

		
		
	}
	
	
	public function view_data()
	{
		
	if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			
			if($this->authorization->is_permitted('view_aponjon_member'))
			{
			
			$this->load->helper("url");	
			$this->load->library('pagination');	
			$data['title'] = lang('action_view');	
	
			
			
			
 		  	$searchterm='SELECT * FROM aponjon_member Order by create_date_time Desc';
	   
			//pagination
			$config = array();
			$config["base_url"] = base_url() . "aponjon_register/view_data/";
			$config["total_rows"] = $this->general_model->total_count_query_string($searchterm); 
			$config["per_page"] = $this->config->item("pagination_perpage");
			$config['num_links'] = 3;
			
			$config["uri_segment"] = 3;
			$config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
			$config['full_tag_close'] = '</ul></nav><!--pagination-->';
			
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			

			$this->pagination->initialize($config);
			
 
			$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;		
			$data['all_member'] = $this->general_model->get_all_result_by_limit_querystring($searchterm,$config["per_page"], $page);					
			$data["links"] = $this->pagination->create_links();
			$data["page"]=$page;						
			$this->load->view('aponjon_member_list', isset($data) ? $data : NULL);		
			
			}
			else
			{
			redirect('./dashboard');  // if not permitted "create_project_site" redirect to home page
			}		
		
		}
		else
		{
		redirect('account/sign_in');
		}
	
	
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/aponjon_registre.php */