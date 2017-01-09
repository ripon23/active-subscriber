<?php

class Contact_us extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization','form_validation'));
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

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		
		$this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
		$this->form_validation->set_rules(
		  array(
			array(
			  'field' => 'name',
			  'label' => 'lang:contact_name_field',
			  'rules' => 'trim|required|max_length[80]'),
			array(
			  'field' => 'email', 
			  'label' => 'lang:contact_email_field', 
			  'rules' => 'trim|valid_email|max_length[100]'), 
			array(
			  'field' => 'subject', 
			  'label' => 'lang:contact_subject_field', 
			  'rules' => 'trim|required'), 
			array(
			  'field' => 'message', 
			  'label' => 'lang:contact_message_field', 
			  'rules' => 'trim|required')
		  ));
		  
		// Run form validation
		if ($this->form_validation->run())
		{			
			// Load email library
			$this->load->library('email');

			
			//$email_setting  = array('mailtype'=>'html');
			//$this->email->initialize($email_setting);
			
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			// Set up email preferences
			//$config['mailtype'] = 'html';

			// Initialise email lib
			//$this->email->initialize($config);
			
			// Send reset password email
			$this->email->from($this->input->post('email', TRUE));
			$this->email->reply_to($this->input->post('email', TRUE));
			$this->email->to('riponmailbox@gmail.com');
			$this->email->subject($this->input->post('subject', TRUE));
			$this->email->message($this->load->view('email/contact_us_email', array(
				'name' => $this->input->post('name', TRUE),
				'message' => $this->input->post('message', TRUE)), TRUE));			
			if($this->email->send())
			{
				$data['success'] = 'success';
				$this->load->view('contact_us', isset($data) ? $data : NULL);
			}
			else
			{
				$data['error'] = 'error';
				$this->load->view('contact_us', isset($data) ? $data : NULL);
			}
			return;
		}
		$this->load->view('contact_us', isset($data) ? $data : NULL);
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */