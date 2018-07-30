<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Letter extends CI_Controller {
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

        public function do_insert(){
        	$arr = $this -> input -> post('params');
        	$this -> load -> model('Letter_model');
        	$result = $this -> Letter_model -> insert_data($arr);
        	// echo $result;
        	echo json_encode($result);
        }

        public function do_delate(){
        	$arr = $this -> input -> post('params');
        	$this -> load -> model('Letter_model');
        	$result = $this -> Letter_model -> delate_data($arr);
        	echo json_encode($result);
        }


	}
?>