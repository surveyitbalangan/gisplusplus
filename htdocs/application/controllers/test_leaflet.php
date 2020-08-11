<?php

class test_leaflet extends CI_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index()
    {
        // $data['title'] = 'Webgis BC';
        // $data['judul']        = $this->config->item('lisensi_app');
        // $data['perusahaan'] = $this->config->item('nama_perusahaan');
        // $data['deskripsi'] = $this->config->item('app_fullname');
        // $data['footer']     = $this->config->item('copyright');
        // $data['app_name']     = $this->config->item('app_name');
        // $data['level']     = $this->session->userdata('level');
        // $data['nik']         = $this->session->userdata('nik_intranet');
        // $data['nama']         = $this->session->userdata('nama_intranet');
        // $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');

        // $this->load->view('webgis/webgis', $data);
        $this->load->view('leaflet');
    }
}
