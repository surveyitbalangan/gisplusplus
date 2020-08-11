<?php

    class Datalist extends CI_Controller {
        public function __construct()
        {
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == "OPTIONS") {
                die();
            }
            parent::__construct();
            $this->load->helper('url_helper');
            $this->load->model("datalist_model");
        }
        
        public function index()
        {
            $data['title'] = 'Webgis BC';
            // $data['datalist'] = $this->datalist_model->get_table_list();

            $this->load->view('datalist/index', $data);
        }

        public function view($slug = NULL)
        {
            $data['datalist_item'] = $this->datalist_model->get_table_list();
        }

    }

?>