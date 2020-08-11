<?php

class Topoupdate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('directory');
    }

    public function index()
    {
        $data['title'] = 'Topo Update';
        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');
        // $data['open_tic']  = $this->app_model->getTotNewTicket();

        // $this->load->view('template/header', $data);
        // $this->load->view('template/menu', $data);
        // $this->load->view('webgis/topoupdate', $data);
        // $this->load->view('template/footer', $data);
        $this->template->display('webgis/topoupdate',$data);
    }
}
