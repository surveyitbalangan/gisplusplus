<?php

class Disposal extends CI_Controller
{

    public function __construct()
    {
        // $this->load->database('disposal_all');
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->model('disposal_model');
    }

    public function index()
    {
        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');
        $data['data_disposal'] = $this->disposal_model->get_all();


        $this->template->display('webgis/disposal/index', $data);
    }

    public function tambah_data()
    {
        $data['title'] = 'Tambah Data';

        $this->load->view('webgis/disposal/tambahdata', $data);
    }

    public function simpan()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('st_astext(shape)'),
        );

        $this->disposal_model->simpan($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('disposal');
    }

    public function edit($objectid_1)
    {
        $objectid_1 = $this->uri->segment(3);

        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');

        $data['title']   = 'Edit Data disposal';
        $data['data_disposal']   = $this->disposal_model->edit($objectid_1);


        $this->template->display('webgis/disposal/editdata', $data);
    }

    public function update()
    {

        //correction is here

        $id['objectid_1'] = $this->input->post('objectid');

        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('shape'),
        );

        $this->disposal_model->update($data, $id);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('disposal');
    }

    public function hapus($objectid_1)
    {
        $id['objectid_1'] = $this->uri->segment(3);

        $this->disposal_model->hapus($objectid_1);

        redirect('disposal/');
    }

    public function upload_index()
    {
        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');
        $data['error'] = ' ';

        $this->template->display('webgis/disposal/formshp', $data);
    }


    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';

        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');
        

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('shp') || !$this->upload->do_upload('shx') || !$this->upload->do_upload('dbf')) {
            // if (!$this->upload->do_upload('shp')) {
                $data['error'] = $this->upload->display_errors();

            $this->template->display('webgis/disposal/formshp', $data);
        } else {

            $data['upload_data'] = $this->upload->data();

            $this->template->display('webgis/disposal/shphandler', $data);
        }
    }

    public function insert_db()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('shape'),
        );

        $this->disposal_model->insert($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil ditambahkan ke database. </div>');

        redirect('disposal');
    }
}
