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
class Content extends CI_Controller {
	var $webconfig;
	var $pagename;
	var $configuration;
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->webconfig = $this->config->item('webconfig');
		$this->load->sharedModel('ConfigurationModel');
		$this->configuration = $this->ConfigurationModel->listData();
		$this->load->sharedModel('CategoryModel');
		$this->load->sharedModel('ContentModel');	
	}
	function detail($year,$month,$day,$slug = "", $page = 0) {
		$tdata = $ldata = array();
		$arr_exclude = array();
		$this->pagename = "Detail ";
		$ldata['site_title'] = "lokapala";
		$ldata['menu'] = $this->CategoryModel->listData(array('is_menu'=>1));
		$ldata['rumors'] = $this->ContentModel->listArticle(array('limit'=>5));
		$tdata['menu'] = $ldata['menu'];
		$tdata['detail'] = $this->ContentModel->detailContent(array(
																		'year'=>$year,
																		'month'=>$month,
																		'day'=>$day,
																		'slug'=>$slug
																	));
		$ldata['detail'] = $tdata['detail'];
		if(count($tdata['detail']) == 0){
			
				redirect('notfound');
			
		} else {
			$arr_exclude[] = $tdata['detail']['id'];
			$tagsforkeyword = array();
			if (isset($tdata['detail']['tagsarray']) && count($tdata['detail']['tagsarray'])>0) {
				foreach ($tdata['detail']['tagsarray'] as $key => $value) {
					$tagsforkeyword[] = isset($value['detail']['name'])?$value['detail']['name']:'';
				}
			}
			if (count($tagsforkeyword)>0) {
				$ldata['meta_keyword'] = implode(", ", $tagsforkeyword);
			}

			$this->pagename_title = isset($tdata['detail']['title'])?$tdata['detail']['title']:'';
			$this->pagename_category = isset($tdata['detail']['category']['name'])?$tdata['detail']['category']['name']:'';
			$ldata['meta_url'] = url_reformat($tdata['detail']);
			$ldata['meta_desc'] = isset($tdata['detail']['summary'])?$tdata['detail']['summary']:'';
			$tdata['meta_url'] = url_reformat($tdata['detail']);
			$tdata['meta_desc'] = isset($tdata['detail']['summary'])?$tdata['detail']['summary']:'';	     
			$tdata['ogurl'] = url_reformat($tdata['detail']);
			$tdata['meta_title'] = "";
			$ldata['meta_title'] = "";
			$tdata['author'] = "";
			$ldata['author'] = "";
			$tdata['fbauthor'] = "";
			$ldata['fbauthor'] = "";			
			$tdata['meta_title'] = isset($tdata['detail']['title'])?$tdata['detail']['title']:'';
			$ldata['meta_title'] = isset($tdata['detail']['title'])?$tdata['detail']['title']:'';				
			$tdata['ogdesc'] = isset($tdata['detail']['summary'])?$tdata['detail']['summary']:'';
			$string_tags = isset($tdata['detail']['tags']['string_tags'])?$tdata['detail']['tags']['string_tags']:0;
			$tdata['listberitaterkait'] = $this->ContentModel->listBeritaTerkait(array('id_tags'=>$string_tags,'id_exclude'=>$tdata['detail']['id'],'limit'=>6));
			
			if ($tdata['detail']['id_category'] == $this->webconfig['category-id-berita']){
				
				$ldata['panel']='panel_berita';
			}elseif ($tdata['detail']['id_category'] == $this->webconfig['category-id-grafik']){
				
				$ldata['panel']='panel_grafik';
				
			}elseif ($tdata['detail']['id_category'] == $this->webconfig['category-id-video']){
				
				$ldata['panel']='panel_multimedia';
				
			}
		 	//$tdata['listberitaterkait'] = $this->ContentModel->listBeritaTerkait(array('id_tags'=>$string_tags,'id_exclude'=>$tdata['detail']['id'],'limit'=>6));		 	
			if($tdata['detail']['id_category'] == $this->webconfig['category-id-berita'] || $tdata['detail']['id_category'] ==  $this->webconfig['category-id-video'] || $tdata['detail']['id_category'] ==  $this->webconfig['category-id-grafik'] ){
				$ldata['content_block'] = $this->load->view($this->router->class.'/detail_general',$tdata, true);
				$this->load->sharedView('template_kanal',$ldata);
			}else{
				$ldata['content_block'] = $this->load->view($this->router->class.'/detail',$tdata, true);
				$this->load->sharedView('template_detail',$ldata);	
			}		

		}
	}

}
	

	


