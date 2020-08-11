<?php

class Lokasi2 extends CI_Controller
{
    public function __construct(){
        parent::__construct();
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

    function load_data(){
		// $cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$param = $this->input->post("cari");

			$sql = "";
			$sql .= "SELECT * FROM m_lokasi_pit A0
					 WHERE ID IS NOT NULL";
			if ($param!='') {
				$sql .= " AND A0.LOKASI_PIT LIKE '%$param%'";
			}
			$sql .=" ORDER BY A0.ID";

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('lokasi/load_data',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?php
		}
	}
}
