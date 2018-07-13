<?php defined('BASEPATH') OR exit('No direct script access allowed');
	// 结伴、收藏增删
	class Userya extends CI_Controller{
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
        public function colection(){
            $region_id = $this->input->post('region_id');
            $travel_note_id = $this->input->post('travel_note_id');
            $colection_type = $this->input->post('colection_type');
            $this->load->model('Userya_model');
            $query = $this->Userya_model->collect($region_id,$travel_note_id,$colection_type);
        }
        public function del(){
            $colection_id = $this->input->post('colection_id');
            $this->load->model('Userya_model');
            $query = $this->Userya_model->delcollect($colection_id);
        }
        public function jieban(){
            $cpartner_type = $this->input->post('cpartner_type');
            $cpartner_title = $this->input->post('cpartner_title');
            $cpartner_content = $this->input->post('cpartner_content');
            $cpartner_time = $this->input->post('cpartner_time');
            $this->load->model('Userya_model');
            $query = $this->Userya_model->jiebanya($cpartner_type,$cpartner_title,$cpartner_content,$cpartner_time);
        }
        public function deljie(){
            $cpartner_id = $this->input->post('cpartner_id');
            $this->load->model('Userya_model');
            $query = $this->Userya_model->deljieban($cpartner_id);
        }
    }
?>
