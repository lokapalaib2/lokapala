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

class home extends CI_Controller {
	var $webconfig;
	var $pagename;
	var $configuration;
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->webconfig = $this->config->item('webconfig');
		$this->load->sharedModel('ContentModel');
		$this->load->sharedModel('CategoryModel');
		$this->load->sharedModel('ConfigurationModel');
		$this->configuration = $this->ConfigurationModel->listData();
	
	}
	
	public function index(){
		$ldata = array();
		$arr_exclude = array();
		$ldata['menu'] = $this->CategoryModel->listData(array('is_menu'=>1));
		$tdata['headline'] = $this->ContentModel->listArticle(array('limit'=>$this->webconfig['limit_headline_home_new'],"is_headline"=>1));
		if (is_array($tdata['headline']) && count($tdata['headline'])>0) {
			foreach ($tdata['headline'] as $key => $value) {
				$arr_exclude[] = $value['id'];
			}
		}
		$tdata['berita_terpopuler'] = $this->ContentModel->listTerpopuler(array('limit'=>$this->webconfig['limitterpopuler_home'],'arr_exclude'=>$arr_exclude,'interval'=>$this->webconfig['interval']));
		$slugberita = $this->__getSlug($this->webconfig['category-id-berita']);
		$tdata['listberita'] = $this->ContentModel->listArticle(array('id_category'=>$this->webconfig['category-id-berita'],'slug'=>$slugberita,'limit'=>$this->webconfig['limitberita-home']));	
		$sluggrafik = $this->__getSlug($this->webconfig['category-id-grafik']);
		$tdata['listgrafik'] = $this->ContentModel->listArticle(array('id_category'=>$this->webconfig['category-id-grafik'],'slug'=>$sluggrafik,'limit'=>$this->webconfig['limitgrafik-home']));
		$sluganalisis = $this->__getSlug($this->webconfig['category-id-analisis']);
		$tdata['listanalisis'] = $this->ContentModel->listArticle(array('id_category'=>$this->webconfig['category-id-analisis'],'slug'=>$sluganalisis,'limit'=>$this->webconfig['limitanalisis-home']));
		$slugvideo = $this->__getSlug($this->webconfig['category-id-video']);
		$tdata['listvideo'] = $this->ContentModel->listArticle(array('id_category'=>$this->webconfig['category-id-video'],'slug'=>$slugvideo,'limit'=>$this->webconfig['limitvideo-home']));				

		$ldata['content_block'] = $this->load->view('index',$tdata, true);
		$this->load->sharedView('template',$ldata);
		
	}
	private function __getSlug($id){
		$slug = $this->CategoryModel->__getCategorySlug(array('id'=>$id));
		$result = isset($slug['slug'])?$slug['slug']:'';
		return $result;
	}

}

