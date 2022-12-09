<?php

defined('BASEPATH') or exit('No direct script access allowed');

class packing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('data_model');
    }

    public function dashboard()
    {
        $this->load->helper("url");
		$this->load->database();
		$data['data_dash'] = $this->data_model->tabel_dashboard();

        // Jumlah yang telah packing
		$this->db->select("ID_PESAN");
		$this->db->from("detail_pesanan");
		$this->db->where('PACKING_STATUS', 'Selesai');
		$query=$this->db->get();
		$data['packing_status'] = $query->num_rows();

        // Jumlah yang belom diproduksi
		$this->db->select("ID_PESAN");
		$this->db->from("detail_pesanan");
        $this->db->where('PACKING_STATUS', 'Belom');
		$query=$this->db->get();
		$data['packing_not_ready'] = $query->num_rows();


        $this->load->view('packing-partials/header');
        $this->load->view('packing-partials/side-bar');
        $this->load->view('packing-partials/top-bar');
        $this->load->view('packing-partials/dashboard_packing', $data);
        $this->load->view('packing-partials/footer');
    }

    public function pesanan_packing()
    {
        $this->load->helper("url");
        $this->load->database();
        $query = $this->db->get('table_pesanan');
        $this->db->select('*');
        $this->db->from('table_pesanan');
        $query = $this->db->get();
        $data['data_pesan'] = $query->result();
        $this->load->view('packing-partials/header');
        $this->load->view('packing-partials/side-bar');
        $this->load->view('packing-partials/top-bar');
        $this->load->view('packing-partials/pesanan', $data);
        $this->load->view('packing-partials/footer');
    }

    public function detail_pesanann()
	{
		$this->load->helper("form", "url");
		$this->load->database();

		$this->load->model('Packing_model', 'packing');

        //Pagination
        $this->load->library('pagination');

		// ambil data viewer
		if ($this->input->post('submit')) {
			$data['id'] = $this->input->post('id');
			$this->session->set_userdata('id', $data['id']);
		} else {
            $_SESSION['not_found'] = "";
        }

		$data['id'] = $this->session->userdata('id');

        $this->db->like('ID_PESAN',  $data['id']);
        $this->db->from('table_pesanan');
        //config
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;

        //initialize
		$this->pagination->initialize($config);


		$data['start'] = $this->uri->segment(3);
		$data['pesanan'] = $this->packing->getPesanan($config['per_page'], $data['start'],  $data['id']);

		$this->load->view('packing-partials/header');
		$this->load->view('packing-partials/side-bar');
		$this->load->view('packing-partials/top-bar');
		$this->load->view('packing-partials/detail_pesanann', $data);
		$this->load->view('packing-partials/footer');
	}

    public function detail_pesanan($id_pesan)
    {

        $this->load->helper("form", "url");
		$this->load->database();

        $where = array('ID_PESAN' => $id_pesan);
        $data['pesanan'] = $this->data_model->getPesanan($where, 'table_pesanan')->result();

        $this->load->view('packing-partials/header');
        $this->load->view('packing-partials/side-bar');
        $this->load->view('packing-partials/top-bar');
        $this->load->view('packing-partials/detail_pesanan', $data);
        $this->load->view('packing-partials/footer');
    }
}