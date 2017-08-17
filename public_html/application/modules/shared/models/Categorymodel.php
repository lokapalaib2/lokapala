<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class CategoryModel extends CI_Model{
	var $ci;
	function __construct() {	 
		parent::__construct();
		$this->maintablename = "category";	
	
	}
	public function listData($params = array()){
		$is_menu = isset($params['is_menu'])?$params['is_menu']:'';
		$conditional='';
		if($is_menu != ''){
			$conditional .= " AND is_menu = '".$this->db->escape_str($is_menu)."' ";
		}
		$exclude_category = isset($params['exclude_category'])?$params['exclude_category']:'';
	
		if ($exclude_category != "") {
			if (is_array($exclude_category) && count($exclude_category) > 0) {
			$exclude_category = implode(",", $exclude_category);
				$conditional .= " AND id NOT IN (".$this->db->escape_str($exclude_category).") ";
			} else {
				$conditional .= " AND id NOT IN (".$this->db->escape_str($exclude_category).") ";
			}
		}

		### CEK REDIS ###
		
			$q = $this->db->query("
				SELECT
					*
				FROM
					".$this->maintablename."
				WHERE 1=1
				".$conditional."
				ORDER BY id ASC
			");
			$result = $q->result_array();
		
		
		return $result;
	}
	public function __getCategorySlug($params = array()){
		$id = isset($params['id'])?$params['id']:'';
		$query = $this->db->query("
			SELECT name,slug FROM ".$this->maintablename." WHERE id = '".$this->db->escape_str($id)."' 
			");
		$result = $query->first_row('array');
		
		
		return $result;
	}
	public function __getCategoryid($params = array()){
		$slug = isset($params['slug'])?$params['slug']:'';
		$query = $this->db->query("
			SELECT id,name,slug FROM ".$this->maintablename." WHERE slug = '".$this->db->escape_str($slug)."' 
			");
		$result = $query->first_row('array');
		
		
		return $result;
	}
	
}