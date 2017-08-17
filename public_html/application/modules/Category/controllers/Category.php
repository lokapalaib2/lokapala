<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 * ***************************************************************
 * Script : 
 * Version : 
 * Date :
 * Author : Ardhitya Wiedha Irawan.
 * Website : wwww.blog.gulangguling.com
 * Email : ardhityawiedhairawan@gmail.com
 * Description : Codeigniter 3.x + HMVC
 * ***************************************************************
 */

class Category extends CI_Controller {
	var $webconfig;
	var $pagename;
	var $configuration;
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->webconfig = $this->config->item('webconfig');

		$this->load->sharedModel('CategoryModel');
		$this->load->sharedModel('ContentModel');	
	}
	public function index($slug = ""){
		$tdata = array();
		$ldata = array();
		$arr_exclude = array();
		$ldata['menu'] = $this->CategoryModel->listData(array('is_menu'=>1));
		$tdata['menu'] = $ldata['menu'];
		$ldata['rumors'] = $this->ContentModel->listArticle(array('limit'=>5));
		$getcategoryid = $this->CategoryModel->__getCategoryid(array('slug'=>$slug));
		if (count($getcategoryid) == 0) {
			redirect(base_url().'notfoundpage');
		}
		$id = isset($getcategoryid['id'])?$getcategoryid['id']:'';
		$nama_category = isset($getcategoryid['name'])?$getcategoryid['name']:'';
		$tipe = isset($getcategoryid['tipe'])?$getcategoryid['tipe']:0;
		$ldata['menu'] = $this->CategoryModel->listData(array('is_menu'=>1));
		$ldata['meta_title'] = $nama_category;
		$ldata['site_title'] = $nama_category;
		$ldata['meta_url'] = base_url().$slug;
		$ldata['id_category'] = $id;
		$tdata['id_category'] = $id;		
		$this->pagename = $nama_category;
		$limit = 0;		
	
		if ($id == $this->webconfig['category-id-berita']){
			$limit = $this->webconfig['limit_berita'];
			$tdata['headline_berita'] = $this->ContentModel->listArticle(array('id_category'=>$id,'slug'=>$slug,'limit'=>5,"is_headline"=>1));	
			$view ='/berita';
			if (is_array($tdata['headline_berita']) && count($tdata['headline_berita'])>0) {
				foreach ($tdata['headline_berita'] as $key => $value) {
					$arr_exclude[] = $value['id'];
				}
			}
			$ldata['panel']='panel_berita';
		}elseif ($id == $this->webconfig['category-id-grafik']){
			$limit = $this->webconfig['limit_grafik'];
			$ldata['panel']='panel_grafik';
			$view ='/grafik';
		}elseif ($id == $this->webconfig['category-id-analisis']){			
			$limit = $this->webconfig['limit_analisis'];
			$view ='/listanalisis';
		}elseif ($id == $this->webconfig['category-id-video']){
			$limit = $this->webconfig['limit_video'];
			$ldata['panel']='panel_multimedia';
			$view ='/multimedia';
		}
		
		$tdata['listcategory'] = $this->ContentModel->listArticle(array('id_category'=>$id,'slug'=>$slug,'limit'=>$limit,'arr_exclude'=>$arr_exclude));		
		$ldata['content_block'] = $this->load->view($view,$tdata, true);
		if ($id == $this->webconfig['category-id-analisis']){	
			$this->load->sharedView('template_detail',$ldata);
		}else{
			$this->load->sharedView('template_kanal',$ldata);
		}
		
		
	}
	private function __getSlug($id){
		$slug = $this->CategoryModel->__getCategorySlug(array('id'=>$id));
		$result = isset($slug['slug'])?$slug['slug']:'';
		return $result;
	}

}

