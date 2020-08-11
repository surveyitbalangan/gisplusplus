<?php

class fasilitas_penunjang extends CI_Controller
{

    public function __construct()
    {
        // $this->load->database('fasilitas_penunjang_all');
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->model('fasilitas_penunjang_model');
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
        $data['data_fasilitas_penunjang'] = $this->fasilitas_penunjang_model->get_all();


        $this->template->display('webgis/fasilitas_penunjang/index', $data);
    }

    public function tambah_data()
    {
        $data['title'] = 'Tambah Data';

        $this->load->view('webgis/fasilitas_penunjang/tambahdata', $data);
    }

    public function simpan()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'land_use' => $this->input->post('land_use'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('st_astext(shape)'),
        );

        $this->fasilitas_penunjang_model->simpan($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('fasilitas_penunjang');
    }

    public function edit($objectid)
    {
        $objectid = $this->uri->segment(3);

        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');

        $data['title']   = 'Edit Data fasilitas_penunjang';
        $data['data_fasilitas_penunjang']   = $this->fasilitas_penunjang_model->edit($objectid);


        $this->template->display('webgis/fasilitas_penunjang/editdata', $data);
    }

    public function update()
    {

        //correction is here

        $id['objectid'] = $this->input->post('objectid');

        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'land_use' => $this->input->post('land_use'),
            'shape' => $this->input->post('shape'),
        );

        $this->fasilitas_penunjang_model->update($data, $id);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('fasilitas_penunjang');
    }

    public function hapus($objectid)
    {
        $id['objectid'] = $this->uri->segment(3);

        $this->fasilitas_penunjang_model->hapus($objectid);

        redirect('fasilitas_penunjang/');
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

        $this->template->display('webgis/fasilitas_penunjang/formshp', $data);
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

            $this->template->display('webgis/fasilitas_penunjang/formshp', $data);
        } else {

            $data['upload_data'] = $this->upload->data();

            $this->template->display('webgis/fasilitas_penunjang/shphandler', $data);
        }
    }

    public function insert_db()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('shape'),
        );

        $this->fasilitas_penunjang_model->insert($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil ditambahkan ke database. </div>');

        redirect('fasilitas_penunjang');
    }
}
