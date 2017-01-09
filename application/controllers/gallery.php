<?php

class Gallery extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization'));
		$this->load->model(array('account/account_model','general_model'));
		
		date_default_timezone_set('Asia/Dhaka');  // set the time zone UTC+6
		
		$language = $this->session->userdata('site_lang');
		if(!$language)
		{
		$this->lang->load('general', 'english');
		$this->lang->load('menu', 'english');

		}
		else
		{
		$this->lang->load('general', $language);
		$this->lang->load('menu', $language);
		}
		
	}

	function index()
	{
		maintain_ssl();

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		
		$data['galleries'] = $this->general_model->get_list_view('gallery', 'enable', 1, NULL, 'gallery_id', 'desc', NULL,NULL);
		$this->load->view('gallery', isset($data) ? $data : NULL);
	}
	
	function images($id)
	{
		maintain_ssl();

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		if (!empty($id)):
		$field_array = array('enable'=>1,'gallery_id'=>$id);
		$data['images'] = $this->general_model->get_list_multi_clause('gallery_image',$field_array, NULL, 'image_id', 'desc', $start=NULL, $limit=NULL);
		//print_r($data['images']);
		$this->load->view('gallery_images', isset($data) ? $data : NULL);
		else:
		redirect('gallery');
		endif;
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */