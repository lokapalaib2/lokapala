<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class ContentModel extends CI_Model{
	var $ci;
	function __construct() {	 
		parent::__construct();
		
		
		$this->maintablename = "content";	
		$this->table_category = "category";	
		$this->table_topics = "topics";	
		$this->table_users = "users";
		$this->table_tags="tags";
		$this->table_images = "images";
		$this->table_rel_content_tags = "rel_tags";
	}
	public function listDataTags($params=array()){
		$id = isset($params["id"])?$params["id"]:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$is_draft = isset($params["is_draft"])?$params["is_draft"]:'';
		$tipe = isset($params["tipe"])?$params["tipe"]:'';
		$offsetData  = "";
		$conditional = "";
		$conditional1 = "";
		$is_special = "";  
		$rest = "ORDER BY created_at DESC";				
		if (is_array($id) && count($id) > 0) {
			$id = implode(",", $id);
			$conditional .= " AND id_tags IN (".$this->db->escape_str($id).") ";
			$conditional1 .= " AND t.id_tags IN(".$this->db->escape_str($id).")";
		}else if($id != '') {
			$conditional .= " AND id_tags = '".$this->db->escape_str($id)."'";
			$conditional1 .= " AND t.id_tags = '".$this->db->escape_str($id)."'";
		}				
		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}
	
		$select = "
			SELECT 
				c.id as id,
				c.created_at as created_at,
				c.id_category as id_category,
				c.id_image_cover as id_image_cover,
				c.id_topics as id_topics,
				c.title as title,
				c.slug as slug,
				c.summary as summary,
				t.id_tags as id_tags
			FROM ".$this->maintablename." c
			INNER JOIN ".$this->table_rel_content_tags." t
			ON c.id = t.id_content

			WHERE 1=1 ".$conditional.$conditional1."
			
			".$rest."
			".$offsetData."
			";		
			$q = $this->db->query($select);
			$result = $q->result_array();
			$result = $this->__getImageCover($result);		
		return $result;
	}

	public function listDataCountTags($params=array()){
		$id = isset($params["id"])?$params["id"]:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$is_draft = isset($params["is_draft"])?$params["is_draft"]:'';
		$tipe = isset($params["tipe"])?$params["tipe"]:'';
		$offsetData  = "";
		$conditional = "";
		$conditional1 ="";				
		if (is_array($id) && count($id) > 0) {
			$id = implode(",", $id);
			$conditional .= " AND id_tags IN (".$this->db->escape_str($id).") ";
			$conditional1 .= " AND t.id_tags IN(".$this->db->escape_str($id).")";
		}else if($id != '') {
			$conditional .= " AND id_tags = '".$this->db->escape_str($id)."'";
			$conditional1 .= " AND t.id_tags = '".$this->db->escape_str($id)."'";
		}		
		$select = "
			SELECT 
				count(c.id) as jumlah
			FROM ".$this->maintablename." c
			INNER JOIN ".$this->table_rel_content_tags." t
			ON c.id = t.id_content
			WHERE 1=1 ".$conditional.$conditional1."
			";			
			$q = $this->db->query($select);
			$result = $q->first_row('array');
		return $result;
	}
	public function listArticle($params = array()){
		$id_category = isset($params['id_category'])?$params['id_category']:'';
		$start = isset($params['start'])?$params['start']:'';
		$limit = isset($params['limit'])?$params['limit']:'';
		$is_headline = isset($params['is_headline'])?$params['is_headline']:'';
		$arr_exclude = isset($params['arr_exclude'])?$params['arr_exclude']:'';
		$conditional="";
		$offsetData = "";
		$order="ORDER BY id DESC";
		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}
        if($is_headline != 0){
            $conditional .= " AND id_category NOT IN (51) ";
        }
		if (is_array($arr_exclude) && count($arr_exclude) > 0) {
			$str_exclude = implode(",", $arr_exclude);
			$conditional .= " AND id NOT IN (".$this->db->escape_str($str_exclude).") ";
		}
		if (is_array($id_category) && count($id_category) > 0) {
			$id_category = implode(",", $id_category);
			$conditional .= " AND id_category IN (".$this->db->escape_str($id_category).") ";
		
		} else if ($id_category != '') {
			$conditional .= " AND id_category = ".$this->db->escape_str($id_category)." ";
		}

		
		$query = $this->db->query("
				SELECT 
					*
				FROM ".$this->maintablename." WHERE 1=1
				".$conditional."
				".$order."
				".$offsetData."
			");
		$result = $query->result_array();
		$result = $this->__getCategory($result);
		$result = $this->__getTopics($result);
		$result = $this->__getPenulis($result);
		$result = $this->__getImageCover($result);
		return $result;
	}
	public function listTerpopuler($params = array()){
		$start = isset($params['start'])?$params['start']:'';
		$limit = isset($params['limit'])?$params['limit']:'';
		$id_category = isset($params['id_category'])?$params['id_category']:'';
		$arr_exclude = isset($params['arr_exclude'])?$params['arr_exclude']:'';
		$interval = isset($params['interval'])?$params['interval']:'7';
		$conditional = "";
		$str_exclude = "";
		$offsetData = "";
	
		if (is_array($id_category) && count($id_category) > 0) {
			$id_category = implode(",", $id_category);
			$conditional .= " AND id_category IN (".$this->db->escape_str($id_category).") ";
		} else {
			if ($id_category != "") {
				$conditional .= " AND id_category = ".$this->db->escape_str($id_category)." ";
			}
		}		

		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}

		if (is_array($arr_exclude) && count($arr_exclude) > 0) {
			$str_exclude = implode(",", $arr_exclude);
			$conditional .= " AND id NOT IN (".$this->db->escape_str($str_exclude).") ";
		}		
		$query = $this->db->query("
				SELECT 
					*
				FROM ".$this->maintablename." WHERE  DATE(created_at) > DATE_SUB(CURDATE(), INTERVAL ".$this->db->escape_str($interval)." DAY)
				".$conditional."
				".$offsetData."
			");
		$result = $query->result_array();
		$result = $this->__getCategory($result);
		$result = $this->__getTopics($result);
		$result = $this->__getImageCover($result);
		return $result;
	}
	public function detailContent($params=array()){
		$id = isset($params["id"])?$params["id"]:'';
		$year = isset($params["year"])?$params["year"]:'';
		$month = isset($params["month"])?$params["month"]:'';
		$day = isset($params["day"])?$params["day"]:'';
		$slug = isset($params["slug"])?$params["slug"]:'';
		$offsetData  = "";
		$conditional = "";
		$status = " status = 1";
		$rest = "ORDER BY created_at DESC";
		if($id != '') {
			$conditional = " AND 
								id = '".$this->db->escape_str($id)."' 
								AND slug = '".urldecode($slug)."'
								AND DAY(created_at) = '".$this->db->escape_str($day)."'
								AND MONTH(created_at) = '".$this->db->escape_str($month)."'
								AND YEAR(created_at) = '".$this->db->escape_str($year)."'
								";
		}else{
			$conditional = " 
								AND slug = '".urldecode($slug)."'
								AND DAY(created_at) = '".$this->db->escape_str($day)."'
								AND MONTH(created_at) = '".$this->db->escape_str($month)."'
								AND YEAR(created_at) = '".$this->db->escape_str($year)."'
								";
		}
		$id = isset($getid['id'])?$getid['id']:'';
		$q = $this->db->query("
				SELECT
					*

				FROM
				".$this->maintablename."
				WHERE".$status."
				".$conditional."
				".$rest."
		");

		$result = $q->first_row('array');
		$result = $this->__getTopicsDetail($result);		
		$result = $this->__getCategoryDetail($result);
		$result = $this->__getArrayTags($result);
		$result = $this->__getPenulisDirect($result);
		$result = $this->__getTagsDetail($result);
		$result = $this->__getImagesCoverDetail($result);

		
		
		return $result;
	}
	private function __getTagsDetail($result){
		if (count($result) > 0) {
			if ($result['id'] != 0 ) {
				$result['tags'] = $this->__getTagsSQLDetail($result['id']);
			}else{
				$result['tags'] = "";
			}
		}

		return $result;
	}

	private function __getTagsSQLDetail($id){
		$result = array();
		$query = $this->db->query("
			SELECT id_content, GROUP_CONCAT(id_tags SEPARATOR ', ') as string_tags FROM ".$this->table_rel_content_tags." WHERE id_content = ".$this->db->escape_str($id)."
			");
		$result = $query->first_row('array');
		return $result;
	}
	public function listBeritaTerkait($params = array()){
		$id_exclude = isset($params["id_exclude"])?$params["id_exclude"]:'';
		$id_tags = isset($params["id_tags"])?$params["id_tags"]:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$orders = isset($params["orders"])?$params["orders"]:'';
		$offsetData  = "";
		$conditional = "";
		$conditional1="";
		$order = "ORDER BY c.created_at DESC";
		if($id_exclude != 0){
			$conditional .= " AND r.id_content NOT IN (".$this->db->escape_str($id_exclude).") ";
		}
		if($orders != ''){
			$order = $orders;
		}
		if ($id_tags != 0) {
			$conditional .= " AND r.id_tags IN (".$this->db->escape_str($id_tags).") ";
		}else{
			$conditional .= " AND r.id_tags IN (0) ";
		}

		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}
		$query = $this->db->query("
				SELECT
					c.id as id_content,
					c.id_category as id_category,
					c.created_at as created_at,
					c.title as title,					
					c.slug as slug,
					c.summary as summary,
					r.id_tags as id_tags
				FROM ".$this->maintablename." c INNER JOIN ".$this->table_rel_content_tags." r 
				WHERE c.id = r.id_content AND status = 1 
				".$conditional."
				GROUP BY r.id_content
				".$order."
				".$offsetData."	
		");
		$result = $query->result_array();
		$result = $this->__getImageCover($result);
		return $result;
	}
	private function __getTopicsDetail($result){
		if (count($result)>0) {
			if ($result['id_topics'] != "") {
				$result['topics'] = $this->db->query("SELECT * FROM ".$this->table_topics." WHERE id = ".$result['id_topics']." ")->first_row('array');
			}else{
				$result['topics'] = array();
			}
		}else{
			$result = array();
		}

		return $result;
	}
	private function __getCategoryDetail($result){
		if (count($result)>0) {

			if ($result['id_category'] != "") {
				$result['category'] = $this->__getCategorySQLDetail($result['id_category']);
			}else{
				$result['category'] = array();
			}
		}else{
			$result = array();
		}

		return $result;
	}

	private function __getCategorySQLDetail($id_category){
		$result = array();
		$query = $this->db->query("
			SELECT id,name,slug FROM ".$this->table_category." WHERE id = ".$this->db->escape_str($id_category)."
			");
		$result = $query->first_row('array');
		return $result;
	}
	private function __getArrayTags($result){
		if (count($result)>0) {
			if ($result['id'] != 0) {
				$result['tagsarray'] = $this->__getArrayTagsSQL($result['id']);
			}else{
				$result['tagsarray'] = "";
			}
		}

		return $result;
	}

	private function __getArrayTagsSQL($id){
		$query = $this->db->query("
			SELECT * FROM ".$this->table_rel_content_tags." WHERE id_content = ".$this->db->escape_str($id)."
			");
		$result = $query->result_array();
		$result = $this->__getArrayTagsDetail($result);
		return $result;
	}

	private function __getArrayTagsDetail($result){
		if (count($result)>0) {
			foreach ($result as $key => $value) {
				if ($value['id_tags'] != 0) {
					$result[$key]['detail'] = $this->db->query("
						SELECT id,name,slug FROM ".$this->table_tags." WHERE id = ".$value['id_tags']."
						")->first_row('array');
				}else{
					$result[$key]['detail'] = "";
				}
			}
		}

		return $result;
	}
	private function __getCategory($result){
		if (count($result)>0) {
			foreach ($result as $key => $value) {
				if ($value['id_category'] != 0) {
					$result[$key]['category'] = $this->__getCategorySQL($value['id_category']);
				}else{
					$result[$key]['category'] = "";
				}
			}
		}

		return $result;
	}

	private function __getCategorySQL($id_category){
		$result = array();
		$query = $this->db->query("
			SELECT * FROM ".$this->table_category." WHERE id = ".$this->db->escape_str($id_category)."
			");
		$result = $query->first_row('array');
		return $result;
	}
	private function __getTopics($result){
		if (count($result)>0) {
			foreach ($result as $key => $value) {
				if ($value['id_topics'] != 0) {
					$result[$key]['topics'] = $this->__getTopicsSQL($value['id_topics']);
				}else{
					$result[$key]['topics'] = "";
				}
			}
		}

		return $result;
	}

	private function __getTopicsSQL($id_topics){
		$result = array();
		$query = $this->db->query("
			SELECT * FROM ".$this->table_topics." WHERE id = ".$this->db->escape_str($id_topics)."
			");
		$result = $query->first_row('array');
		return $result;
	}
	private function __getPenulisDirect($result){
		if (isset($result['id_penulis']) && $result['id_penulis'] != "") {
			$arr_penulis = explode(",", $result['id_penulis']);
			if (count($arr_penulis)>0) {
				foreach ($arr_penulis as $key => $value) {
					if ($value != 0) {
						$result['penulis'][$key] = $this->__getUsersSQL($value);
					}else{
						$result['penulis'][$key] = "";
					}
				}
			}
		}

		return $result;
	}
	private function __getPenulis($result){
		if (count($result)>0) {
			foreach ($result as $key => $value) {
				if (isset($value['id_penulis']) && $value['id_penulis'] != "") {
					$arr_penulis = explode(",", $value['id_penulis']);
					if (count($arr_penulis)>0) {
						foreach ($arr_penulis as $key2 => $value2) {
							if ($value != 0) {
								$result[$key]['penulis'][$key2] = $this->__getUsersSQL($value2);
							}else{
								$result[$key]['penulis'][$key2] = "";
							}
						}
					}
				}
			}
		}

		return $result;
	}
	private function __getUsersSQL($id_penulis){
		$result = array();
		if ($id_penulis != '') {
			$query = $this->db->query("
				SELECT 
					id,
					name as fullname,
					email
				FROM ".$this->table_users." WHERE id = ".$this->db->escape_str($id_penulis)."
				");
			$result = $query->first_row('array');
		}

		return $result;
	}
	public function listDataIndex($params = array()){
		$pagename = isset($params["pagename"])?$params["pagename"]:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$offsetData  = "";
		$conditional = "  ";
		$rest = "ORDER BY created_at DESC";

		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}

		### CEK REDIS ###
				$query = $this->db->query("
				SELECT 
							*
				FROM ".$this->maintablename." 
				WHERE status = 1 
				".$conditional."
				".$rest."
				".$offsetData."
				");

			$result = $query->result_array();
			$result = $this->__getCategory($result);
			$result = $this->__getTopics($result);
			$result = $this->__getImageCover($result);
		
		
		return $result;
	}

	public function listDataIndexid($params = array()){
		$pagename = isset($params["pagename"])?$params["pagename"]:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$offsetData  = "";
		$conditional = " ";
		$rest = "ORDER BY created_at DESC";

		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}

		### CEK REDIS ###

		$query = $this->db->query("
			SELECT 
				count(id) as jumlah
			FROM ".$this->maintablename." 
			WHERE status = 1  
			".$conditional."
			".$rest."
			".$offsetData."
			");
		$result = $query->first_row('array');	
		
		
		return $result;
	}

	public function filterDataIndex($params = array()){
		$tanggal = isset($params['tanggal'])?$params['tanggal']:'';
		$tanggal_akhir = isset($params['tanggal_akhir'])?$params['tanggal_akhir']:'';
		$id_category = isset($params['id_category'])?$params['id_category']:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$offsetData  = "";
		$conditional = " ";
		$rest = "ORDER BY created_at DESC";

		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}
		
		if ($tanggal != "") {
			$tanggal = date_reformat('Y-m-d',$tanggal);
			$conditional .= " AND DATE(created_at) >= '".$tanggal."' ";
		}
		
	
		if ($id_category != "") {
			
			$conditional .= " AND id_category = ".$this->db->escape_str($id_category)." ";
			
		}

		
	
			$query = $this->db->query("
				SELECT 
				*
				FROM ".$this->maintablename." 
				WHERE status = 1  
				".$conditional."
				".$rest."
				".$offsetData."
				");

			$result = $query->result_array();
			$result = $this->__getCategory($result);
			$result = $this->__getTopics($result);
			$result = $this->__getImageCover($result);
		
		
		return $result;
	}

	public function filterDataIndexId($params = array()){
		$tanggal = isset($params['tanggal'])?$params['tanggal']:'';
		$tanggal_akhir = isset($params['tanggal_akhir'])?$params['tanggal_akhir']:'';
		$id_category = isset($params['id_category'])?$params['id_category']:'';
		$start = isset($params["start"])?$params["start"]:'';
		$limit = isset($params["limit"])?$params["limit"]:'';
		$offsetData  = "";
		$conditional = "  ";
		$rest = "ORDER BY created_at DESC";

		if($limit > 0){
			if($start > 0){
				$offsetData = "LIMIT ".$start.", ".$limit."";
			}else{
				$offsetData = "LIMIT 0, ".$limit."";
			}
		}
		
		if ($tanggal != "") {
			$tanggal = date_reformat('Y-m-d',$tanggal);
			$conditional .= " AND DATE(created_at) >= '".$tanggal."' ";
		}
		
		

		if ($id_category != "") {
			$conditional .= " AND id_category = ".$this->db->escape_str($id_category)." ";
		}

		

		### CEK REDIS ###
	
		$query = $this->db->query("
			SELECT 
				count(id) as jumlah
			FROM ".$this->maintablename." 
			WHERE status = 1  
			".$conditional."
			".$rest."
			".$offsetData."
			");
		$result = $query->first_row('array');
		
		
		return $result;
	}
	private function __getImagesCoverDetail($result){
		if (count($result)>0) {
			if (isset($result['id_image_cover']) && $result['id_image_cover'] !=0) {
				$result['imagecover'] =  $this->__getImagesSQL($result['id_image_cover']);
			}
		}

		return $result;
	}

	
	private function __getImageCover($result){
		if (count($result)>0) {
			foreach ($result as $key => $value) {
				if (isset($value['id_image_cover'] ) && $value['id_image_cover'] != 0) {
					$result[$key]['imagecover'] = $this->__getImagesSQL($value['id_image_cover']);
				}else{
					$result[$key]['imagecover'] = "";
				}
			}
		}

		return $result;
	}
	private function __getImagesSQL($id_image){
		$result = array();
		if ($id_image != 0) {
			$query = $this->db->query("
					SELECT 
					*
					FROM ".$this->table_images." 
					WHERE id = ".$this->db->escape_str($id_image)."
				");
			$result = $query->first_row('array');
		}

		return $result;
	}

}