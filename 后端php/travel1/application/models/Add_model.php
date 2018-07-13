<?php  defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Add_model extends CI_Model{
		public function __construct() {
			parent::__construct();
		}
		public function add_deeptrip($yyy){
			$query = $this->db->insert('deeptrip',$yyy);
			return $query;
		}
	}

?>