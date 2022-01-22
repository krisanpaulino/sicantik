<?php

class M_obat extends CI_Model
{
	public function get_obat($id = null)
	{
		if ($id == null) {
			return $this->db->get_where('obat', ['is_deleted' => 0])->result_array();
		} else {
			return $this->db->get_where('obat', ['id' => $id])->row_array();
		}
	}
}
