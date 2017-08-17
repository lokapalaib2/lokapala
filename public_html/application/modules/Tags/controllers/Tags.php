<?php
class Tags extends CI_Controller {
	var $webconfig;
	var $pagename;
	var $configuration;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('pagination');
		$this->load->sharedModel('CategoryModel');
		$this->load->sharedModel('ContentModel');
		$this->load->sharedModel('TagsModel');
		$this->webconfig = $this->config->item('webconfig');
		$this->pagename = "Tags";
			
	}

	function index(){
		redirect(base_url().$this->router->class.'/listing');
	}

	function listing($slug = ""){
		if($slug == ""){

		}
		$tdata = $ldata = array();
		$ldata['menu'] = $this->CategoryModel->listData(array('is_menu'=>1));
		$ldata['site_title']="Lokapala";
    	$tdata['category'] = $this->CategoryModel->listData();
		$gettags = $this->TagsModel->getTags($slug);
		$id_slug = $tdata['id_tags'] = isset($gettags['id'])?$gettags['id']:0;
		$all_data = $this->ContentModel->listDataCountTags(array('pagename'=>$this->pagename,'id'=>$id_slug));
		$tdata['all_data'] = isset($all_data['jumlah'])?$all_data['jumlah']:0;
		$cfg_pg ['base_url'] = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)."/";
        $cfg_pg ['total_rows'] = isset($all_data['jumlah'])?$all_data['jumlah']:0;
        $cfg_pg ['per_page'] = 10;
        $cfg_pg ['uri_segment'] = 3;

		$cfg_pg['first_link'] = '&laquo;';
		$cfg_pg['first_tag_close'] = '</li>';
		$cfg_pg['first_tag_open'] = '<li>';

		$cfg_pg['last_link'] = '&raquo;';
		$cfg_pg['last_tag_open'] = '<li>';
		$cfg_pg['last_tag_close'] = '</li>';

		$cfg_pg['next_link'] = '&gt;';
		$cfg_pg['next_tag_open'] = '<li>';
		$cfg_pg['next_tag_close'] = '</li>';

		$cfg_pg['prev_link'] = '&lt;';
		$cfg_pg['prev_tag_open'] = '<li>';
		$cfg_pg['prev_tag_close'] = '</li>';

		$cfg_pg['num_tag_open'] = '<li>';
		$cfg_pg['num_tag_close'] = '</li>';

		$cfg_pg['cur_tag_open'] = '<li class="active"><span class="activepage">';
		$cfg_pg['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($cfg_pg);
		$tdata["pagination"] = $this->pagination->create_links();

		$start_no = 0;
		if ($this->uri->segment($cfg_pg ['uri_segment']) != '') {
			$start_no = $this->uri->segment($cfg_pg ['uri_segment']);
		}

		$tdata["start_no"] = $start_no;
		$tdata['limit'] = $cfg_pg['per_page'];

		$start_idx = $cfg_pg['per_page'] * ($this->pagination->cur_page - 1);
		$start_idx = $start_idx < 0?0:$start_idx;

		$tdata['lists'] = $this->ContentModel->listDataTags(array(
										
															'pagename'=>$this->pagename
															,'start'  => $start_idx
															,'limit' => $cfg_pg['per_page']
															,'id'  => $id_slug
			
															));

		
		## LOAD LAYOUT ##
		$meta_title = "Indeks";
		
		$ldata['meta_title'] = $meta_title; 
		$ldata['content_block'] = $this->load->view($this->router->class.'/index',$tdata, true);
		$this->load->sharedView('template_kanal',$ldata);
	}

	private function __getSlug($id){
		$slug = $this->CategoryModel->__getCategorySlug(array('id'=>$id));
		$result = isset($slug['slug'])?$slug['slug']:'';
		return $result;
	}

}