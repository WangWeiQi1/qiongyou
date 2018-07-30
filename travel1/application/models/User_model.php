<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class User_model extends CI_Model{



        public function check_user($username) {
            $dicta = array(
                'username' => $username,
            );
            $query = $this -> db -> get_where('user', $dicta);
            $finda = $query -> row();
            return $finda;
        }

        public function new_user($username, $password) {
            $dicta = array(
                'username' => $username,
                'password' => $password,
            );
            $query = $this -> db -> insert('user', $dicta);
            return $query;
        }

        public function user_login($username, $password) {
            $dicta = array(
                'username' => $username,
                'password' => $password,
            );
            $query = $this -> db -> get_where('user', $dicta);
            $finda = $query -> row();
            return $finda;
        }



    }


 ?>
