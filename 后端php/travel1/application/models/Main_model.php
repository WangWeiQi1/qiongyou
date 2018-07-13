<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Main_model extends CI_Model{

        public function new_ins($table, $args) {
            $query = $this -> db -> insert($table, $args);
            return $query;
        }

        public function delete_ins($table, $condition) {
            $query = $this -> db -> delete($table, $condition);
            return $query;
        }

        public function update_ins($table, $condition, $args) {
            $this -> db -> where($condition);
            $query = $this -> db -> update($table, $args);
            return $query;
        }

        public function find_by($table, $args) {
            $query = $this -> db -> get_where($table, $args);
            $finda = $query -> result();
            return $finda;
        }

        public function all($table) {
            $query = $this -> db -> get($table);
            $finda = $query -> result();
            return $finda;
        }

        public function concat_all($table_main, $table_ceil, $condition, $condition_dicta) {
            // 'region.city_id = city.city_id'
            $this -> db -> select('*');
            $this -> db -> from($table_main);
            $this -> db -> join($table_ceil, $condition);
            $this -> db -> where($condition_dicta);
            $query = $this -> db -> get();
            $finda = $query -> result();
            return $finda;
        }





    }


 ?>
