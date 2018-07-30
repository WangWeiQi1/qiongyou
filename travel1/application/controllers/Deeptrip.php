<?php defined('BASEPATH') OR exit('No direct script access allowed');
	// deeptrip 管理
	class Deeptrip extends CI_Controller{
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
        public function deeptrip(){
        	$yyy = $this->input->post('params');
			$this->load->model('Main_model');
			$query = $this->Main_model->new_ins('deeptrip',$yyy);
			if($query){
				echo 'success';
			}else{
				echo 'fail';
			}
		}
		public function show(){
			$this->load->model('Main_model');
			$query = $this->Main_model->all('deeptrip');
			echo json_encode($query);
		}
		public function del(){
			$did = $this->input->post('did');
			$arr = array(
				'deeptrip_id' => $did,
			);
			$this->load->model('Main_model');
			$query = $this->Main_model->delete_ins('deeptrip',$arr);
		}
		public function detail(){
			$detail_id = $this->input->get('detail_id');
			$arr = array(
				'deeptrip_id' => $detail_id,
			);
			$this->load->model('Main_model');
			$finda = $this->Main_model->find_by('deeptrip',$arr)[0];
			echo json_encode($finda);
		}
		public function update(){
			$detail_id = $this->input->post('did');
			$arr = $this->input->post('params');
			$arr1 = array(
				'deeptrip_id' => $detail_id,
			);
			$this->load->model('Main_model');
			$query = $this->Main_model->update_ins('deeptrip',$arr1,$arr);
		}
		public function search(){
			$title = $this->input->get('title');
			$city = $this->input->get('city');
			$arr = array(
				'deeptrip_title' => $title,
			);
			$arr1 = array(
				'deeptrip_city' => $city,
			);
			$this->load->model('Main_model');
			$query = $this->Main_model->search_like('deeptrip',$arr,$arr1);
			echo json_encode($query);
		}
	}


?>
