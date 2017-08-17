<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class ConfigurationModel extends CI_Model{
	var $ci;
	function __construct() {	 
		parent::__construct();
		
		
		$this->maintablename = "configuration";	
		
	}
	
	public function listData(){
		$q = $this->db->query("
				SELECT
					*
				FROM
					".$this->maintablename."
				ORDER BY id DESC
			");
			$result = $q->first_row('array');
		
		return $result;
	}

	
}