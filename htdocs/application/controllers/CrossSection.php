<?php
class CrossSection extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
        }
        
        public function index()
        {
            $data['title'] = 'Welcome To GGD';

            $this->load->view('templates/headers');
            $this->load->view('ggd/crosssection', $data);
        }
}