<?php defined('BASEPATH') OR exit('No direct script access allowed');
	// deeptrip 管理
	class Admin extends CI_Controller{
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
			$this->load->model('Add_model');
			$query = $this->Add_model->add_deeptrip($yyy);
			if($query){
				echo 'success';
			}else{
				echo 'fail';
			}
		}
		public function show(){
			$this->load->model('Show_model');
			$query = $this->Show_model->showall();
			echo json_encode($query);
		}
		public function del(){
			$did = $this->input->post('did');
			$this->load->model('Del_model');
			$query = $this->Del_model->del_deeptrip($did);
		}
		public function detail(){
			$detail_id = $this->input->get('detail_id');
			$this->load->model('Show_model');
			$query = $this->Show_model->godetail($detail_id);
			echo json_encode($query);
		}
		public function update(){
			$detail_id = $this->input->post('did');
			$title = $this->input->post('title');
			$city = $this->input->post('city');
			$info = $this->input->post('info');
			$know = $this->input->post('know');
			$luxian = $this->input->post('luxian');
			$date = $this->input->post('date');
			$price = $this->input->post('price');
			$cover = $this->input->post('cover');
			$content = $this->input->post('content');
			$this->load->model('Update_model');
			$query = $this->Update_model->update_deeptrip($detail_id,$title,$city,$info,$know,$luxian,$date,$price,$cover,$content);
		}
		public function search(){
			$title = $this->input->get('title');
			$city = $this->input->get('city');
			$this->load->model('Show_model');
			$query = $this->Show_model->search_it($title,$city);
			echo json_encode($query);
		}
	}


?>
