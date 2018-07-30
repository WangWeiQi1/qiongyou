<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {
    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin:http://127.0.0.1:8080");
        // response.setHeader("Access-Control-Allow-Origin", "http://127.0.0.1:8010");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT');
        header("Access-Control-Allow-Credentials: true");
    }


    public function do_upload() {
        // echo "do_upload";
        $root = base_url();
        $config['upload_path']      = './assets/uploads/';

        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 0;
        $config['max_width']        = 0;
        $config['max_height']       = 0;
        $config['encrypt_name']     = True;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $this->upload->display_errors('<p>', '</p>');
            echo "<pre>";
            var_dump($this->upload->display_errors('<p>', '</p>'));
            echo "</pre>";
            echo "上传图片错误";
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $this -> upload -> data()['file_name'];
            echo $filename;
            // var_dump($data);
            // echo "上传图片成功";
        }

    }








}
?>
