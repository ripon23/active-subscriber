<?php

class About_us extends CI_Controller {

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
		$news_select = "`news_id`, `news_title_en`, `news_title_bn`, `news_details_en`, `news_details_bn`, `thumbnail`,create_date";
		$data['news_list'] = $this->general_model->get_list_view('eh_news', 'enable', 1, $news_select, 'news_id', 'desc', '0',5);
		
		$data['overview'] = $this->general_model->get_all_table_info_by_id('pages', 'slug', 'about_us');
		
		$this->load->view('about_us', isset($data) ? $data : NULL);
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */