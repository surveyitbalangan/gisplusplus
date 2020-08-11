<?php
class Pitedit extends CI_Controller
{

    public function __construct()
    {
        // $this->load->database('pit_all');
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->model('pit_model');
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
        $data['data_pit'] = $this->pit_model->get_all();


        $this->template->display('webgis/pit/index', $data);
    }

    public function tambah_pit()
    {
        $data['title'] = 'Tambah Data';

        $this->load->view('webgis/tambahpit', $data);
    }

    public function simpan()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('st_astext(shape)'),
        );

        $this->pit_model->simpan($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('pitedit');
    }

    public function edit($objectid_1)
    {
        $objectid_1 = $this->uri->segment(4);

        $data['judul']        = $this->config->item('lisensi_app');
        $data['perusahaan'] = $this->config->item('nama_perusahaan');
        $data['deskripsi'] = $this->config->item('app_fullname');
        $data['footer']     = $this->config->item('copyright');
        $data['app_name']     = $this->config->item('app_name');
        $data['level']     = $this->session->userdata('level');
        $data['nik']         = $this->session->userdata('nik_intranet');
        $data['nama']         = $this->session->userdata('nama_intranet');
        $data['jabatan']   = $this->session->userdata('nama_jabatan_intranet');
        
        $data['title']   = 'Edit Data PIT';
        $data['data_pit']   = $this->pit_model->edit($objectid_1);
        

        $this->template->display('webgis/editpit', $data);
    }

    public function update()
    {

        //correction is here

        $id['objectid_1'] = $this->input->post('objectid_1');

        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('shape'),
        );

        $this->pit_model->update($data, $id);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('disposaledit');
    }

    public function hapus($objectid_1)
    {
        $id['objectid_1'] = $this->uri->segment(3);

        $this->pit_model->hapus($objectid_1);

        redirect('disposaledit/');
    }

    public function upload_index()
    {
            $this->load->view('webgis/formshp', array('error' => ' ' ));
    }
  

    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('shp') || !$this->upload->do_upload('shx') || !$this->upload->do_upload('dbf')) {
        // if (!$this->upload->do_upload('shp')) {
           
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('webgis/formshp', $error);

        } else {

            $data = array('upload_data' => $this->upload->data());

            $this->load->view('webgis/shphandler', $data);
        }
    }

    public function insert_db()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('shape'),
        );

        $this->pit_model->insert($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil ditambahkan ke database. </div>');

        redirect('ShpCrud');
    }
}
