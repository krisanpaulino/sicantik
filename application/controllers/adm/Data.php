<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'admin') {

			redirect('auth');
		}
		$this->load->library('form_validation');
		$this->load->model('M_keloladata');
	}

	public function index()
	{
		$data['data'] = $this->M_keloladata->get_all_data();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/index', $data);
		$this->load->view('templates/footer');
	}
	public function apotik()
	{
		$data['elemen_data_apotik'] = $this->M_keloladata->get_elemen_data_apotik();
		$data['judul'] = 'apotik Kab TTU';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_apotik_index', $data);
		$this->load->view('templates/footer');
	}
	public function kategori_elemen_apotik()
	{
		$data['kategori_elemen_data_apotik'] = $this->M_keloladata->get_kategori_elemen_data_apotik();
		$data['judul'] = 'Kategori Elemen Data Apotik';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_apotik_kategori');
		$this->load->view('templates/footer');
	}

	public function store_kategori_elemen_apotik()
	{
		$this->form_validation->set_rules('nama_kategori_apotik', 'Nama Kategori', 'required');

		if ($this->form_validation->run()) {
			$data['nama_kategori'] = $this->input->post('nama_kategori_apotik');
			$this->db->insert('kategori_elemen_data_apotik', $data);
		}
		redirect('adm/data/kategori_elemen_apotik');
	}

	public function tambah_elemen_apotik()
	{
		$id_kategori = $this->input->post('id_kategori');
		$kategori = $this->M_keloladata->get_kategori_elemen_data_apotik($id_kategori);
		$data = [
			'judul' => $kategori['nama_kategori'],
			'id_kategori' => $kategori['id'],
			'jumlah' => $this->input->post('jumlah')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_apotik_input');
		$this->load->view('templates/footer');
	}

	public function store_elemen_data_apotik()
	{
		$input_elemen = $this->input->post('nama_elemen');
		foreach ($input_elemen as  $elemen) {
			$data = [
				'id_kategori_data_apotik' => $this->input->post('id_kategori'),
				'nama_elemen' => $elemen
			];
			$this->db->insert('elemen_data_apotik', $data);
		}
		$this->session->set_flashdata('message', 'Data Elemen berhasil ditambahkan');
		redirect('adm/data/apotik');
	}

	public function input()
	{
		$this->form_validation->set_rules('nama_data', 'Nama', 'required');
		$this->form_validation->set_rules('is_stp', 'STP', 'required');
		$this->form_validation->set_rules('punya_elemen_data', 'Punya Elemen Data', 'required');
		$this->form_validation->set_rules('punya_elemen_usia', 'Punya Elemen Usia', 'required');
		$this->form_validation->set_rules('is_ptm', 'Pertanyaan PTM', 'required');
		if ($this->form_validation->run()) {

			$data = [
				'nama_data' => $this->input->post('nama_data'),
				'is_stp' => $this->input->post('is_stp'),
				'id_induk_penyakit' => $this->input->post('id_induk_penyakit'),
				'punya_elemen_data' => $this->input->post('punya_elemen_data'),
				'punya_elemen_usia' => $this->input->post('punya_elemen_usia'),
				'is_ptm' => $this->input->post('is_ptm'),
				'kategori_data' => $this->input->post('kategori'),
			];
			$this->db->insert('data', $data);
			$id_data = $this->db->insert_id();
			if ($data['is_stp'] == 1) {
				$data_usia = $this->db->get_where('usia', ['stp' => 1])->result_array();
				foreach ($data_usia as $usia) {
					$input = [
						'id_usia' => $usia['id'],
						'id_data' => $id_data
					];
					$this->db->insert('elemen_data_usia', $input);
				}
			}
			if (!empty($this->input->post('id_induk_penyakit'))) {
				$atribut_data = $this->db->get_where('atribut_data', ['id_data' => $this->input->post('id_induk_penyakit')])->result_array();
				foreach ($atribut_data as $atribut) {
					$kondisi = [
						'id_data' => $id_data,
						'id_atribut' => $atribut['id_atribut']
					];
					if (!$this->M_keloladata->check_if_exists('atribut_data', $kondisi)) {
						$this->db->insert('atribut_data', $kondisi);
					}
				}
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');
			redirect('/adm/data/index/penyakit');
		} else {
			redirect('adm/data/index/penyakit');
		}
	}
	public function update()
	{
		$this->form_validation->set_rules('nama_data', 'Nama', 'required');
		$this->form_validation->set_rules('is_stp', 'STP', 'required');
		$this->form_validation->set_rules('punya_elemen_data', 'Punya Elemen Data', 'required');
		$this->form_validation->set_rules('punya_elemen_usia', 'Punya Elemen Usia', 'required');
		$this->form_validation->set_rules('is_ptm', 'Pertanyaan PTM', 'required');
		if ($this->form_validation->run()) {
			$id = $this->input->post('id');
			$data = [
				'nama_data' => $this->input->post('nama_data'),
				'is_stp' => $this->input->post('is_stp'),
				'id_induk_penyakit' => $this->input->post('id_induk_penyakit'),
				'punya_elemen_data' => $this->input->post('punya_elemen_data'),
				'punya_elemen_usia' => $this->input->post('punya_elemen_usia'),
				'is_ptm' => $this->input->post('is_ptm'),
				'kategori_data' => $this->input->post('kategori'),
			];
			$this->db->where('id', $id);
			$this->db->update('data', $data);
			if ($data['is_stp'] == 1) {
				$data_usia = $this->db->get_where('usia', ['stp' => 1])->result_array();
				foreach ($data_usia as $usia) {
					$kondisi = [
						'id_data' => $id,
						'id_usia' => $usia['id']
					];
					if (!$this->M_keloladata->check_if_exists('elemen_data_usia', $kondisi)) {
						$input = [
							'id_usia' => $usia['id'],
							'id_data' => $id
						];
						$this->db->insert('elemen_data_usia', $input);
					}
				}
			}
			if (!empty($this->input->post('id_induk_penyakit'))) {
				$atribut_data = $this->db->get_where('atribut_data', ['id_data' => $this->input->post('id_induk_penyakit')])->result_array();
				foreach ($atribut_data as $atribut) {
					$kondisi = [
						'id_data' => $id,
						'id_atribut' => $atribut['id_atribut']
					];
					if (!$this->M_keloladata->check_if_exists('atribut_data', $kondisi)) {
						$this->db->insert('atribut_data', $kondisi);
					}
				}
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil diubah!</div>');
			redirect('/adm/data/index/penyakit');
		} else {
			redirect('adm/data/index/penyakit');
		}
	}
	public function elemen($id)
	{
		$data['elemen_data'] = $this->M_keloladata->get_elemen_data($id);
		$data['judul'] = 'Elemen Data';
		$data['id'] = $id;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_index', $data);
		$this->load->view('templates/footer');
	}
	public function kategori_elemen($id_data)
	{
		$data['kategori'] = $this->M_keloladata->get_kategori_elemen();
		$data['id_data'] = $id_data;
		$data['judul'] = 'Kategori Elemen Data';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_kategori', $data);
		$this->load->view('templates/footer');
	}

	public function store_kategori()
	{
		$id_data = $this->input->post('id_data');
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[kategori_elemen_data.nama_kategori]');
		if ($this->form_validation->run()) {
			$data = [
				'nama_kategori' => $this->input->post('nama_kategori'),
				'is_deleted' => 0,
			];
			$this->db->insert('kategori_elemen_data', $data);
			redirect('/adm/data/kategori_elemen/' . $id_data);
		}
	}
	public function delete_kategori()
	{
		$id_data = $this->input->post('id_data');
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('kategori_elemen_data');
		redirect('/adm/data/kategori_elemen/' . $id_data);
	}
	public function to_tambah_elemen()
	{
		$id_data = $this->input->post('id_data');
		$id_kategori = $this->input->post('id_kategori');
		$jumlah = $this->input->post('jumlah');
		redirect('/adm/data/tambah_elemen/' . $id_data . '/' . $id_kategori . '/' . $jumlah);
	}
	public function tambah_elemen()
	{
		$data = [
			'id_data' => $this->input->post('id_data'),
			'id_kategori' => $this->input->post('id_kategori'),
			'jumlah' => $this->input->post('jumlah'),
			'judul' => 'Tambah Elemen Data'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_input', $data);
		$this->load->view('templates/footer');
	}
	public function store_elemen_data()
	{
		$elemen = $this->input->post('nama_elemen');
		foreach ($elemen as $el) {
			$data = [
				'id_data' => $this->input->post('id_data'),
				'id_kategori_elemen_data' => $this->input->post('id_kategori'),
				'nama_elemen_data' => $el
			];
			$this->db->insert('elemen_data', $data);
		}
		redirect('/adm/data/elemen/' . $this->input->post('id_data'));
	}
	public function delete_elemen_data()
	{
		$id_data = $this->input->post('id_data');
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('elemen_data');
		redirect('/adm/data/elemen/' . $id_data);
	}
	public function usia()
	{
		$data['judul'] = 'Input Rentang Usia';
		$data['data_usia'] = $this->M_keloladata->get_usia();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/usia_index', $data);
		$this->load->view('templates/footer');
	}
	public function store_usia()
	{
		$this->form_validation->set_rules('rentang_usia', 'Rentang Usia', 'required');
		if ($this->form_validation->run()) {
			$data['rentang_usia'] = $this->input->post('rentang_usia');
			$this->db->insert('usia', $data);
			$this->session->set_flashdata('Data usia berhasil ditambahkan');
			redirect('/adm/data/usia');
		} else {
			$this->session->set_flashdata('Gagal!');
			redirect('admin/data/usia');
		}
	}

	public function update_usia()
	{
		$id = $this->input->post('id');
		$data['rentang_usia'] = $this->input->post('rentang_usia');
		$this->db->where('id', $id);
		$this->db->update('usia', $data);
		redirect('/adm/data/usia');
	}
	public function delete_usia()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('usia');
		redirect('/adm/data/usia');
	}
	public function elemen_usia($id_data)
	{
		$data['elemen_usia'] = $this->M_keloladata->get_elemen_usia($id_data);
		$data['id_data'] = $id_data;
		$data['usia_lain'] = $this->M_keloladata->get_not_elemen_usia($id_data);
		$data['judul'] = 'Elemen Data Usia';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/elemen_data_usia_index', $data);
		$this->load->view('templates/footer');
	}

	public function store_elemen_usia()
	{
		$id_data = $this->input->post('id_data');
		$data_usia = $this->input->post('id_usia');
		foreach ($data_usia as $usia) {
			$data['id_data'] = $id_data;
			$data['id_usia'] = $usia;
			$data['is_deleted'] = 0;
			$this->db->insert('elemen_data_usia', $data);
		}
		redirect('adm/data/elemen_usia/' . $id_data);
	}
	public function delete_elemen_usia()
	{
		$id_data = $this->input->post('data');
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('elemen_data_usia');
	}
	public function atribut($id_data)
	{
		$detail_data = $this->M_keloladata->get_single_data($id_data);
		$data = [
			'judul' => 'Atribut Data ' . $detail_data['nama_data'],
			'atribut_data' => $this->M_keloladata->get_atribut_data($id_data),
			'id_data' => $id_data,
			'atribut_lain' => $this->M_keloladata->get_not_atribut_data($id_data)
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/atribut_data_index', $data);
		$this->load->view('templates/footer');
	}
	public function store_atribut()
	{
		$id_data = $this->input->post('id_data');

		$data['nama_atribut'] = $this->input->post('nama_atribut');
		$this->db->insert('atribut', $data);
		redirect('/adm/data/atribut/' . $id_data);
	}
	public function store_atribut_elemen()
	{
		$id_data = $this->input->post('id_data');
		$atribut_elemen_data  = $this->input->post('id_atribut');
		foreach ($atribut_elemen_data as $atribut) {
			$data = [
				'id_data' => $id_data,
				'id_atribut' => $atribut,
				'is_deleted' => 0
			];
			$this->db->insert('atribut_data', $data);
		}
		redirect('/adm/data/atribut/' . $id_data);
	}
	public function pilih_laporan()
	{
		$data['list_data'] = $this->M_keloladata->get_data();
		$data['judul'] = 'Laporan Data Umum';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/pilih_laporan');
		$this->load->view('templates/footer');
	}
	public function laporan_data($id_data, $id_sesi = null)
	{
		if ($id_sesi != null) {
			$info_data = $this->M_keloladata->get_data($id_data);
			$atribut_data = $this->M_keloladata->get_atribut_data($id_data);
			$kategori_data = $this->M_keloladata->get_detail_elemen_data($id_data, $id_sesi);
			$sesi = $this->M_keloladata->get_sesi($id_sesi);
			$detail_turunan = $this->M_keloladata->get_detail_turunan($id_data, $id_sesi);
			if ($detail_turunan == null) {
				$detail_turunan = [];
			}
			$data = [
				'atribut_data' => $atribut_data,
				'kategori_data' => $kategori_data,
				'data_puskesmas' => $this->db->get('puskesmas')->result_array(),
				'detail_turunan' => $detail_turunan,
				'judul' => 'Laporan Rekapitulasi ' . $info_data['nama_data'] . ' Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
				'sesi' => $sesi,
				'info_data' => $info_data
			];
			// $data['judul'] = 'Data ' . $info_data['nama_data'];
			// var_dump($detail_turunan);
			// die();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/laporan_data');
			$this->load->view('templates/footer');
		} else {
			$data['list_data'] = $this->M_keloladata->get_sesi();
			$data['profil'] = $this->session->userdata('profil');
			// return var_dump($id_puskesmas);
			$data['info_data'] = $this->M_keloladata->get_data($id_data);
			$data['judul'] = ' Pilih Sesi Laporan Data ' . $data['info_data']['nama_data'];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin', $data);
			$this->load->view('data/pilih_sesi_laporan', $data);
			$this->load->view('templates/footer');
		}
	}
	public function laporan_data_excel($id_data, $id_sesi)
	{
		$info_data = $this->M_keloladata->get_data($id_data);
		$atribut_data = $this->M_keloladata->get_atribut_data($id_data);
		$kategori_data = $this->M_keloladata->get_detail_elemen_data($id_data, $id_sesi);
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$detail_turunan = $this->M_keloladata->get_detail_turunan($id_data, $id_sesi);
		$data = [
			'atribut_data' => $atribut_data,
			'kategori_data' => $kategori_data,
			'data_puskesmas' => $this->db->get('puskesmas')->result_array(),
			'detail_turunan' => $detail_turunan,
			'judul' => 'Laporan Rekapitulasi ' . $info_data['nama_data'] . ' Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'info_data' => $info_data
		];
		// $data['judul'] = 'Data ' . $info_data['nama_data'];
		// var_dump($detail_turunan);
		// die();
		$this->load->view('data/laporan_data_excel', $data);
	}
	public function laporan_data_apotik($id_sesi)
	{
		$data_obat = $this->M_keloladata->get_detail_data_obat($id_sesi);
		$kategori_data = $this->M_keloladata->get_detail_elemen_data_apotik($id_sesi);
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'kategori_data' => $kategori_data,
			'data_puskesmas' => $this->db->get('puskesmas')->result_array(),
			'data_obat' => $data_obat,
			'sesi' => $sesi
		];
		$data['judul'] = 'Data Apotik ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/laporan_data_apotik');
		$this->load->view('templates/footer');
	}
	public function laporan_data_apotik_excel($id_sesi)
	{
		$data_obat = $this->M_keloladata->get_detail_data_obat($id_sesi);
		$kategori_data = $this->M_keloladata->get_detail_elemen_data_apotik($id_sesi);
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'kategori_data' => $kategori_data,
			'data_puskesmas' => $this->db->get('puskesmas')->result_array(),
			'data_obat' => $data_obat,
			'sesi' => $sesi
		];
		$data['judul'] = 'Data Apotik ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'];
		$this->load->view('data/laporan_data_apotik_excel', $data);
	}
	public function data_obat()
	{
		$data = [
			'sesi' => $this->db->get('sesi')->result_array(),
			'judul' => 'Data Obat'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/data_obat_index');
		$this->load->view('templates/footer');
	}
	public function data_apotik()
	{
		$data = [
			'data_sesi' => $this->M_keloladata->get_sesi(),
			'judul' => 'Laporan Data Apotik Puskesmas'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/data_apotik_index');
		$this->load->view('templates/footer');
	}
	public function laporan_data_obat($id_sesi)
	{
		$data_obat = $this->M_keloladata->get_detail_data_obat($id_sesi);
		$data = [
			'data_obat' => $data_obat,
			'data_puskesmas' => $this->db->get('puskesmas')->result_array(),
		];
		$data['judul'] = 'Data Obat';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/laporan_data_obat');
		$this->load->view('templates/footer');
	}

	public function stp()
	{
		$data_sesi = $this->M_keloladata->get_sesi();
		$data = [
			'judul' => 'Data Laporan STP',
			'data_sesi' => $data_sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/stp_index');
		$this->load->view('templates/footer');
	}
	public function laporan_stp($id_sesi, $id_puskesmas = null)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		if ($id_puskesmas == null) {
			$data_puskesmas = $this->db->get('puskesmas')->result_array();
			$data = [
				'data_puskesmas' => $data_puskesmas,
				'judul' => 'Laporan STP ',
				'sesi' => $sesi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/stp_pilih_puskesmas');
			$this->load->view('templates/footer');
		} else {
			$usia_stp = $this->db->get_where('usia', ['stp' => 1])->result_array();
			$data = [
				'judul' => 'Laporan STP Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
				'sesi' => $sesi,
				'usia_stp' => $usia_stp,
				// 'profil' => $this->session->userdata('profil'),
				'data_stp' => $this->M_keloladata->get_laporan_stp($id_sesi, $id_puskesmas),
				'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array()
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/laporan_stp');
			$this->load->view('templates/footer');
		}
	}
	public function laporan_stp_excel($id_sesi, $id_puskesmas)
	{
		$usia_stp = $this->db->get_where('usia', ['stp' => 1])->result_array();
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan STP Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'usia_stp' => $usia_stp,
			// 'profil' => $this->session->userdata('profil'),
			'data_stp' => $this->M_keloladata->get_laporan_stp($id_sesi, $id_puskesmas),
			'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array()
		];
		$this->load->view('data/laporan_stp_excel', $data);
	}

	public function ptm($id_sesi = null)
	{
		$data = [
			'data_ptm' => $this->M_keloladata->get_sesi(),
			'judul' => 'Laporan Penyakit Tidak Menular'
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/ptm_index');
		$this->load->view('templates/footer');
	}
	public function laporan_ptm($id_sesi, $id_puskesmas = null)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		if ($id_puskesmas != null) {
			// $laporan_ptm = $this->M_keloladata->get_laporan_ptm($id_sesi);
			$data = [
				'data_ptm' => $this->M_keloladata->get_laporan_ptm($id_sesi, $id_puskesmas),
				'sesi' => $sesi,
				'profil' => $this->session->userdata('profil'),
				'judul' => 'Laporan Penyakit tidak Menular ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
				'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array(),
				'usia_ptm' => $this->db->get('usia_ptm')->result_array()
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/laporan_ptm');
			$this->load->view('templates/footer');
		} else {
			$data_puskesmas = $this->db->get('puskesmas')->result_array();
			$data = [
				'data_puskesmas' => $data_puskesmas,
				'judul' => 'Laporan PTM ',
				'sesi' => $sesi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/ptm_pilih_puskesmas');
			$this->load->view('templates/footer');
		}
	}
	public function laporan_ptm_excel($id_sesi, $id_puskesmas)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);

		$data = [
			'data_ptm' => $this->M_keloladata->get_laporan_ptm($id_sesi, $id_puskesmas),
			'sesi' => $sesi,
			'judul' => 'Laporan Penyakit tidak Menular ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array(),
			'usia_ptm' => $this->db->get('usia_ptm')->result_array()
		];
		$this->load->view('data/laporan_ptm_excel', $data);
	}

	//sarana
	public function sarana()
	{
		$data_sarana = $this->M_keloladata->get_sarana();
		$data = [
			'data_sarana' => $data_sarana,
			'jenis_sarana' => $this->db->get('jenis_sarana')->result_array(),
			'judul' => 'Data Sarana',
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/sarana_index');
		$this->load->view('templates/footer');
	}
	public function store_sarana()
	{
		$this->form_validation->set_rules('id_jenis_sarana', 'Jenis Sarana', 'required');
		$this->form_validation->set_rules('nama_sarana', 'Nama Sarana', 'required');

		if ($this->form_validation->run()) {
			$data = [
				'id_jenis_sarana' => $this->input->post('id_jenis_sarana'),
				'nama_sarana' => $this->input->post('nama_sarana')
			];
			$this->db->insert('sarana', $data);
			$this->session->set_flashdata('message', 'Sarana Baru Berhasil ditambahkan!');
			redirect('/adm/data/sarana');
		} else {
			redirect('/adm/data/sarana');
		}
	}
	public function update_sarana()
	{
		$this->form_validation->set_rules('id_jenis_sarana', 'Jenis Sarana', 'required');
		$this->form_validation->set_rules('nama_sarana', 'Nama Sarana', 'required');

		if ($this->form_validation->run()) {
			$id = $this->input->post('id');
			$data = [
				'id_jenis_sarana' => $this->input->post('id_jenis_sarana'),
				'nama_sarana' => $this->input->post('nama_sarana')
			];
			$this->db->where('id', $id);
			$this->db->update('sarana', $data);
			$this->session->set_flashdata('message', 'Data Sarana berhasil diubah');
			redirect('/adm/data/sarana');
		} else {
			redirect('/adm/data/sarana');
		}
	}
	public function hapus_sarana()
	{

		$id = $this->input->post('id');
		$data = [
			'is_deleted' => 1
		];
		$this->db->where('id', $id);
		$this->db->update('sarana', $data);
		$this->session->set_flashdata('message', 'Sarana berhasil dihapus!');
		redirect('/adm/data/sarana');
	}
	public function data_inspeksi()
	{
		$data_sesi = $this->M_keloladata->get_sesi();
		$data = [
			'judul' => 'Data Laporan Inspeksi',
			'data_sesi' => $data_sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/inspeksi_index');
		$this->load->view('templates/footer');
	}
	public function laporan_data_inspeksi($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$inspeksi_sarana = $this->M_keloladata->get_detail_inspeksi($id_sesi);
		$data = [
			'judul' => 'Laporan Rekapitulasi Inspeksi TTU dab TPM Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'inspeksi_sarana' => $inspeksi_sarana,
			'data_puskesmas' => $this->db->get('puskesmas')->result_array(),
			'sesi' => $sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/laporan_inspeksi');
		$this->load->view('templates/footer');
	}
	public function laporan_data_inspeksi_excel($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$inspeksi_sarana = $this->M_keloladata->get_detail_inspeksi($id_sesi);
		$data = [
			'judul' => 'Laporan Rekapitulasi Inspeksi TTU dab TPM Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'inspeksi_sarana' => $inspeksi_sarana,
			'data_puskesmas' => $this->db->get('puskesmas')->result_array()
		];
		$this->load->view('data/laporan_inspeksi_excel', $data);
	}

	//DBD FILCA
	public function dbdfilca()
	{
		$data = [
			'judul' => 'Data DBD FILCA',
			'data_dbdfilca' => $this->M_keloladata->get_index_dbdfilca(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/dbdfilca_index');
		$this->load->view('templates/footer');
	}
	public function laporan_dbdfilca($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		//$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data_dbdfilca = $this->M_keloladata->get_laporan_dbdfilca($id_sesi);
		$data = [
			'judul' => 'Laporan DBD FILCA Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'data_dbdfilca' => $data_dbdfilca,
			'dbdfilca' => $this->M_keloladata->get_laporan_dbdfilca($id_sesi),
			'usia_dbdfilca' => $this->db->get('usia_dbd_filca')->result_array(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/laporan_dbdfilca');
		$this->load->view('templates/footer');
	}
	public function laporan_data_dbdfilca_excel($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		//$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data_dbdfilca = $this->M_keloladata->get_laporan_dbdfilca($id_sesi);
		$data = [
			'judul' => 'Laporan DBD FILCA Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'data_dbdfilca' => $data_dbdfilca,
			'dbdfilca' => $this->M_keloladata->get_laporan_dbdfilca($id_sesi),
			'usia_dbdfilca' => $this->db->get('usia_dbd_filca')->result_array(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('adm/data/laporan_dbdfilca_excel', $data);
	}

	//PKP
	public function pkp()
	{
		$data_pkp = $this->M_keloladata->get_data_pkp();
		$data_sesi = $this->M_keloladata->get_sesi();
		$data = [
			'judul' => 'Data Laporan PKP',
			'data_pkp' => $data_pkp,
			'data_sesi' => $data_sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/pkp_index');
		$this->load->view('templates/footer');
	}
	public function to_inputpkp()
	{
		$id_sesi = $this->input->post('sesi');
		redirect('adm/data/input_pkp/' . $id_sesi);
	}

	public function input_pkp($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Input Target Capaian & Jumlah Capaian PKP Bulan' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'jenis_kegiatan' => $this->M_keloladata->get_jenis_kegiatan(),
			'sesi' => $sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/pkp_input');
		$this->load->view('templates/footer');
	}
	public function store_pkp()
	{
		$id_kegiatan = $this->input->post('id_kegiatan');
		foreach ($id_kegiatan as $kegiatan) {
			$kondisi = [
				'id_sesi' => $this->input->post('id_sesi'),
				'id_kegiatan' => $kegiatan
			];
			if ($this->M_keloladata->check_if_exists('pkp', $kondisi)) {
				$this->db->where($kondisi);
				$this->db->update('pkp', [
					'target_capaian' => $this->input->post('target_capaian_' . $kegiatan),
					'jumlah_sasaran' => $this->input->post('jumlah_sasaran_' . $kegiatan)
				]);
			} else {
				$data = [
					'id_sesi' => $this->input->post('id_sesi'),
					'id_kegiatan' => $kegiatan,
					'target_capaian' => $this->input->post('target_capaian_' . $kegiatan),
					'jumlah_sasaran' => $this->input->post('jumlah_sasaran_' . $kegiatan)
				];
				$this->db->insert('pkp', $data);
			}
		}
		redirect('adm/data/pkp');
	}
	public function laporan_pkp($id_sesi, $id_puskesmas = null)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		if ($id_puskesmas == null) {
			$data = [
				'data_puskesmas' => $this->db->get_where('puskesmas', ['is_deleted' => 0])->result_array(),
				'judul' => 'Laporan PKP Bulan ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
				'sesi' => $sesi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/pkp_pilih_puskesmas');
			$this->load->view('templates/footer');
		} else {
			$data = [
				'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array(),
				'judul' => 'Laporan PKP Bulan ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
				'jenis_kegiatan' => $this->M_keloladata->get_detail_pkp($id_sesi, $id_puskesmas),
				'sesi' => $sesi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/laporan_pkp');
			$this->load->view('templates/footer');
		}
	}
	public function laporan_pkp_gabungan($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan PKP Bulan ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'data_puskesmas' => $this->db->get_where('puskesmas', ['is_deleted' => 0])->result_array(),
			'jenis_kegiatan' => $this->M_keloladata->get_detail_pkp($id_sesi),
			'sesi' => $sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/laporan_pkp_gabungan');
		$this->load->view('templates/footer');
	}
	public function laporan_pkp_gabungan_excel($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan PKP Bulan ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'data_puskesmas' => $this->db->get_where('puskesmas', ['is_deleted' => 0])->result_array(),
			'jenis_kegiatan' => $this->M_keloladata->get_detail_pkp($id_sesi),
			'sesi' => $sesi
		];
		$this->load->view('data/laporan_pkp_gabungan_excel', $data);
	}
	public function laporan_pkp_excel($id_sesi, $id_puskesmas)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);

		$data = [
			'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array(),
			'judul' => 'Laporan PKP Bulan ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'jenis_kegiatan' => $this->M_keloladata->get_detail_pkp($id_sesi, $id_puskesmas)
		];
		$this->load->view('data/laporan_pkp_excel', $data);
	}
	public function tbprogram()
	{
		$data_sesi = $this->M_keloladata->get_sesi();
		$data = [
			'data_sesi' => $data_sesi,
			'judul' => 'Data TB Program'
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('data/tbprogram_index');
		$this->load->view('templates/footer');
	}
	public function laporan_tbprogram($id_sesi, $id_puskesmas = null)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		if ($id_puskesmas == null) {
			$data_puskesmas = $this->db->get('puskesmas')->result_array();
			$data = [
				'data_puskesmas' => $data_puskesmas,
				'judul' => 'Laporan TB Program Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
				'sesi' => $sesi
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/tbprogram_pilih_puskesmas');
			$this->load->view('templates/footer');
		} else {
			$data = [
				'judul' => 'Laporan TB Program',
				'sesi' => $sesi,
				// 'profil' => $this->session->userdata('profil'),
				'data_tbprogram' => $this->M_keloladata->get_laporan_tbprogram($id_sesi, $id_puskesmas),
				'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array()
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('data/laporan_tbprogram');
			$this->load->view('templates/footer');
		}
	}
	public function laporan_tbprogram_excel($id_sesi, $id_puskesmas)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);

		$data = [
			'judul' => 'Laporan TB Program',
			'sesi' => $sesi,
			// 'profil' => $this->session->userdata('profil'),
			'data_tbprogram' => $this->M_keloladata->get_laporan_tbprogram($id_sesi, $id_puskesmas),
			'puskesmas' => $this->db->get_where('puskesmas', ['id' => $id_puskesmas])->row_array()
		];
		$this->load->view('data/laporan_tbprogram_excel', $data);
	}
}
