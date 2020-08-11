<?php
class Disposaledit extends CI_Controller
{

    public function __construct()
    {
        // $this->load->database('pit_all');
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->model('model_disposal');
    }

    public function index()
    {
        $data = array(
            'title' => 'Data Disposal',
            'data_pit' => $this->model_disposal->get_all()
        );

        $this->load->view('webgis/index_disposal', $data);
    }

    public function tambah_pit()
    {
        $data['title'] = 'Tambah Data';

        $this->load->view('webgis/tambahdisposal', $data);
    }

    public function simpan()
    {
        $data = array(
            'date' => $this->input->post('date'),
            'company' => $this->input->post('company'),
            'shape' => $this->input->post('st_astext(shape)'),
        );

        $this->model_disposal->simpan($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('disposaledit');
    }

    public function edit($objectid_1)
    {
        $objectid_1 = $this->uri->segment(3);

        $data = array(

            'title' => 'Edit Data Disposal',
            'data_pit' => $this->model_disposal->edit($objectid_1)

        );

        $this->load->view('webgis/disposaledit', $data);
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

        $this->model_disposal->update($data, $id);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');

        redirect('disposaledit');
    }

    public function hapus($objectid_1)
    {
        $id['objectid_1'] = $this->uri->segment(3);

        $this->model_disposal->hapus($objectid_1);

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

        $this->model_disposal->insert($data);

        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil ditambahkan ke database. </div>');

        redirect('disposaledit');
    }
}
