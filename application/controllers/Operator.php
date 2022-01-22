<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();

		if ($this->session->userdata('role') != 'operator') {

			redirect('auth');
		}
		$this->load->library('form_validation');
		$this->load->model('M_keloladata');
		$this->load->model('M_obat');
	}

	public function index()
	{
		$data['judul'] = 'Halaman Home';
		$data['list_data'] = $this->M_keloladata->get_data();
		$data['profil'] = $this->session->userdata('profil');

		// var_dump($data['profil']);
		// die();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/dashboard');
		$this->load->view('templates/footer');
	}
	public function data($id_data)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data['list_data'] = $this->M_keloladata->get_data($id_data, $id_puskesmas);
		$data['sesi'] = $this->M_keloladata->get_sesi(null, 1);
		$data['profil'] = $this->session->userdata('profil');
		// return var_dump($id_puskesmas);
		$data['info_data'] = $this->M_keloladata->get_data($id_data);
		$data['judul'] = 'Data ' . $data['info_data']['nama_data'];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/data_index', $data);
		$this->load->view('templates/footer');
	}

	public function to_inputdata()
	{
		$id_data = $this->input->post('id_data');
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata/' . $id_data . '/' . $sesi);
	}

	public function to_inputdata_obat()
	{
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata_obat/' . $sesi);
	}
	public function inputdata($id_data, $sesi)
	{

		$data['judul'] = 'Input Data';
		$data['id_data'] = $id_data;
		$data['sesi'] = $this->M_keloladata->get_sesi($sesi);
		$data['profil'] = $this->session->userdata('profil');
		$data['kategori_data'] = $this->M_keloladata->get_form_elemen($id_data);
		$data['elemen_usia'] = $this->M_keloladata->get_elemen_usia($id_data);
		$data['atribut_data'] = $this->M_keloladata->get_atribut_data($id_data);
		$data['data_turunan'] = $this->M_keloladata->get_form_data_turunan($id_data);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata', $data);
		$this->load->view('templates/footer');
	}
	public function store_data()
	{
		$id_data = $this->input->post('id_data');
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$elemen_data = $this->input->post('id_elemen_data');
		$elemen_data_usia = $this->input->post('id_elemen_data_usia');
		$data_turunan = $this->input->post('id_turunan');
		$sesi = $this->input->post('id_sesi');
		foreach ($elemen_data as $elemen) {
			$atribut_data = $this->input->post('id_atribut_' . $elemen);
			foreach ($atribut_data as $atribut) {
				$jumlah = $this->input->post('jumlah_' . $elemen . $atribut);
				$data = [
					'id_atribut_data' => $atribut,
					'id_elemen_data' => $elemen,
					'id_puskesmas' => $id_puskesmas,
					'id_sesi' => $sesi
				];
				if ($this->M_keloladata->check_if_exists('detail_elemen_data', $data)) {
					$this->db->where($data);
					$this->db->update('detail_elemen_data', ['jumlah' => $jumlah]);
				} else {
					$data['jumlah'] = $jumlah;
					$this->db->insert('detail_elemen_data', $data);
				}
			}
		}

		foreach ($elemen_data_usia as $elemen) {
			$atribut_data = $this->input->post('id_atribut_usia_' . $elemen);
			foreach ($atribut_data as $atribut) {
				$jumlah = $this->input->post('jumlah_usia_' . $elemen . $atribut);
				$data = [
					'id_atribut_data' => $atribut,
					'id_elemen_data_usia' => $elemen,
					'id_puskesmas' => $id_puskesmas,
					'id_sesi' => $sesi
				];
				if ($this->M_keloladata->check_if_exists('detail_elemen_data_usia', $data)) {
					$this->db->where($data);
					$this->db->update('detail_elemen_data_usia', ['jumlah' => $jumlah]);
				} else {
					$data['jumlah'] = $jumlah;
					$this->db->insert('detail_elemen_data_usia', $data);
				}
			}
		}
		foreach ($data_turunan as $turunan) {
			$elemen_usia = $this->input->post('turunan_id_elemen_data_usia_' . $turunan);
			$elemen_data = $this->input->post('turunan_id_elemen_data');
			foreach ($elemen_usia as $usia) {
				$atribut_usia = $this->input->post('turunan_id_atribut_usia_' . $turunan . '_' . $usia);
				foreach ($atribut_usia as $atribut) {
					$jumlah = $this->input->post('turunan_jumlah_usia_' . $turunan . '_' . $usia . '_' . $atribut);
					$data = [
						'id_atribut_data' => $atribut,
						'id_elemen_data_usia' => $usia,
						'id_puskesmas' => $id_puskesmas,
						'id_sesi' => $sesi
					];
					if ($this->M_keloladata->check_if_exists('detail_elemen_data_usia', $data)) {
						$this->db->where($data);
						$this->db->update('detail_elemen_data_usia', ['jumlah' => $jumlah]);
					} else {
						$data['jumlah'] = $jumlah;
						$this->db->insert('detail_elemen_data_usia', $data);
					}
				}
			}
			foreach ($elemen_data as $elemen) {
				$atribut_data = $this->input->post('turunan_id_atribut_' . $elemen);
				foreach ($atribut_data as $atribut) {
					$jumlah = $this->input->post('turunan_jumlah_' . $elemen . $atribut);
					$data = [
						'id_atribut_data' => $atribut,
						'id_elemen_data' => $elemen,
						'id_puskesmas' => $id_puskesmas,
						'id_sesi' => $sesi
					];
					if ($this->M_keloladata->check_if_exists('detail_elemen_data', $data)) {
						$this->db->where($data);
						$this->db->update('detail_elemen_data', ['jumlah' => $jumlah]);
					} else {
						$data['jumlah'] = $jumlah;
						$this->db->insert('detail_elemen_data', $data);
					}
				}
			}
		}
		redirect('/operator/data/' . $id_data);
	}
	public function to_inputdata_apotik()
	{
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata_apotik/' . $sesi);
	}
	public function data_apotik()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data['list_data'] = $this->M_keloladata->get_data_apotik($id_puskesmas);
		$data['sesi'] = $this->M_keloladata->get_sesi(null, 1);
		$data['profil'] = $this->session->userdata('profil');
		// return var_dump($id_puskesmas);
		$data['judul'] = 'Data Apotik';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/data_apotik_index', $data);
		$this->load->view('templates/footer');
	}
	public function store_data_apotik()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$elemen_data = $this->input->post('id_elemen_data');
		foreach ($elemen_data as $elemen) {
			$data = [
				'id_puskesmas' => $id_puskesmas,
				'id_sesi' => $this->input->post('id_sesi'),
				'id_elemen_data_apotik' => $elemen,
			];
			if ($this->M_keloladata->check_if_exists('detail_elemen_data_apotik', $data)) {
				$this->db->where($data);
				$this->db->update('detail_elemen_data_apotik', ['jumlah_pemakaian_obat' => $this->input->post('jumlah_pemakaian_obat_' . $elemen)]);
			} else {
				$data['jumlah_pemakaian_obat'] = $this->input->post('jumlah_pemakaian_obat_' . $elemen);
				$this->db->insert('detail_elemen_data_apotik', $data);
			}
		}
		$this->session->set_flashdata('message', 'Data Apotik Berhasil disimpan');
		redirect('/operator/data_apotik');
	}
	public function inputdata_apotik($sesi)
	{
		$data = [
			'judul' => 'Input Data Apotik',
			'sesi' => $sesi,
			'kategori_data_apotik' => $this->M_keloladata->get_form_elemen_apotik(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_apotik', $data);
		$this->load->view('templates/footer');
	}
	public function laporan_data_apotik($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$kategori_data = $this->M_keloladata->get_detail_elemen_data_apotik($id_sesi, $id_puskesmas);
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'kategori_data' => $kategori_data,
			'sesi' => $sesi,
			'judul' => 'Laporan Data Apotik'
		];
		$data['profil'] = $this->session->userdata('profil');
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_data_apotik');
		$this->load->view('templates/footer');
	}
	public function laporan_data_apotik_exel($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$kategori_data = $this->M_keloladata->get_detail_elemen_data_apotik($id_sesi, $id_puskesmas);
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'kategori_data' => $kategori_data,
			'sesi' => $sesi,
			'judul' => 'Laporan Data Apotik'
		];
		$this->load->view('operator/laporan_data_apotik_excel', $data);
	}
	public function data_obat()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data['list_data'] = $this->M_keloladata->get_data_obat($id_puskesmas);
		$data['sesi'] = $this->M_keloladata->get_sesi(null, 1);
		$data['profil'] = $this->session->userdata('profil');
		$data['judul'] = 'Data Obat';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/data_obat_index', $data);
		$this->load->view('templates/footer');
	}

	public function inputdata_obat($sesi)
	{
		$data = [
			'judul' => 'Input Data Apotik',
			'sesi' => $sesi,
			'data_obat' => $this->M_obat->get_obat(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_obat', $data);
		$this->load->view('templates/footer');
	}

	public function store_data_obat()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data_obat = $this->input->post('id_obat');
		$jumlah_pemakaian_obat = $this->input->post('jumlah_pemakaian_obat');
		$stok_awal = $this->input->post('stok_awal');
		$diterima = $this->input->post('diterima');
		$ketersediaan = $this->input->post('ketersediaan');
		$sisa_stok = $this->input->post('sisa_stok');
		foreach ($data_obat as $key => $obat) {
			$data = [
				'id_puskesmas' => $id_puskesmas,
				'id_sesi' => $this->input->post('id_sesi'),
				'id_obat' => $obat
			];
			if ($this->M_keloladata->check_if_exists('data_obat', $data)) {
				$this->db->where($data);
				$update['jumlah_pemakaian_obat'] = $jumlah_pemakaian_obat[$key];
				$update['stok_awal'] = $stok_awal[$key];
				$update['ketersediaan'] = $ketersediaan[$key];
				$update['diterima'] = $diterima[$key];
				$update['sisa_stok'] = $sisa_stok[$key];
				$this->db->update('data_obat', $update);
			} else {
				$data['jumlah_pemakaian_obat'] = $jumlah_pemakaian_obat[$key];
				$data['stok_awal'] = $stok_awal[$key];
				$data['ketersediaan'] = $ketersediaan[$key];
				$data['diterima'] = $diterima[$key];
				$data['sisa_stok'] = $sisa_stok[$key];
				$this->db->insert('data_obat', $data);
			}
		}
		$this->session->set_flashdata('message', 'Data Obat berhasil ditambahkan');
		redirect('operator/data_obat');
	}
	public function laporan_data($id_data, $id_sesi)
	{

		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$info_data = $this->db->get_where('data', ['id' => $id_data])->row_array();
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$atribut_data = $this->M_keloladata->get_atribut_data($id_data);
		$kategori_data = $this->M_keloladata->get_detail_elemen_data($id_data, $id_sesi, $id_puskesmas);
		$detail_turunan = $this->M_keloladata->get_detail_turunan($id_data, $id_sesi, $id_puskesmas);

		$data = [
			'atribut_data' => $atribut_data,
			'kategori_data' => $kategori_data,
			'judul' => 'Laporan Rekapitulasi ' . $info_data['nama_data'] . ' Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'detail_turunan' => $detail_turunan,
			'info_data' => $info_data,
			'sesi' => $sesi,
		];
		$data['profil'] = $this->session->userdata('profil');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_data');
		$this->load->view('templates/footer');
	}
	public function laporan_data_excel($id_data, $id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$info_data = $this->db->get_where('data', ['id' => $id_data])->row_array();
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$atribut_data = $this->M_keloladata->get_atribut_data($id_data);
		$kategori_data = $this->M_keloladata->get_detail_elemen_data($id_data, $id_sesi, $id_puskesmas);
		$detail_turunan = $this->M_keloladata->get_detail_turunan($id_data, $id_sesi, $id_puskesmas);

		$data = [
			'atribut_data' => $atribut_data,
			'kategori_data' => $kategori_data,
			'judul' => 'Laporan Rekapitulasi ' . $info_data['nama_data'] . ' Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'detail_turunan' => $detail_turunan,
			'info_data' => $info_data,
			'sesi' => $sesi,
		];
		$this->load->view('operator/laporan_data_excel', $data);
	}

	public function laporan_data_obat($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data_obat = $this->M_keloladata->get_detail_data_obat($id_sesi, $id_puskesmas);
		$data = [
			'data_obat' => $data_obat,
			'judul' => 'Laporan Data Obat',
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_data_obat');
		$this->load->view('templates/footer');
	}
	public function data_promkes()
	{
		//$data['sesi'] = $this->M_keloladata->get_sesi(null, 1);
		$data = [
			'judul' => 'Input Data Promkes ',
			// 'sesi' => $sesi,
			'sesi' => $this->M_keloladata->get_sesi(null, 1),
			'profil' => $this->session->userdata('profil')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_promkes', $data);
		$this->load->view('templates/footer');
	}
	public function to_inputdata_promkes()
	{
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata_promkes_detail/' . $sesi);
	}
	public function inputdata_promkes_detail()
	{
		//$data['sesi'] = $this->M_keloladata->get_sesi(null, 1);
		$data = [
			'judul' => 'Input Data Promkes ',
			// 'sesi' => $sesi,
			'sesi' => $this->M_keloladata->get_sesi(null, 1),
			'profil' => $this->session->userdata('profil')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_promkes_detail', $data);
		$this->load->view('templates/footer');
	}
	public function data_ptm()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi(null, 1);
		$data = [
			'judul' => 'Input Data Pasien Tidak Menular ',
			'sesi' => $sesi,
			'list_data' => $this->M_keloladata->get_ptm($id_puskesmas),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/ptm_index');
		$this->load->view('templates/footer');
	}
	public function to_inputdata_ptm()
	{
		$sesi = $this->input->post('sesi');

		redirect('/operator/inputdata_ptm/' . $sesi);
	}
	public function inputdata_ptm($sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($sesi);
		$data = [
			'judul' => 'Input Data Penyakit tidak Menular ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'data_ptm' => $this->M_keloladata->get_form_ptm(),
			'atribut_ptm' => $this->db->get('atribut_ptm')->result_array(),
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_ptm', $data);
		$this->load->view('templates/footer');
	}
	public function store_ptm()
	{
		$id_data = $this->input->post('id_data');
		foreach ($id_data as $i => $data) {
			$input_usia = $this->input->post('usia_' . $data);
			foreach ($input_usia as $j => $usia) {
				$atribut_data = $this->input->post('id_atribut_' . $data . '_' . $usia);
				foreach ($atribut_data as $k => $atribut) {
					$kondisi = [
						'id_puskesmas' => $this->session->userdata('profil')['id_puskesmas'],
						'id_sesi' => $this->input->post('id_sesi'),
						'id_data' => $data,
						'id_usia' => $usia,
						'id_atribut' => $atribut,

					];
					if ($this->M_keloladata->check_if_exists('data_ptm', $kondisi)) {
						$input = [
							'l' => $this->input->post('l_' . $data . '_' . $usia . '_' . $atribut),
							'p' => $this->input->post('p_' . $data . '_' . $usia . '_' . $atribut)
						];
						$this->db->where($kondisi);
						$this->db->update('data_ptm', $input);
					} else {
						$input = [
							'id_puskesmas' => $this->session->userdata('profil')['id_puskesmas'],
							'id_sesi' => $this->input->post('id_sesi'),
							'id_data' => $data,
							'id_usia' => $usia,
							'id_atribut' => $atribut,
							'l' => $this->input->post('l_' . $data . '_' . $usia . '_' . $atribut),
							'p' => $this->input->post('p_' . $data . '_' . $usia . '_' . $atribut)
						];
						$this->db->insert('data_ptm', $input);
					}
				}
			}
		}
		redirect('/operator/data_ptm');
	}
	public function laporan_data_ptm($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data = [
			'data_ptm' => $this->M_keloladata->get_laporan_ptm($id_sesi, $id_puskesmas),
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil'),
			'judul' => 'Laporan Penyakit tidak Menular ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'usia_ptm' => $this->db->get('usia_ptm')->result_array()
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_ptm');
		$this->load->view('templates/footer');
	}

	public function laporan_data_ptm_excel($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data = [
			'data_ptm' => $this->M_keloladata->get_laporan_ptm($id_sesi, $id_puskesmas),
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil'),
			'judul' => 'Laporan Penyakit tidak Menular ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'usia_ptm' => $this->db->get('usia_ptm')->result_array()
		];
		$this->load->view('operator/laporan_data_ptm_excel', $data);
	}

	public function data_dbdfilca()
	{

		$kondisi = [
			'dbd_filca.id_puskesmas' => $this->session->userdata('profil')['id_puskesmas']
		];
		$data = [
			'judul' => 'Data DBD & FILCA',
			//'sesi' => $sesi,
			'sesi' => $this->M_keloladata->get_sesi(null, 1),
			'profil' => $this->session->userdata('profil'),
			'data_dbdfilca' => $this->M_keloladata->get_dbdfilca($kondisi)
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/dbdfilca_index', $data);
		$this->load->view('templates/footer');
	}

	public function to_inputdata_dbdfilca()
	{
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata_dbdfilca/' . $sesi);
	}
	public function inputdata_dbdfilca($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Input Data DBD & FILCA ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'sesi' => $sesi,
			'data_usia' => $this->M_keloladata->get_usia_dbdfilca(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/inputdata_dbdfilca');
		$this->load->view('templates/footer');
	}

	public function store_dbdfilca()
	{
		$id_sesi = $this->input->post('id_sesi');
		//Simpan data Induk
		$data = [
			'id_sesi' => $id_sesi,
			'id_puskesmas' => $this->session->userdata('profil')['id_puskesmas'],
		];

		if ($this->M_keloladata->check_if_exists('dbd_filca', $data)) {
			$input = [
				'jumlah_desa' => $this->input->post('jumlah_desa'),
				'jumlah_desa_diberi_obat' => $this->input->post('jumlah_desa_diberi_obat'),
				'jumlah_penduduk' => $this->input->post('jumlah_penduduk'),
				'jumlah_sasaran' => $this->input->post('jumlah_sasaran'),
			];
			$this->db->where($data);
			$this->db->update('dbd_filca', $input);
			$id = $this->db->get_where('dbd_filca', $data)->row_array()['id'];
		} else {
			$input = [
				'id_sesi' => $id_sesi,
				'id_puskesmas' => $this->session->userdata('profil')['id_puskesmas'],
				'jumlah_desa' => $this->input->post('jumlah_desa'),
				'jumlah_desa_diberi_obat' => $this->input->post('jumlah_desa_diberi_obat'),
				'jumlah_penduduk' => $this->input->post('jumlah_penduduk'),
				'jumlah_sasaran' => $this->input->post('jumlah_sasaran'),
			];
			$this->db->insert('dbd_filca', $input);
			$id = $this->db->insert_id();
		}
		//insert detail
		$id_usia = $this->input->post('id_usia');
		foreach ($id_usia as $usia) {
			$data = [
				'id_dbd_filca' => $id,
				'id_usia_dbd_filca' => $usia,
			];
			if ($this->M_keloladata->check_if_exists('detail_dbd_filca', $data)) {
				$input = [
					'l' => $this->input->post('l_' . $usia),
					'p' => $this->input->post('p_' . $usia),
				];
				$this->db->where($data);
				$this->db->update('detail_dbd_filca', $input);
			} else {
				$input = [
					'id_dbd_filca' => $id,
					'id_usia_dbd_filca' => $usia,
					'l' => $this->input->post('l_' . $usia),
					'p' => $this->input->post('p_' . $usia),
				];
				$this->db->insert('detail_dbd_filca', $data);
			}
		}
		redirect('operator/data_dbdfilca');
	}

	public function laporan_data_dbdfilca($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];

		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan DBD FILCA Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'info_sesi' => $sesi,
			'dbdfilca' => $this->M_keloladata->get_laporan_dbdfilca($id_sesi, $id_puskesmas),
			'usia_dbdfilca' => $this->db->get('usia_dbd_filca')->result_array(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_dbdfilca');
		$this->load->view('templates/footer');
	}
	public function laporan_data_dbdfilca_excel($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan DBD FILCA Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'dbdfilca' => $this->M_keloladata->get_laporan_dbdfilca($id_sesi, $id_puskesmas),
			'usia_dbdfilca' => $this->db->get('usia_dbd_filca')->result_array(),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('operator/laporan_dbdfilca_excel', $data);
	}

	public function inspeksi_ttu_tpm()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data = [
			'judul' => 'Inspeksi Tempat Tempat Umum dan Tempat Pengelolaan Makanan',
			//'sesi' => $sesi,
			'data_inspeksi' => $this->M_keloladata->get_data_inspeksi($id_puskesmas),
			'sesi' => $this->M_keloladata->get_sesi(null, 1),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/inspeksi_index');
		$this->load->view('templates/footer');
	}
	public function to_inputdata_inspeksi()
	{
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata_inspeksi/' . $sesi);
	}
	public function inputdata_inspeksi($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Input Data Inspeksi TTU & TPM ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'sesi' => $sesi,
			'atribut_inspeksi' => $this->db->get('atribut_inspeksi_sarana')->result_array(),
			'jenis_sarana' => $this->M_keloladata->get_form_inspeksi(),
			'profil' => $this->session->userdata('profil')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_inspeksi_detail', $data);
		$this->load->view('templates/footer');
	}


	// public function store_inspeksi_bc()
	// {
	// 	$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
	// 	$id_sarana = $this->input->post('id_sarana');
	// 	foreach ($id_sarana as $sarana) {
	// 		$data = [
	// 			'id_puskesmas' => $id_puskesmas,
	// 			'id_sesi' => $this->input->post('id_sesi'),
	// 			'id_sarana' => $sarana,
	// 			'id_atribut_inspeksi_sarana' => $this->input->post('id_atribut_' . $sarana),

	// 		];
	// 		if ($this->M_keloladata->check_if_exists('inspeksi_sarana', $data)) {
	// 			$input = [
	// 				'jumlah' => $this->input->post('jumlah_' . $sarana),
	// 				'persen' => $this->input->post('persen_' . $sarana)
	// 			];
	// 			$this->db->where($data);
	// 			$this->db->update('inspeksi_sarana', $input);
	// 		} else {
	// 			$data['jumlah'] = $this->input->post('jumlah_' . $sarana);
	// 			$data['persen'] = $this->input->post('persen_' . $sarana);
	// 			$this->db->insert('inspeksi_sarana', $data);
	// 		}
	// 	}
	// 	redirect('operator/inspeksi_ttu_tpm');
	// }
	public function store_inspeksi()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$id_sarana = $this->input->post('id_sarana');
		$id = null;
		$data = [
			'id_puskesmas' => $id_puskesmas,
			'id_sesi' => $this->input->post('id_sesi'),
			// 'id_sarana' => $sarana,
			// 'id_atribut_inspeksi_sarana' => $this->input->post('id_atribut_' . $sarana),
		];
		if ($this->M_keloladata->check_if_exists('inspeksi_sarana', $data)) {
			$input = [
				'bulan_ini_jumlah' => $this->input->post('bulan_ini_jumlah'),
				'bulan_ini_persen' => $this->input->post('bulan_ini_persen'),
				'kumulatif_bulan_lalu_jumlah' => $this->input->post('kumulatif_bulan_lalu_jumlah'),
				'kumulatif_bulan_lalu_persen' => $this->input->post('kumulatif_bulan_lalu_persen'),
			];
			// $input = [
			// 	'jumlah' => $this->input->post('jumlah_' . $sarana),
			// 	'persen' => $this->input->post('persen_' . $sarana)
			// ];
			$this->db->where($data);
			$this->db->update('inspeksi_sarana', $input);
			$id = $this->db->get_where('inspeksi_sarana', $data)->row_array()['id'];
		} else {
			$data['bulan_ini_jumlah'] = $this->input->post('bulan_ini_jumlah');
			$data['bulan_ini_persen'] = $this->input->post('bulan_ini_persen');
			$data['kumulatif_bulan_lalu_jumlah'] = $this->input->post('kumulatif_bulan_lalu_jumlah');
			$data['kumulatif_bulan_lalu_persen'] = $this->input->post('kumulatif_bulan_lalu_persen');
			// $data['jumlah'] = $this->input->post('jumlah_' . $sarana);
			// $data['persen'] = $this->input->post('persen_' . $sarana);
			$this->db->insert('inspeksi_sarana', $data);
			$id = $this->db->insert_id();
		}
		foreach ($id_sarana as $sarana) {
			$id_atribut = $this->input->post('id_atribut_' . $sarana);
			foreach ($id_atribut as $atribut) {
				$data = [
					'id_inspeksi_sarana' => $id,
					'id_sarana' => $sarana,
					'id_atribut_inspeksi_sarana' => $atribut,
				];
				if ($this->M_keloladata->check_if_exists('inspeksi_sarana_detail', $data)) {
					// $input = [
					// 	'bulan_ini_jumlah' => $this->input->post('bulan_ini_jumlah'),
					// 	'bulan_ini_persen' => $this->input->post('bulan_ini_persen'),
					// 	'kumulatif_bulan_lalu_jumlah' => $this->input->post('kumulatif_bulan_lalu_jumlah'),
					// 	'kumulatif_bulan_lalu_persen' => $this->input->post('kumulatif_bulan_lalu_persen'),
					// ];
					$input = [
						'jumlah' => $this->input->post('jumlah_' . $sarana . '_' . $atribut),
						'persen' => $this->input->post('persen_' . $sarana . '_' . $atribut)
					];
					$this->db->where($data);
					$this->db->update('inspeksi_sarana_detail', $input);
					// $id = $this->db->get_where('inspeksi_sarana_detail', $data)->row_array()['id'];
				} else {
					// $data['bulan_ini_jumlah'] = $this->input->post('bulan_ini_jumlah');
					// $data['bulan_ini_persen'] = $this->input->post('bulan_ini_persen');
					// $data['kumulatif_bulan_lalu_jumlah'] = $this->input->post('kumulatif_bulan_lalu_jumlah');
					// $data['kumulatif_bulan_lalu_persen'] = $this->input->post('kumulatif_bulan_lalu_persen');
					$data['jumlah'] = $this->input->post('jumlah_' . $sarana . '_' . $atribut);
					$data['persen'] = $this->input->post('persen_' . $sarana . '_' . $atribut);
					$this->db->insert('inspeksi_sarana_detail', $data);
					// $id = $this->db->insert_id();
				}
			}
		}
		redirect('operator/inspeksi_ttu_tpm');
	}
	public function laporan_data_inspeksi($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$detail_inspeksi = $this->M_keloladata->get_detail_inspeksi($id_sesi, $id_puskesmas);
		$data = [
			'judul' => 'Laporan Inspeksi TTU dan TPM Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'inspeksi_sarana' => $detail_inspeksi,
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_inspeksi');
		$this->load->view('templates/footer');
	}
	public function laporan_data_inspeksi_exel($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$detail_inspeksi = $this->M_keloladata->get_detail_inspeksi($id_sesi, $id_puskesmas);
		$data = [
			'judul' => 'Laporan Inspeksi TTU dan TPM Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'inspeksi_sarana' => $detail_inspeksi,
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('operator/laporan_inspeksi_excel', $data);
	}
	public function data_imunisasi()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data = [
			'judul' => 'Data Imunisasi',
			//'sesi' => $sesi,
			'data_imunisasi' => $this->M_keloladata->get_data_imunisasi($id_puskesmas),
			'sesi' => $this->M_keloladata->get_sesi(null, 1),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/imunisasi_index');
		$this->load->view('templates/footer');
	}
	public function to_inputdata_imunisasi()
	{
		$sesi = $this->input->post('sesi');
		redirect('/operator/inputdata_imunisasi/' . $sesi);
	}
	public function inputdata_imunisasi($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan Imunisasi ' . $sesi['nama_bulan'] . ' ' . $sesi['tahun'],
			'sesi' => $sesi,
			'form_imunisasi' => $this->M_keloladata->get_form_imunisasi(),
			'profil' => $this->session->userdata('profil')
		];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar', $data);
		$this->load->view('operator/inputdata_imunisasi', $data);
		$this->load->view('templates/footer');
	}
	public function store_imunisasi()
	{
		$id_imunisasi = $this->input->post('id_imunisasi');
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		foreach ($id_imunisasi as $imunisasi) {
			$kondisi = [
				'id_imunisasi' => $imunisasi,
				'id_puskesmas' => $id_puskesmas,
				'id_sesi' => $this->input->post('id_sesi')
			];
			if ($this->M_keloladata->check_if_exists('detail_imunisasi', $kondisi)) {
				$this->db->where($kondisi);
				$this->db->update('detail_imunisasi', [
					'l' => $this->input->post('l_' . $imunisasi),
					'p' => $this->input->post('p_' . $imunisasi),

				]);
			} else {
				$input = [
					'id_imunisasi' => $imunisasi,
					'id_puskesmas' => $id_puskesmas,
					'id_sesi' => $this->input->post('id_sesi'),
					'l' => $this->input->post('l_' . $imunisasi),
					'p' => $this->input->post('p_' . $imunisasi),
				];
				$this->db->insert('detail_imunisasi', $input);
			}
		}
		redirect('operator/data_imunisasi');
	}
	public function laporan_data_imunisasi($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data = [
			'judul' => 'Laporan Imunisasi Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'data_imunisasi' => $this->M_keloladata->get_detail_imunisasi($id_sesi, $id_puskesmas),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_imunisasi');
		$this->load->view('templates/footer');
	}
	public function laporan_data_imunisasi_exel($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];

		$data = [
			'judul' => 'Laporan Imunisasi Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'sesi' => $sesi,
			'data_imunisasi' => $this->M_keloladata->get_detail_imunisasi($id_sesi, $id_puskesmas),
			'profil' => $this->session->userdata('profil')
		];
		$this->load->view('operator/laporan_imunisasi_excel', $data);
	}
	public function stp()
	{
		$data = [
			'judul' => 'STP',
			'list_data' => $this->M_keloladata->get_stp(),
			'profil' => $this->session->userdata('profil'),
			'sesi' => $this->M_keloladata->get_sesi(null, 1)
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/stp_index');
		$this->load->view('templates/footer');
	}
	public function to_inputstp()
	{
		$sesi = $this->input->post('sesi');
		redirect('operator/inputdata_stp/' . $sesi);
	}
	public function inputdata_stp($id_sesi)
	{
		$sesi = $this->db->get_where('sesi', ['id' => $id_sesi])->row_array();
		$data = [
			'judul' => 'Input Data Lainnya (STP)',
			'data_stp' => $this->M_keloladata->get_form_stp(),
			'profil' => $this->session->userdata('profil'),
			'usia_stp' => $this->db->get_where('usia', ['stp' => 1])->result_array(),
			'sesi' => $sesi
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/inputdata_stp');
		$this->load->view('templates/footer');
	}

	public function store_stp()
	{
		$id_data = $this->input->post('id_data');
		$id_sesi = $this->input->post('id_sesi');
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		foreach ($id_data as $data) {
			$id_usia = $this->input->post('id_usia_' . $data);
			// var_dump($id_usia);
			// die();
			foreach ($id_usia as $usia) {
				$id_atribut = $this->input->post('id_atribut_' . $data . '_' . $usia);

				foreach ($id_atribut as $atribut) {
					$kondisi = [
						'id_sesi' => $id_sesi,
						'id_puskesmas' => $id_puskesmas,
						'id_atribut_data' => $atribut,
						'id_elemen_data_usia' => $usia
					];
					if ($this->M_keloladata->check_if_exists('detail_elemen_data_usia', $kondisi)) {
						$this->db->where($kondisi);
						$this->db->update('detail_elemen_data', [
							'jumlah' => $this->input->post('jumlah_' . $data . '_' . $usia . '_' . $atribut)
						]);
					} else {
						$input = [
							'id_sesi' => $id_sesi,
							'id_puskesmas' => $id_puskesmas,
							'id_atribut_data' => $atribut,
							'id_elemen_data_usia' => $usia,
							'jumlah' => $this->input->post('jumlah_' . $data . '_' . $usia . '_' . $atribut)
						];
						$this->db->insert('detail_elemen_data_usia', $input);
					}
				}
			}
		}
		redirect('operator/stp');
	}

	public function laporan_stp($id_sesi)
	{
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$usia_stp = $this->db->get_where('usia', ['stp' => 1])->result_array();
		$data = [
			'judul' => 'Laporan STP Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'data_stp' => $this->M_keloladata->get_laporan_stp($id_sesi, $id_puskesmas),
			'profil' => $this->session->userdata('profil'),
			'usia_stp' => $usia_stp
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_stp');
		$this->load->view('templates/footer');
	}

	//PKP
	public function data_pkp()
	{
		$data_pkp = $this->M_keloladata->get_data_pkp();
		$data = [
			'data_pkp' => $data_pkp,
			'judul' => 'Program promosi kesehatan(PKP)',
			'profil' => $this->session->userdata('profil'),
			'data_sesi' => $this->M_keloladata->get_sesi(null, 1)
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/pkp_index');
		$this->load->view('templates/footer');
	}
	public function to_input_pkp()
	{
		$sesi = $this->input->post('sesi');
		redirect('operator/inputdata_pkp/' . $sesi);
	}
	public function inputdata_pkp($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$pkp = $this->db->get_where('pkp', ['id_sesi' => $id_sesi])->row_array();
		$data = [
			'judul' => 'Input Data PKP Bulan ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'profil' => $this->session->userdata('profil'),
			'jenis_kegiatan' => $this->M_keloladata->get_jenis_kegiatan(null, $id_sesi),
			'sesi' => $sesi,
			// 'pkp' => $pkp
		];
		if (!empty($pkp)) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('operator/inputdata_pkp');
			$this->load->view('templates/footer');
		} else {
			redirect('operator/data_pkp');
		}
	}
	public function store_pkp()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$id_kegiatan = $this->input->post('id_kegiatan');
		foreach ($id_kegiatan as $kegiatan) {
			$kondisi = [
				'id_pkp' => $this->input->post('id_pkp_' . $kegiatan),
				'id_puskesmas' => $id_puskesmas,
			];
			if ($this->M_keloladata->check_if_exists('detail_pkp', $kondisi)) {
				$this->db->where($kondisi);
				$this->db->update('detail_pkp', [
					'abs' => $this->input->post('abs_' . $kegiatan),
					'kom' => $this->input->post('kom_' . $kegiatan),
				]);
			} else {
				$data = [
					'id_pkp' => $this->input->post('id_pkp_' . $kegiatan),
					'id_puskesmas' => $id_puskesmas,
					'abs' => $this->input->post('abs_' . $kegiatan),
					'kom' => $this->input->post('kom_' . $kegiatan),
				];
				$this->db->insert('detail_pkp', $data);
			}
		}
		redirect('operator/data_pkp');
	}
	public function laporan_pkp($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$jenis_kegiatan = $this->M_keloladata->get_detail_pkp($id_sesi, $id_puskesmas);
		$data = [
			'judul' => 'Laporan PKP Bulan . ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'jenis_kegiatan' => $jenis_kegiatan,
			'profil' => $this->session->userdata('profil'),
			'sesi' => $sesi,
			// 'pkp' => $this->db->get_where('pkp', ['id_sesi' => $id_sesi])->row_array(),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_pkp');
		$this->load->view('templates/footer');
	}
	public function laporan_data_pkp_excel($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$jenis_kegiatan = $this->M_keloladata->get_detail_pkp($id_sesi, $id_puskesmas);
		$data = [
			'judul' => 'Laporan PKP Bulan  ' . $sesi['nama_bulan'] . ' Tahun ' . $sesi['tahun'],
			'jenis_kegiatan' => $jenis_kegiatan,
			'profil' => $this->session->userdata('profil'),
			'sesi' => $sesi,
			// 'pkp' => $this->db->get_where('pkp', ['id_sesi' => $id_sesi])->row_array(),
		];
		$this->load->view('operator/laporan_pkp_excel', $data);
	}
	//TB PROGRAM
	public function data_tbprogram()
	{
		// $data_tbprogram = $this->M_keloladata->get_data_tbprogram();
		$data = [
			//'data_tbprogram' => $data_tbprogram,
			'judul' => 'Data Program Tubercolosis',
			'profil' => $this->session->userdata('profil'),
			'data_sesi' => $this->M_keloladata->get_sesi(null, 1),

		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/tbprogram_index');
		$this->load->view('templates/footer');
	}

	public function daftar_pasien_tb()
	{
		$data_tbprogram = $this->M_keloladata->get_data_tbprogram();
		$data = [
			'data_tbprogram' => $data_tbprogram,
			'judul' => 'Data Pasien Tubercolosis',
			'profil' => $this->session->userdata('profil'),
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/tbprogram_pasien');
		$this->load->view('templates/footer');
	}
	public function to_input_tbprogram()
	{
		$sesi = $this->input->post('sesi');
		redirect('operator/inputdata_tbprogram/' . $sesi);
	}
	public function store_tbprogram()
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$data = [
			'id_puskesmas' => $id_puskesmas,
			'nama_pasien' => $this->input->post('nama_pasien'),
			'jk_pasien' => $this->input->post('jk_pasien'),
			'umur_pasien' => $this->input->post('umur_pasien'),
			'alamat_pasien' => $this->input->post('alamat_pasien'),
			'tanggal_mulai' => $this->input->post('tanggal_mulai'),
			'bulan_mulai' => $this->input->post('bulan_mulai'),
			'tahun_mulai' => $this->input->post('tahun_mulai'),
			'jenis_tb' => $this->input->post('jenis_tb'),
			'tipe_tb' => $this->input->post('tipe_tb'),
			'hasil_hiv' => $this->input->post('hasil_hiv'),
			'lab_awal' => $this->input->post('lab_awal'),
		];
		$this->db->insert('tb_program', $data);
		redirect('operator/daftar_pasien_tb');
	}
	public function update_tbprogram()
	{
		$tanggal_selesai = $this->input->post('tanggal_selesai');
		$bulan_selesai = $this->input->post('bulan_selesai');
		$tahun_selesai = $this->input->post('tahun_selesai');
		$input = [
			'lab_2' => $this->input->post('lab_2'),
			'lab_3' => $this->input->post('lab_3'),
			'lab_ap' => $this->input->post('lab_ap'),
			'status' => $this->input->post('status'),
		];
		if ($tanggal_selesai > 0 && $bulan_selesai > 0 && $tahun_selesai > 0) {
			$input['tanggal_selesai'] = $this->input->post('tanggal_selesai');
			$input['bulan_selesai'] = $this->input->post('bulan_selesai');
			$input['tahun_selesai'] = $this->input->post('tahun_selesai');
		} else {
			$input['tanggal_selesai'] = null;
			$input['bulan_selesai'] = null;
			$input['tahun_selesai'] = null;
		}
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->update('tb_program', $input);
		redirect('operator/daftar_pasien_tb');
	}
	public function laporan_tbprogram($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan TB Program',
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil'),
			'data_tbprogram' => $this->M_keloladata->get_laporan_tbprogram($id_sesi, $id_puskesmas)
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('operator/laporan_tbprogram');
		$this->load->view('templates/footer');
	}
	public function laporan_tb_program_exel($id_sesi)
	{
		$id_puskesmas = $this->session->userdata('profil')['id_puskesmas'];
		$sesi = $this->M_keloladata->get_sesi($id_sesi);
		$data = [
			'judul' => 'Laporan TB Program',
			'sesi' => $sesi,
			'profil' => $this->session->userdata('profil'),
			'data_tbprogram' => $this->M_keloladata->get_laporan_tbprogram($id_sesi, $id_puskesmas)
		];
		$this->load->view('operator/laporan_tb_excel', $data);
	}
}
