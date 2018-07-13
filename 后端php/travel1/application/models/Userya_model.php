<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Userya_model extends CI_Model{
		public function __construct() {
			parent::__construct();
		}
		public function collect($region_id,$travel_note_id,$colection_type){
			$user = $this->session->userdata('user_id');
			$arr = array(
				'region_id' => $region_id,
				'travel_note_id' => $travel_note_id,
				'colection_type' => $colection_type,
				'colection_user_id' => $user,
			);
			$query = $this->db->insert('colection',$arr);
			return $query;
		}
		public function delcollect($colection_id){
			$arr = array(
				'colection_id' => $colection_id,
			);
			$query = $this->db->delete('colection',$arr);
			return $query;
		}
		public function jiebanya($cpartner_type,$cpartner_title,$cpartner_content,$cpartner_time){
			$user = $this->session->userdata('user_id');
			$arr = array(
				'cpartner_type' => $cpartner_type,
				'cpartner_title' => $cpartner_title,
				'cpartner_content' => $cpartner_content,
				'cpartner_time' => $cpartner_time,
				'cpartner_user_id' => $user,
			);
			$query = $this->db->insert('cpartner',$arr);
			return $query;
		}
		public function deljieban($cpartner_id){
			$arr = array(
				'cpartner_id' => $cpartner_id,
			);
			$query = $this->db->delete('cpartner',$arr);
			return $query;
		}
	}

?>