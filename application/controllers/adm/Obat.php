<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Obat extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if ($this->session->userdata('role') != 'admin') {
				redirect('auth');
			}
			$this->load->library('form_validation');
			$this->load->model('M_obat');
		}
		public function index()
		{
			$data = [
				'data_obat' => $this->M_obat->get_obat(),
				'judul' => 'Data Obat',
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('obat/obat_index', $data);
			$this->load->view('templates/footer');
		}
		public function store_obat()
		{
			$this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required|is_unique[obat.nama_obat]');
			$this->form_validation->set_rules('satuan', 'Satuan', 'required');
			if ($this->form_validation->run()) {
				$data = [
					'nama_obat' => $this->input->post('nama_obat'),
					'satuan' => $this->input->post('satuan'),
					'is_deleted' => 0
				];
				$this->db->insert('obat', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');

				redirect('/adm/obat');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger mb-4" role="alert">gagal!!</div>');
				redirect('/adm/obat');
			}
		}
		public function edit_obat($id)
		{
			$data = [
				'obat' => $this->M_obat->get_obat($id),
				'judul' => 'Edit Obat',
			];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('obat/edit_obat');
			$this->load->view('templates/footer');
		}
		public function update_obat()
		{
			$id = $this->input->post('id');
			$this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required');
			$this->form_validation->set_rules('satuan', 'Satuan', 'required');
			if ($this->form_validation->run()) {
				$data = [
					'nama_obat' => $this->input->post('nama_obat'),
					'satuan' => $this->input->post('satuan'),
					'is_deleted' => 0
				];
				$this->db->where('id', $id);
				$this->db->update('obat', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data obat berhasil diubah!</div>');

				redirect('/adm/obat');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger mb-4" role="alert">gagal!!</div>');
				redirect('/adm/obat');
			}
		}
		public function delete_obat()
		{
			$id = $this->input->post('id');
			$data['is_deleted'] = 1;
			$this->db->where('id', $id);
			$this->db->update('obat', $data);
			$this->session->set_flashdata('message', 'Data obat berhasil dihapus');
			redirect('/adm/obat');
		}
	}
