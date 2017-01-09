<?php

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization'));
		$this->load->model(array('account/account_model','general_model','project_site/site_model'));
		
		date_default_timezone_set('Asia/Dhaka');  // set the time zone UTC+6
		
		$language = $this->session->userdata('site_lang');
		if(!$language)
		{
		$this->lang->load('general', 'english');
		$this->lang->load('menu', 'english');
		$this->lang->load('site', 'english');
		$this->lang->load('formlabel', 'english');
		}
		else
		{
		$this->lang->load('general', $language);
		$this->lang->load('menu', $language);
		$this->lang->load('site', $language);
		$this->lang->load('formlabel', $language);
		}
		
	}




	function index()
	{
		maintain_ssl();

		if ($this->authentication->is_signed_in())
		{
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		
		$highest_role=100;
		$all_user_role=$this->site_model->get_all_user_role($data['account']->id);
			foreach ($all_user_role as $user_role) :
				if($user_role->role_id<$highest_role)
				$highest_role=$user_role->role_id;
			endforeach; 
		
		if($highest_role==7)
		$this->load->view('view_dashboard_staff', isset($data) ? $data : NULL); //Patient Dashboard
		else
		$this->load->view('view_dashboard', isset($data) ? $data : NULL); //Admin Dashboard				
		
		}
		else
		{
		redirect('account/sign_in');
		}
		
	}
	
	public function staff_search()
	{
		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			
			if($this->authorization->is_permitted('staff_management'))
			{				
				$user_info=$this->general_model->get_all_table_info_by_id('bgb_staff', 'staff_id', $this->input->post("search_param"));
				if($user_info)
				{
					//echo "User id =".$user_info->user_id;
					if($this->general_model->have_access($data['account']->id,$user_info->account_id))
					{					
					redirect('./staff/staff/view_single_staff_profile/'.$user_info->account_id);
					}
					else
					{
					$data['title'] = "No Access";	
					$data['msg'] = lang('no_access_permission');
					$this->load->view('view_no_access', isset($data) ? $data : NULL);
					}
				}
				else
				{
					if($this->authorization->is_permitted('staff_management'))	
					{
						redirect('./staff/staff/create_staff/'.$this->input->post("search_param"));	
					}
					else
					{
					$data['title'] = lang('no_patient_found');	
					$data['msg'] = lang('no_patient_found');
					$this->load->view('view_no_access', isset($data) ? $data : NULL);	
					}
				}
				
			}
			else
			{
			redirect('./dashboard');  // if not permitted "view_patient_checkup" redirect to home page
			}
		}
		else
		{
		redirect('account/sign_in');
		}
	}

} // End Class


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */