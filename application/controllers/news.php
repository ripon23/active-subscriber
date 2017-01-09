<?php

class News extends CI_Controller {

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
		$this->lang->load('cms', $this->config->item("default_language"));

		}
		else
		{
		$this->lang->load('general', $language);
		$this->lang->load('menu', $language);
		$this->lang->load('cms', $language);
		}
		
	}

	function index()
	{
		maintain_ssl();

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		// Paginations
		$this->load->library('pagination');	
		$config = array();
		$config['base_url'] = base_url().'news/index/';
		$config['total_rows'] = $this->general_model->number_of_total_rows_in_a_table('eh_news');
		$config['num_links'] = 3;
		$config['per_page'] = $this->config->item("pagination_perpage");
		$config['uri_segment'] = 3;
		
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
		
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
		$news_select = "`news_id`, `news_title_en`, `news_title_bn`, `news_details_en`, `news_details_bn`, `thumbnail`,create_date";
		$data['news_lists'] = $this->general_model->get_list_view('eh_news', 'enable', 1, $news_select, 'news_id', 'desc', $page,$config['per_page']);
		$data["links"] = $this->pagination->create_links();
		$data['news_list'] = $this->general_model->get_list_view('eh_news', 'enable', 1, $news_select, 'news_id', 'desc', '0',5);
				
		
		$this->load->view('news_list', isset($data) ? $data : NULL);
	}
	
	function details($id)
	{
		maintain_ssl();
		if (!empty($id)):
		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		$news_select = "`news_id`, `news_title_en`, `news_title_bn`, `news_details_en`, `news_details_bn`, `thumbnail`,create_date";
		$data['news_list'] = $this->general_model->get_list_view('eh_news', 'enable', 1, $news_select, 'news_id', 'desc', '0',5);
		$data['news'] = $this->general_model->get_all_table_info_by_id('eh_news', 'news_id', $id);		
		
		$this->load->view('news_details', isset($data) ? $data : NULL);
		else:
		redirect(base_url().'news');
		endif;
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */