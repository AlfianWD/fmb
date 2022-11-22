<?php

defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

	public function index()
	{
		$this->load->helpers('url');
		$this->load->view('Login/index');
	}

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('Login_model');
	}

	public function dashboard()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('table_dashboard_admin');
		$this->db->select('*');
		$this->db->from('table_dashboard_admin');
		$query = $this->db->get();
		$data['data_dash'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/dashboard', $data);
		$this->load->view('admin-partials/footer');
	}

	public function pesanan()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('table_pesanan');
		$this->db->select('*');
		$this->db->from('table_pesanan');
		$query = $this->db->get();
		$data['data_pesan'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/pesanan', $data);
		$this->load->view('admin-partials/footer');
	}

	public function produk()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('barang');
		$this->db->select('*');
		$this->db->from('barang');
		$query = $this->db->get();
		$data['produk'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/barang', $data);
		$this->load->view('admin-partials/footer');
	}

	public function tambah_barang() {
		$this->load->helper("url");
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/tambah_barang');
		$this->load->view('admin-partials/footer');
	}

	public function simpan_barang() {

		$this->load->model('data_model');

		$id_barang = $this->input->post('ID_BARANG');
		$nm_barang = $this->input->post('NM_BARANG');
 
		$data = array(
			'ID_BARANG' => $id_barang,
			'NM_Barang' => $nm_barang
			);
		$this->db->insert('barang', $data);

		$_SESSION['simpan'] = "Berhasil";

		redirect('admin/produk');
	}

	public function hapus_produk($id_barang) {
		$this->db->delete('barang',array( 'ID_BARANG'  =>  $id_barang ));
	}

	public function kelola_user()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('user');
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		$data['user'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/kelola-user', $data);
		$this->load->view('admin-partials/footer');
	}

	public function tambah_user() {
		$this->load->helper("url");
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/tambah_user');
		$this->load->view('admin-partials/footer');
	}

	public function simpan_user() {

		$this->load->model('data_model');

		$username = $this->input->post('USERNAME');
		$password = $this->input->post('PASSWORD');
		$nm_user = $this->input->post('NM_USER');
		$akses = $this->input->post('AKSES');
 
		$data = array(
			'USERNAME' => $username,
			'PASSWORD' => $password,
			'NM_USER' => $nm_user,
			'AKSES' => $akses
			);
		$this->db->insert('user', $data);
		
		$_SESSION['simpan'] = "Berhasil";

		redirect('admin/kelola_user');
	}

	public function marketplace()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('marketplace');
		$this->db->select('*');
		$this->db->from('marketplace');
		$query = $this->db->get();
		$data['marketplace'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/marketplace', $data);
		$this->load->view('admin-partials/footer');
	}

	public function tambah_marketplace() {
		$this->load->helper("url");
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/tambah_marketplace');
		$this->load->view('admin-partials/footer');
	}

	public function simpan_marketplace() {

		$this->load->model('data_model');

		$id_marketplace = $this->input->post('ID_MARKET');
		$marketplace = $this->input->post('NM_MARKET');
		$biaya_admin = $this->input->post('ADMIN');
 
		$data = array(
			'ID_MARKET' => $id_marketplace,
			'NM_MARKET' => $marketplace,
			'ADMIN' => $biaya_admin,
			);
		$this->db->insert('marketplace', $data);

		$_SESSION['simpan'] = "Berhasil";

		redirect('admin/marketplace');
	}

	public function warna()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('warna');
		$this->db->select('*');
		$this->db->from('warna');
		$query = $this->db->get();
		$data['warna'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/warna', $data);
		$this->load->view('admin-partials/footer');
	}

	public function tambah_warna() {
		$this->load->helper("url");
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/tambah_warna');
		$this->load->view('admin-partials/footer');
	}

	public function simpan_warna() {

		$this->load->model('data_model');

		$id_warna = $this->input->post('ID_WARNA');
		$warna = $this->input->post('WARNA');
 
		$data = array(
			'ID_WARNA  ' => $id_warna,
			'WARNA' => $warna
			);
		$this->db->insert('warna', $data);

		$_SESSION['simpan'] = "Berhasil";

		redirect('admin/warna');
	}

	public function varian()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('varian');
		$this->db->select('*');
		$this->db->from('varian');
		$query = $this->db->get();
		$data['varian'] = $query->result();
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/varian', $data);
		$this->load->view('admin-partials/footer');
	}

	public function tambah_varian() {
		$this->load->helper("url");
		$this->load->view('admin-partials/header');
		$this->load->view('admin-partials/side-bar');
		$this->load->view('admin-partials/top-bar');
		$this->load->view('admin-partials/tambah_varian');
		$this->load->view('admin-partials/footer');
	}

	public function simpan_varian() {

		$this->load->model('data_model');

		$id_varian = $this->input->post('ID_VARIAN');
		$varian = $this->input->post('VARIAN');
 
		$data = array(
			'ID_VARIAN  ' => $id_varian,
			'VARIAN' => $varian
			);
		$this->db->insert('varian', $data);

		$_SESSION['simpan'] = "Berhasil";

		redirect('admin/varian');
	}

	public function dashboard_produksi()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('table_dashboard_admin');
		$this->db->select('*');
		$this->db->from('table_dashboard_admin');
		$query = $this->db->get();
		$data['data_dash'] = $query->result();
		$this->load->view('produksi-partials/header');
		$this->load->view('produksi-partials/side-bar');
		$this->load->view('produksi-partials/top-bar');
		$this->load->view('produksi-partials/dashboard_produksi', $data);
		$this->load->view('produksi-partials/footer');
	}
	public function pesanan_produksi()
	{
		$this->load->helper("url");
		$this->load->database();
		$query = $this->db->get('table_pesanan');
		$this->db->select('*');
		$this->db->from('table_pesanan');
		$query = $this->db->get();
		$data['data_pesan'] = $query->result();
		$this->load->view('produksi-partials/header');
		$this->load->view('produksi-partials/side-bar');
		$this->load->view('produksi-partials/top-bar');
		$this->load->view('produksi-partials/pesanan', $data);
		$this->load->view('produksi-partials/footer');
	}

	public function packing()
	{
		echo "halaman packing";
	}

	public function login()
	{
		$this->load->model('Login_model');
		$data['login'] = $this->Login_model->login();
		// print_r($data['login']);
		if (count((array)$data['login']) > 0) {
			$this->session->set_userdata('logged_in', $data['login']);
			print_r($data['login']);
			$akses = $data['login']->AKSES;
			switch ($akses) {
				case 'admin':
					redirect('admin/dashboard');
				case 'produksi':
					redirect('admin/dashboard_produksi');
				case 'packing':
					redirect('admin/packing');
					break;
			}
		} else {
			redirect('/'); //gagal
		}
	}
}