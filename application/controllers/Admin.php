<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != 'admin') {
			redirect('auth');
		}
		$this->load->library('form_validation');
		$this->load->model('M_keloladata');
		$this->load->model('M_auth');
		$this->load->model('M_datamaster');
	}


	public function index()
	{
		$data['judul'] = 'Halaman Admin';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('admin/dashboard');
		$this->load->view('templates/footer');
	}
	public function inputdata_kabupaten()
	{
		$data['judul'] = 'Data Kabupaten';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kabupaten_kota'] = $this->db->get('kabupaten_kota')->result_array();

		$this->form_validation->set_rules('nama_kabupaten_kota', 'Nama Kabupaten', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('inputdata/data_kabupaten');
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama_kabupaten_kota' => $this->input->post('nama_kabupaten_kota'),
				'jenis' => $this->input->post('jenis'),

			];
			$this->db->insert('kabupaten_kota', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');
			redirect('admin/inputdata_kabupaten');
		}
	}
	public function inputdata_kecamatan()
	{
		$data['judul'] = 'Data Kecamatan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kecamatan'] = $this->db->get('kecamatan')->result_array();
		$data['kecamatan'] = $this->M_keloladata->tampil_kota();
		$data['kabupaten_kota'] = $this->db->get('kabupaten_kota')->result_array();

		$this->form_validation->set_rules('nama_kecamatan', 'Nama Kecamatan', 'required');
		$this->form_validation->set_rules('id_kabupaten_kota', 'Kabupaten/Kota', 'required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('inputdata/data_kecamatan');
			$this->load->view('templates/footer');
		} else {


			$data = [
				'nama_kecamatan' => $this->input->post('nama_kecamatan'),
				'id_kabupaten_kota' => $this->input->post('id_kabupaten_kota'),

			];
			$this->db->insert('kecamatan', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');
			redirect('admin/inputdata_kecamatan');
		}
	}
	public function input_periode()
	{
		$data['judul'] = 'Data Periode Sesi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['sesi'] = $this->M_keloladata->get_sesi();
		$data['data_bulan'] = $this->db->get('bulan')->result_array();
		$data['data_tahun'] = $this->db->get('tahun')->result_array();


		$this->form_validation->set_rules('id_tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('id_bulan', 'Bulan', 'required');
		// $this->form_validation->set_rules('is_open', 'Buka sesi', 'required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar_admin');
			$this->load->view('inputdata/data_periode');
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_tahun' => $this->input->post('id_tahun'),
				'id_bulan' => $this->input->post('id_bulan'),
				'is_open' => 1,
			];
			$this->db->insert('sesi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');
			redirect('admin/input_periode');
		}
	}
	public function tambah_tahun()
	{
		$data['tahun'] = $this->input->post('tahun');
		if (!$this->M_keloladata->check_if_exists('tahun', $data)) {
			$this->db->insert('tahun', $data);
		}
		redirect('admin/input_periode');
	}
	public function nonaktifkan_tahun()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
	}
	public function open_sesi()
	{
		$id_sesi = $this->input->post('id_sesi');
		$data['is_open'] = 1;
		$this->db->where('id', $id_sesi);
		$this->db->update('sesi', $data);
		redirect('admin/input_periode');
	}
	public function close_sesi()
	{
		$id_sesi = $this->input->post('id_sesi');
		$data['is_open'] = 0;
		$this->db->where('id', $id_sesi);
		$this->db->update('sesi', $data);
		redirect('admin/input_periode');
	}

	public function inputdata_puskesmas()
	{
		$data['judul'] = 'Data puskesmas';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['puskesmas'] = $this->db->get_where('puskesmas', ['is_deleted' => 0])->result_array();
		$this->load->library('upload');

		$this->form_validation->set_rules('nama_puskesmas', 'Nama puskesmas', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No HP', 'required');
		// $this->form_validation->set_rules('filefoto', 'Foto', 'image|required');


		if ($this->form_validation->run() == false) {

			// return var_dump('here');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar_admin');
			$this->load->view('inputdata/data_puskesmas', $data);
			$this->load->view('templates/footer');
		} else {
			// return var_dump('here');
			$gbr = $this->upload->data();
			$config['upload_path'] = './assets/dist/img/puskesmas/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

			$config['quality'] = '60%';
			$config['width'] = 500;
			$config['height'] = 400;
			$config['file_name'] = 'puskesmas_' . $gbr['file_name'];
			$this->upload->initialize($config);
			if (!empty($_FILES['filefoto']['name'])) {

				if ($this->upload->do_upload('filefoto')) {
					$file = $this->upload->data();
					$data = [
						'nama_puskesmas' => $this->input->post('nama_puskesmas'),
						'alamat' => $this->input->post('alamat'),
						'no_telp' => $this->input->post('no_telp'),
						'foto' => $file['file_name']
					];
					$this->db->insert('puskesmas', $data);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');
					redirect('admin/inputdata_puskesmas');
				} else {
				}
			} else {
			}
		}
	}

	public function edit_puskesmas($id)
	{
		$puskesmas = $this->db->get_where('puskesmas', ['id' => $id])->row_array();
		$data = [
			'judul' => 'Edit ' . $puskesmas['nama_puskesmas'],
			'puskesmas' => $puskesmas,
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar_admin');
		$this->load->view('inputdata/edit_puskesmas', $data);
		$this->load->view('templates/footer');
	}

	public function update_puskesmas()
	{
		$id = $this->input->post('id');
		$data = [
			'nama_puskesmas' => $this->input->post('nama_puskesmas'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp'),
		];
		$this->db->where('id', $id);
		$this->db->update('puskesmas', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data puskesmas berhasi diubah!</div>');

		header('location:' . $_SERVER['HTTP_REFERER']);
	}

	public function ganti_foto_puskesmas()
	{
		$id = $this->input->post('id');
		$puskesmas = $this->db->get_where('puskesmas', ['id' => $id])->row_array();
		$config['upload_path'] = './assets/dist/img/puskesmas/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

		$config['quality'] = '60%';
		$config['width'] = 500;
		$config['height'] = 400;
		$config['file_name'] = 'puskesmas_' . $puskesmas['id'];
		$this->upload->initialize($config);
		if (!empty($_FILES['fotopost']['name'])) {
			if ($this->upload->do_upload('fotopost')) {

				$data['foto'] = $this->upload->data('file_name');

				$this->db->where('id', $id);
				$this->db->update('puskesmas', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Foto Berhasil Diubah!</div>');
				header('location:' . $_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Foto Gagal Diubah!</div>');
				header('location:' . $_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Foto Gagal Diubah!</div>');
			header('location:' . $_SERVER['HTTP_REFERER']);
		}
	}

	public function hapus_puskesmas()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$data['is_deleted'] = 1;
		$this->db->update('puskesmas', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data dihapus!</div>');
		header('location:' . $_SERVER['HTTP_REFERER']);
	}

	public function inputdata_operator()
	{
		$data = [
			'judul' => 'Data Operator',
			'data_operator' => $this->M_auth->get_operator(),
			'data_puskesmas' => $this->M_datamaster->get_puskesmas()
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('admin/input_operator');
		$this->load->view('templates/footer');
	}

	public function store_operator()
	{
		$this->form_validation->set_rules('nama', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('id_puskesmas', 'Puskesmas', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');

		if ($this->form_validation->run()) {
			$nama = $this->input->post('nama');
			$password = $this->input->post('password1');
			$email = $this->input->post('email');

			$id_user = $this->M_auth->regis_operator($nama, $email, $password);

			$gbr = $this->upload->data();
			$config['upload_path'] = './assets/dist/img/puskesmas/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

			$config['quality'] = '60%';
			$config['width'] = 500;
			$config['height'] = 400;
			$config['file_name'] = 'operator_' . $gbr['file_name'];
			$this->upload->initialize($config);
			if (!empty($_FILES['filefoto']['name'])) {

				if ($this->upload->do_upload('filefoto')) {
					$file = $this->upload->data();
					$data = [
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'tempat_lahir' => $this->input->post('tempat_lahir'),
						'tanggal_lahir' => $this->input->post('tanggal_lahir'),
						'id_puskesmas' => $this->input->post('id_puskesmas'),
						'jenis_kelamin' => $this->input->post('jenis_kelamin'),
						'no_hp' => $this->input->post('no_hp'),
						'nip' => $this->input->post('nip'),
						'foto' => $file['file_name'],
						'id_user' => $id_user
					];
					$this->db->insert('operator', $data);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data anda berhasil ditambahkan!</div>');
					redirect('/admin/inputdata_operator');
				} else {
				}
			} else {
			}
		} else {
			$this->session->set_flashdata('error', validation_errors());
			return var_dump(validation_errors());
			// redirect('/admin/inputdata_operator');
		}
	}

	public function edit_operator($id)
	{
		$operator = $this->M_auth->get_operator($id);
		$user = $this->M_auth->get_user($operator['id_user']);
		$data = [
			'judul' => $operator['nama'],
			'data_puskesmas' => $this->M_datamaster->get_puskesmas(),
			'operator' => $operator,
			'user' => $user
		];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar_admin');
		$this->load->view('admin/edit_operator');
		$this->load->view('templates/footer');
	}

	public function update_operator()
	{
		$id = $this->input->post('id');
		$data = [
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'no_hp' => $this->input->post('no_hp'),
			'nip' => $this->input->post('nip'),
			'id_puskesmas' => $this->input->post('id_puskesmas'),
		];
		$this->db->where('id', $id);
		$this->db->update('operator', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil update!</div>');
		header('location:' . $_SERVER['HTTP_REFERER']);
	}
	public function update_foto_operator()
	{
		$id = $this->input->post('id');
		$operator = $this->M_auth->get_operator($id);
		$config['upload_path'] = './assets/dist/img/puskesmas/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan

		$config['quality'] = '60%';
		$config['width'] = 500;
		$config['height'] = 400;
		$config['file_name'] = 'operator_' . $operator['id'];
		$this->upload->initialize($config);
		if (!empty($_FILES['fotopost']['name'])) {
			if ($this->upload->do_upload('fotopost')) {

				$data['foto'] = $this->upload->data('file_name');

				$this->db->where('id', $id);
				$this->db->update('operator', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Foto Berhasil Diubah!</div>');
				header('location:' . $_SERVER['HTTP_REFERER']);
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Foto Gagal Diubah!</div>');
				header('location:' . $_SERVER['HTTP_REFERER']);
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Foto Gagal Diubah!</div>');
			header('location:' . $_SERVER['HTTP_REFERER']);
		}
	}
	public function reset_password()
	{
		$id = $this->input->post('id');
		//cek password sama
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		//hash the password
		$password = $this->input->post('password1');
		$data['password'] = password_hash($password, PASSWORD_DEFAULT);

		//update the password
		$this->db->where('id', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success mb-2" role="alert">Password berhasil di-reset!</div>');

		header('location:' . $_SERVER['HTTP_REFERER']);
	}

	public function hapus_operator()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->delete('user');
		$this->session->set_flashdata('message', '<div class="alert alert-success mb-2" role="alert">Operator dihapus!</div>');
		header('location:' . $_SERVER['HTTP_REFERER']);
	}
}
