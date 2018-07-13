<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Del_model extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		public function del_deeptrip($did){
			$arr = array(
				'deeptrip_id' => $did,
			);
			$query = $this->db->delete('deeptrip',$arr);
			return $query;
		}
	}


?>