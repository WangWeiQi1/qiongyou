<?php defined('BASEPATH') OR exit('No direct script access allowed');
 	
 	class Update_model extends CI_Model{
 		public function __construct(){
 			parent::__construct();
 		}
 		public function update_deeptrip($detail_id,$title,$city,$info,$know,$luxian,$date,$price,$cover,$content){
 			$user = $this->session->userdata('user_id');
 			$arr = array(
 				'user_id' => $user,
				'deeptrip_title' => $title,
				'deeptrip_city' => $city,
				'deeptrip_info' => $info,
				'deeptrip_price' => $price,
				'deeptrip_message' => $know,
				'deeptrip_line_info' => $luxian,
				'deeptrip_time' => $date,
				'deeptrip_photo' => $cover,
				'deeptrip_conimg' => $content,
 			);
 			$this->db->where('deeptrip_id',$detail_id);
 			$query = $this->db->update('deeptrip',$arr);
 			return $query;
 		}
 	}

?>