<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class HalamanModel extends CI_Model{
	var $ci;
	function __construct() {	 
		parent::__construct();
		
		
		$this->maintablename = "page";	
		$this->table_pagebottom = "pagebottom";
	}
	
	public function listData($params = array()){
		$pagename = isset($params['pagename'])?$params['pagename']:'';
		
			$q = $this->db->query("
				SELECT
					id
					,slug
					,title
			
					,status
				FROM
					".$this->maintablename."
				WHERE status = 1  AND is_menu = 1
				ORDER BY id DESC
			");
			$result = $q->result_array();
		
		
		return $result;
	}

	
}