<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class TagsModel extends CI_Model{
	var $ci;
	function __construct() {	 
		parent::__construct();
		
		
		$this->maintablename = "tags";	
		
	}
	
	public function getTags($slug = ""){
		$query = $this->db->query("
			SELECT id,name,meta_title,meta_description FROM ".$this->maintablename." WHERE slug = '".$this->db->escape_str($slug)."'
			");
		$result = $query->first_row('array');	
		return $result;
	}

	
}