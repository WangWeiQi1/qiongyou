<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Cpartner extends CI_Controller{
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


        public function reply_add() {
            $data = $this -> input -> post('params');
            $this -> load -> model('Main_model');
            $query = $this -> Main_model -> new_ins('cpartner_reply', $data);
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }


        public function reply_delete() {
            $cpartner_id = $this -> input -> get('cpartner_id');
            $condition = array(
                'cpartner_id' => $cpartner_id,
            );
            $this -> load -> model('Main_model');
            $query = $this -> Main_model -> delete_ins('cpartner_reply', $condition);
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }


        public function list_add() {
            $data = $this -> input -> post('params');
            $this -> load -> model('Main_model');
            $query = $this -> Main_model -> new_ins('cpartnerlist', $data);
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }


        public function list_delete() {
            $cpartnerlist_id = $this -> input -> get('cpartnerlist_id');
            $condition = array(
                'cpartnerlist_id' => $cpartnerlist_id,
            );
            $this -> load -> model('Main_model');
            $query = $this -> Main_model -> delete_ins('cpartnerlist', $condition);
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }


        public function condition_all() {
            $cpartner_type = $this -> input -> get('cpartner_type');
            $this -> load -> model('Main_model');
            $dicta = array(
                'cpartner_type' => $cpartner_type,
            );
            $finda = $this -> Main_model -> concat_all(
                'cpartner',
                'user',
                'cpartner.cpartner_user_id = user.user_id',
                $dicta
            );
            echo json_encode($finda);
        }


        public function detail() {
            $cpartner_id = $this -> input -> get('cpartner_id');
            $this -> load -> model('Main_model');
            $dicta = array(
                'cpartner_id' => $cpartner_id,
            );
            $cpartner_detail = $this -> Main_model -> concat_all(
                'cpartner',
                'user',
                'cpartner.cpartner_user_id = user.user_id',
                $dicta
            );
            $cpartner_list = $this -> Main_model -> concat_all(
                'cpartner_reply',
                'user',
                'cpartner_reply.cpartner_reply_user_id = user.user_id',
                $dicta
            );
            $datas = array(
                'cpartner_detail' => $cpartner_detail,
                'cpartner_list' => $cpartner_list,
            );
            echo json_encode($datas);
        }








    }


 ?>
