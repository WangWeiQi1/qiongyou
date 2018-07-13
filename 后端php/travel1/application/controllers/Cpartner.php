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
            $cpartner_id = $this -> input -> get('cpartnerlist_id');
            $condition = array(
                'cpartner_id' => $cpartner_id,
            );
            $this -> load -> model('Main_model');
            $query = $this -> Main_model -> delete_ins('cpartnerlist', $condition);
            if ($query) {
                echo 1;
            } else {
                echo 0;
            }
        }








    }


 ?>
