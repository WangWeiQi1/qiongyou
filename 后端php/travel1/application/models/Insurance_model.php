<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    class Insurance_model extends CI_Model{
    	public function insert_data($arr){
    		$data = array(
    			'insurance_price' => $arr['price'],
    			'insurance_type' => $arr['city'],
    			'insurance_name' => $arr['title'],
    			'insurance_phone' => $arr['phone'],
    			'insurance_content' => $arr['info'],
    		);
    		$query = $this->db->insert('insurance',$data);
    		// var_dump($query);
    		return $query;
    	}

    	public function search_data($arr){
    		// var_dump($arr);
    		$data = array(
    			'insurance_type' => $arr['type'],
    			'insurance_name' => $arr['title'],
    		);
    		$name = $arr['title'];
    		// $this->db->from('insurance');
    		// var_dump($data);
    		// $query = $this->db->where($data);
    		// return $query->result();
    		// $query = $this -> db -> get_where('insurance', $data);
    		$query = $this -> db -> query("select * from insurance where insurance_name like '%$name%'");
    		$finda = $query -> result();
    		return $finda;
    	}

    	public function delate_data($arr){
    		$data = array(
    			'insurance_id' => $arr['id']
    		);

    		$result = $this -> db -> delete('insurance',$data);
    		// var_dump($result);//true
    		// die();
    		return $result;
    	}

    	public function show($arr){
    		$data = array(
    			'insurance_id' => $arr,
    		);
    		$result = $this -> db -> get_where('insurance',$data);
    		// var_dump($result->row());
    		return $result -> row();
    	}

    	public function updataData($arr,$id){
    		$data = array(
    			'insurance_price' => $arr['price'],
    			'insurance_type' => $arr['city'],
    			'insurance_name' => $arr['title'],
    			'insurance_phone' => $arr['phone'],
    			'insurance_content' => $arr['info'],
    		);
    		$this -> db -> where('insurance_id',$id);
    		$query = $this -> db -> update('insurance',$data);
    		return $query;
    		// var_dump($result -> row());
    	}
	}
?>
