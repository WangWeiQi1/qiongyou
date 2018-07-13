<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Insurance extends CI_Controller {
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


        public function issue() {
        	$arr = $this->input->post('params');
        	// var_dump($arr);

        	$this->load->model('Insurance_model');
        	$result = $this->Insurance_model->insert_data($arr);
        	// echo '$result';
        	echo json_encode($result);
        }

        public function search(){
        	// echo "search";
        	$arr = $this->input->post('params');
        	$this->load->model('Insurance_model');
        	$result = $this->Insurance_model->search_data($arr);
        	echo json_encode($result);
        }

        public function delate_data(){
            $arr = $this->input->post('params');
            // var_dump($arr);
            // die();
            $this->load->model('Insurance_model');
            $result = $this->Insurance_model->delate_data($arr);
            echo json_encode($result);
        }

        public function show_data(){
            $arr = $this -> input -> post('insurance_id');
            // var_dump($arr);
            $this -> load -> model('insurance_model');
            $result = $this -> insurance_model -> show($arr);
            echo json_encode($result);
        }

        public function updata_data(){
            $arr = $this -> input -> post('params');
            // var_dump($arr);
            $id = $arr['id'];
            $this -> load -> model('Insurance_model');
            $query = $this -> Insurance_model -> updataData($arr,$id);
            echo $query;
        }
    }


?>
