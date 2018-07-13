<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
 		class Show_model extends CI_Model{
 			public function __construct(){
 				parent::__construct();
 			}
 			public function showall(){
 				$query = $this->db->get('deeptrip');
 				return $query->result();
 			}
 			public function godetail($detail_id){
 				$arr = array(
 					'deeptrip_id' => $detail_id,
 				);
 				$query = $this->db->get_where('deeptrip',$arr);
 				return $query->row();
 			}
 			public function search_it($title,$city){
 				$this->db->like('deeptrip_title',$title);
 				$this->db->like('deeptrip_city',$city);
 				$query = $this->db->get('deeptrip');
 				return $query->result();
 			}
 		}

?>