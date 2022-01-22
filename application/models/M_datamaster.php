<?php

class M_datamaster extends CI_Model
{
	public function get_puskesmas($id = null)
	{
		if ($id == null) {
			$query = "SELECT * FROM puskesmas";
			return $this->db->query($query)->result_array();
		} else {
			$query = "SELECT * FROM puskesmas WHERE id = '$id'";
			return $this->db->query($query)->row_array();
		}
	}
}
