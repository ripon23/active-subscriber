<?php

class Home extends CI_Controller {

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
		$this->lang->load('general', $this->config->item("default_language"));
		$this->lang->load('menu', $this->config->item("default_language"));

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
		$select = "`image_caption_en`, `image_caption_bn`, `slide_image`, `slide_thumb`";
		$data['sliders'] = $this->general_model->get_list_view('slider', 'enable', 1, $select, 'slide_id', 'desc', '0',5);
		$data['overview'] = $this->general_model->get_all_table_info_by_id('pages', 'slug', 'overview');
		$news_select='*';
		$data['news_list'] = $this->general_model->get_list_view('eh_news', 'enable', 1, $news_select, 'news_id', 'desc', '0',5);
		$this->load->view('home', isset($data) ? $data : NULL);
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */