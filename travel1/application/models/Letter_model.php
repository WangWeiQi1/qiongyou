<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Letter_model extends CI_Model{
    	public function insert_data($arr){
    		$query = $this->db->insert('letter',$arr);
    		var_dump($query);
    		return $query;
    	}

    	public function delate_data($arr){
    		$result = $this -> db -> delete('letter',$arr);
    		return $result;
    	}
    }

?>