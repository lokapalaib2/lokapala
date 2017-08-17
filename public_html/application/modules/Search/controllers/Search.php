<?php
class Search extends CI_Controller {
	var $webconfig;
	var $pagename;
	var $configuration;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->sharedModel('CategoryModel');
		$this->webconfig = $this->config->item('webconfig');
		$this->pagename = "Search";
			
	}

	function index(){
		$tdata = $ldata = array();
		$ldata['menu'] = $this->CategoryModel->listData(array('is_menu'=>1));
		$ldata['site_title']="Lokapala";
    	
		$meta_title = "Indeks";
		
		$ldata['meta_title'] = $meta_title; 
		$ldata['content_block'] = $this->load->view($this->router->class.'/index',$tdata, true);
		$this->load->sharedView('template_kanal',$ldata);
	}

	

	

}