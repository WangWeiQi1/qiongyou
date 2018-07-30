<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller{
        public function __construct() {
            parent::__construct();
            // header("Access-Control-Allow-Origin:*");
            // 下面这里上线时候要换，如果 设置 Credentials 就不能写 *
            header("Access-Control-Allow-Origin:http://127.0.0.1:8080");
            // response.setHeader("Access-Control-Allow-Origin", "http://127.0.0.1:8010");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
            header('Access-Control-Allow-Methods: GET, POST, PUT');
            header("Access-Control-Allow-Credentials: true");

        }

        public function test() {
            $args = array(
                'test' => 1,
            );
            // echo "string";
            var_dump($this -> session -> userdata('username'));
        }

        public function regist() {
            $username = $this -> input -> get('username');
            $password = $this -> input -> get('password');

            $args = array(
                'username' => $username,
                'password' => md5($password),
            );
            $this -> load -> model('Main_model');
            $finda = $this -> Main_model -> find_by('user', $args);
            if (count($finda) == 0) {
                $query = $this -> Main_model -> new_ins('user', $args);
                if ($query) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }

        }

        public function login() {
            $username = $this -> input -> post('username');
            $password = $this -> input -> post('password');

            $args = array(
                'username' => $username,
                'password' => md5($password),
            );
            $this -> load -> model('Main_model');
            $finda = $this -> Main_model -> find_by('user', $args);
            if (count($finda) == 0) {
                // echo "没有找到用户，登录失败";
                echo 0;
            } else {
                $username = $finda[0] -> username;
                $user_id = $finda[0] -> user_id;
                $args = array(
                    'username' => $username,
                    'user_id' => $user_id,
                    'logged' => TRUE,
                );
                $this -> session -> set_userdata($args);
                $s_username = $this -> session -> userdata('username');
                // var_dump($this -> session -> userdata);
                // echo "找到用户，登录成功。开始设置 session 吧";
                echo $s_username;
            }
        }

        public function current_user() {
            $username = $this -> session -> userdata('username');
            $user_id = $this -> session -> userdata('user_id');
            $args = array(
                'username' => $username,
                'user_id' => $user_id,
            );
            echo json_encode($args);
        }

        public function logout() {
            $lista = array('username', 'user_id', 'logged');
            $this -> session -> unset_userdata($lista);
            $username = $this -> session -> userdata('username');
            $user_id = $this -> session -> unset_userdata('user_id');
            $args = array(
                'username' => $username,
                'user_id' => $user_id,
            );
            // echo $username;
            echo json_encode($args);

        }



    }


 ?>
