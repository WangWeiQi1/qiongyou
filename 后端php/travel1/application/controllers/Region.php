<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Region extends CI_Controller{
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

        public function add() {
            $data = $this -> input -> post('params');
            $this -> load -> model('Main_model');
            $query = $this -> Main_model -> new_ins('region', $data);
            $user_id = $this -> session -> userdata('user_id');
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }

        public function update() {
            $data = $this -> input -> post('params');
            $region_id = $this -> input -> post('region_id');
            $this -> load -> model('Main_model');
            $condition = array(
                'region_id' => $region_id,
            );
            $query = $this -> Main_model -> update_ins('region', $condition, $data);
            $user_id = $this -> session -> userdata('user_id');
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }

        public function delete() {
            $region_id = $this -> input -> get('region_id');
            $this -> load -> model('Main_model');
            $condition = array(
                'region_id' => $region_id,
            );
            $query = $this -> Main_model -> delete_ins('region', $condition);
            $user_id = $this -> session -> userdata('user_id');
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }


        public function all() {
            $this -> load -> model('Main_model');
            $dicta = array();
            $finda = $this -> Main_model -> concat_all(
                'region',
                'city',
                'region.city_id = city.city_id',
                $dicta
            );
            echo json_encode($finda);
        }


        public function condition_all() {
            $region_type = $this -> input -> get('region_type');
            $this -> load -> model('Main_model');
            $dicta = array(
                'region_type' => $region_type,
            );
            $finda = $this -> Main_model -> concat_all(
                'region',
                'city',
                'region.city_id = city.city_id',
                $dicta
            );
            echo json_encode($finda);
        }



        public function detail() {
            $region_id = $this -> input -> get('region_id');
            $this -> load -> model('Main_model');
            $dicta = array(
                'region_id' => $region_id,
            );
            $region_detail = $this -> Main_model -> find_by('region', $dicta);
            $reply_list = $this -> Main_model -> concat_all(
                'region_reply',
                'user',
                'region_reply.region_reply_user_id = user.user_id',
                $dicta
            );
            $datas = array(
                'region_detail' => $region_detail,
                'reply_list' => $reply_list,
            );
            echo json_encode($datas);

        }









    }


 ?>
