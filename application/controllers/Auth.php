<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_auth');
	}


	public function index()
	{
		//$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// if ($this->session->userdata('email')) {
		// 	redirect('user');
		// }
		if ($this->session->userdata('role') == 'admin') {
			redirect('admin');
		} elseif ($this->session->userdata('role') == 'operator') {
			redirect('operator');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Halaman login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('templates/auth_footer');
		} else {
			// validasinya success
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		// jika usernya ada
		if ($user) {
			// jika usernya aktif
			if ($user['is_active'] == 1) {
				// cek password
				if (password_verify($password, $user['password'])) {
					$role = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
					$data = [
						'id' => $user['id'],
						'nama' => $user['nama'],
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'role' => $role['role']
					];

					if ($user['role_id'] == 1) {
						$data['profil'] = $this->M_auth->get_profil_operator($user['id']);
						// var_dump($data['profil']);
						// die();
						$this->session->set_userdata($data);
						redirect('operator ');
					} else {
						$this->session->set_userdata($data);
						redirect('admin');
					}
				} else {

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			redirect('auth');
		}
	}
	public function logout()
	{
		$data = [
			'id',
			'email',
			'role_id',
			'role',
			'profil'
		];
		$this->session->unset_userdata($data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('/auth');
	}
}
