<?php

class M_auth extends CI_Model
{
	public function get_operator($id = null)
	{
		if ($id == null) {
			$this->db->select('operator.*, puskesmas.nama_puskesmas, user.email');
			$this->db->from('operator');
			$this->db->join('puskesmas', 'puskesmas.id = operator.id_puskesmas');
			// return var_dump($this->db->get()->result_array());
			$this->db->join('user', 'user.id = operator.id_user');
			return $this->db->get()->result_array();
		} else {
			$this->db->select('operator.*, puskesmas.nama_puskesmas');
			$this->db->from('operator');
			$this->db->join('puskesmas', 'puskesmas.id = operator.id_puskesmas');
			$this->db->where('operator.id', $id);
			return $this->db->get()->row_array();
		}
	}
	public function get_user($id_user)
	{
		return $this->db->get_where('user', ['id' => $id_user])->row_array();
	}

	public function get_profil_operator($id_user)
	{
		$this->db->select('operator.*, puskesmas.nama_puskesmas');
		$this->db->from('operator');
		$this->db->join('puskesmas', 'puskesmas.id = operator.id_puskesmas');
		$this->db->where('operator.id_user', $id_user);
		var_dump($id_user);
		return $this->db->get()->row_array();
	}

	public function get_profil_admin($id_user)
	{
		$this->db->from('admin');
		$this->db->where('id_user', $id_user);
		return $this->db->get()->row_array();
	}

	public function regis_operator($nama, $email, $password)
	{
		$data = [
			'nama' => htmlspecialchars($nama),
			'email' => htmlspecialchars($email),
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role_id' => 1,
			'is_active' => 1,
		];
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}
}
