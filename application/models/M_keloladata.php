<?php

class M_keloladata extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_obat');
	}
	public function tampil_kota()
	{ {
			$query = "SELECT kecamatan.id,nama_kecamatan,nama_kabupaten_kota,jenis
                FROM kecamatan,kabupaten_kota
                WHERE kecamatan.id_kabupaten_kota=kabupaten_kota.id
                ";
			return $this->db->query($query)->result_array();
		}
	}
	public function check_if_exists($table, $condition)
	{
		$query = $this->db->get_where($table, $condition);
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function get_sesi($id = null, $is_open = null)
	{
		if ($id == null && $is_open == null) {

			$this->db->select('sesi.*, tahun.tahun, bulan.nama_bulan');
			$this->db->from('sesi');
			$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
			$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
			return $this->db->get()->result_array();
		} elseif ($id == null && $is_open != null) {
			$this->db->select('sesi.*, tahun.tahun, bulan.nama_bulan');
			$this->db->from('sesi');
			$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
			$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
			$this->db->where('sesi.is_open', $is_open);
			return $this->db->get()->result_array();
		} else {
			$this->db->select('sesi.*, tahun.tahun, bulan.nama_bulan, bulan.angka_bulan');
			$this->db->from('sesi');
			$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
			$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
			$this->db->where('sesi.id', $id);
			return $this->db->get()->row_array();
		}
	}
	public function get_data($id = null, $id_puskesmas = null)
	{
		if ($id == null && $id_puskesmas == null) {
			$this->db->from('data');
			$this->db->where('punya_elemen_data', 1);
			return $this->db->get()->result_array();
		} elseif ($id_puskesmas != null) {
			$query = "SELECT distinct data.*, tahun.id as id_tahun, tahun.tahun, bulan.nama_bulan, detail_elemen_data.id_sesi FROM data, elemen_data, detail_elemen_data, sesi, tahun, bulan WHERE data.id = elemen_data.id_data AND elemen_data.id = detail_elemen_data.id_elemen_data AND detail_elemen_data.id_sesi = sesi.id AND sesi.id_tahun = tahun.id AND sesi.id_bulan = bulan.id AND detail_elemen_data.id_puskesmas = '$id_puskesmas' AND data.id = '$id'";
			return $this->db->query($query)->result_array();
		} else {
			$this->db->from('data');
			$this->db->where('id', $id);
			return $this->db->get()->row_array();
		}
	}

	public function get_all_data()
	{
		$this->db->from('data');
		return $this->db->get()->result_array();
	}
	public function get_data_obat($id_puskesmas)
	{
		$this->db->distinct('sesi.*');
		$this->db->select('sesi.*, tahun.tahun, bulan.nama_bulan');
		$this->db->from('sesi');
		$this->db->join('data_obat', 'data_obat.id_sesi = sesi.id');
		$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
		$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
		$this->db->where('data_obat.id_puskesmas', $id_puskesmas);
		return $this->db->get()->result_array();
	}
	public function get_single_data($id)
	{
		$this->db->from('data');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
	public function get_elemen_data($id_data)
	{
		$query = "SELECT elemen_data.*, kategori_elemen_data.nama_kategori from elemen_data, kategori_elemen_data WHERE kategori_elemen_data.id = elemen_data.id_kategori_elemen_data AND elemen_data.id_data = '$id_data'";
		return $this->db->query($query)->result_array();
	}
	public function get_elemen_data_by_kategori($id_kategori, $id_data)
	{
		$this->db->from('elemen_data');
		$this->db->where('id_kategori_elemen_data', $id_kategori);
		$this->db->where('id_data', $id_data);
		return $this->db->get()->result_array();
	}
	public function get_kategori_elemen($id = null)
	{
		if ($id == null) {
			$this->db->from('kategori_elemen_data');
			$query = $this->db->get();
			return $query->result_array();
		} else {
			return 0;
		}
	}
	public function get_kategori_by_data($id_data)
	{
		$query = "SELECT DISTINCT kategori_elemen_data.* FROM kategori_elemen_data, elemen_data WHERE kategori_elemen_data.id = elemen_data.id_kategori_elemen_data AND elemen_data.id_data = '$id_data'";
		return $this->db->query($query)->result_array();
	}
	public function get_atribut_data($id_data)
	{
		$this->db->select('atribut.*, atribut_data.id as id_atribut_data');
		$this->db->from('atribut');
		$this->db->join('atribut_data', 'atribut_data.id_atribut = atribut.id');
		$this->db->where('atribut_data.id_data', $id_data);
		return $this->db->get()->result_array();
	}
	public function get_not_atribut_data($id_data)
	{
		$query = "SELECT * from atribut WHERE NOT EXISTS (SELECT * FROM atribut_data WHERE atribut_data.id_atribut = atribut.id AND atribut_data.id_data = '$id_data')";
		return $this->db->query($query)->result_array();
	}
	public function get_usia($id = null)
	{
		if ($id == null) {
			$this->db->from('usia');
			return $this->db->get()->result_array();
		} else {
			$this->db->from('usia');
			$this->db->where('id', $id);
			return $this->db->get()->row_array();
		}
	}
	public function get_elemen_usia($id_data)
	{
		$query = "SELECT elemen_data_usia.*, usia.rentang_usia FROM elemen_data_usia, usia WHERE elemen_data_usia.id_usia = usia.id AND elemen_data_usia.id_data = '$id_data'";
		return $this->db->query($query)->result_array();
	}
	public function get_not_elemen_usia($id_data)
	{
		$query = "SELECT usia.* FROM usia WHERE NOT EXISTS (SELECT * FROM elemen_data_usia WHERE elemen_data_usia.id_usia = usia.id AND elemen_data_usia.id_data = '$id_data')";
		return $this->db->query($query)->result_array();
	}
	public function get_elemen_data_apotik($id_kategori = null)
	{
		$this->db->select('elemen_data_apotik.*, kategori_elemen_data_apotik.nama_kategori');
		$this->db->from('elemen_data_apotik');
		$this->db->join('kategori_elemen_data_apotik', 'elemen_data_apotik.id_kategori_data_apotik = kategori_elemen_data_apotik.id');
		if ($id_kategori == null) {
			$this->db->where('elemen_data_apotik.is_deleted', 0);
			return $this->db->get()->result_array();
		} else {
			$this->db->where('id_kategori_data_apotik', $id_kategori);
			return $this->db->get()->result_array();
		}
	}
	public function get_data_apotik($id_puskesmas)
	{
		$query = "SELECT distinct sesi.*, tahun.id as id_tahun, tahun.tahun, bulan.nama_bulan, detail_elemen_data_apotik.id_sesi FROM elemen_data_apotik, detail_elemen_data_apotik, sesi, tahun, bulan WHERE elemen_data_apotik.id = detail_elemen_data_apotik.id_elemen_data_apotik AND detail_elemen_data_apotik.id_sesi = sesi.id AND sesi.id_tahun = tahun.id AND sesi.id_bulan = bulan.id AND detail_elemen_data_apotik.id_puskesmas = '$id_puskesmas'";
		return $this->db->query($query)->result_array();
	}
	public function get_kategori_elemen_data_apotik($id = null)
	{
		if ($id == null) {
			return $this->db->get_where('kategori_elemen_data_apotik', ['is_deleted' => 0])->result_array();
		} else {
			return $this->db->get_where('kategori_elemen_data_apotik', ['id' => $id])->row_array();
		}
	}
	public function get_form_elemen($id_data)
	{
		$kategori_data = $this->get_kategori_by_data($id_data);
		foreach ($kategori_data as $key => $kategori) {
			$kategori_data[$key]['elemen_data'] = $this->get_elemen_data_by_kategori($kategori['id'], $id_data);
		}
		return $kategori_data;
	}
	public function get_form_data_turunan($id_data)
	{
		$list_data = $this->db->get_where('data', ['id_induk_penyakit' => $id_data])->result_array();
		foreach ($list_data as $i => $data) {
			$kategori_data = null;
			$elemen_usia = null;
			if ($data['punya_elemen_data'] == 1) {
				$kategori_data = $this->get_kategori_by_data($data['id']);

				foreach ($kategori_data as $key => $kategori) {
					$kategori_data[$key]['elemen_data'] = $this->get_elemen_data_by_kategori($kategori['id'], $data['id']);
				}
			}
			$list_data[$i]['kategori_data'] = $kategori_data;
			// var_dump($kategori_data);
			if ($data['punya_elemen_usia'] == 1 || $data['is_stp']) {
				$elemen_usia = $this->get_elemen_usia($data['id']);
			}
			$atribut_data = $this->get_atribut_data($data['id']);
			$list_data[$i]['atribut_data'] = $atribut_data;
			$list_data[$i]['elemen_usia'] = $elemen_usia;
		}

		// die();
		return $list_data;
	}

	public function get_detail_turunan($id_data, $id_sesi, $id_puskesmas = null)
	{
		$data_turunan = $this->db->get_where('data', ['id_induk_penyakit' => $id_data])->result_array();
		if (!empty($data_turunan)) {
			if ($id_puskesmas != null) {
				foreach ($data_turunan as $i => $turunan) {
					if ($turunan['punya_elemen_data'] == 1) {
						$kategori_data = $this->get_kategori_by_data($turunan['id']);
						foreach ($kategori_data as $j => $kategori) {
							$elemen_data = $this->get_elemen_data_by_kategori($kategori['id'], $turunan['id']);
							$kategori_data[$j]['elemen_data'] = $elemen_data;

							//get jumlah
							foreach ($elemen_data as $k => $data) {
								$detail_elemen_data = $this->db->get_where('detail_elemen_data', ['id_elemen_data' => $data['id'], 'id_sesi' => $id_sesi, 'id_puskesmas' => $id_puskesmas])->result_array();
								$kategori_data[$j]['elemen_data'][$k]['detail_elemen_data'] = $detail_elemen_data;
							}
						}
						$data_turunan[$i]['kategori_data'] = $kategori_data;
					}
					if ($turunan['punya_elemen_data'] == 1 || $turunan['is_stp'] == 1) {
						$elemen_usia = $this->get_elemen_usia($turunan['id']);
						foreach ($elemen_usia as $j => $usia) {
							$detail_elemen_usia = $this->db->get_where('detail_elemen_data_usia', [
								'id_elemen_data_usia' => $usia['id'],
								'id_sesi' => $id_sesi,
								'id_puskesmas' => $id_puskesmas
							])->result_array();
							$elemen_usia[$j]['detail_elemen_usia'] = $detail_elemen_usia;
						}
						$data_turunan[$i]['elemen_usia'] = $elemen_usia;
					}
				}
				return $data_turunan;
			} else {
				foreach ($data_turunan as $i => $turunan) {
					if ($turunan['punya_elemen_data'] == 1) {
						$kategori_data = $this->get_kategori_by_data($turunan['id']);
						foreach ($kategori_data as $j => $kategori) {
							$elemen_data = $this->get_elemen_data_by_kategori($kategori['id'], $turunan['id']);
							$kategori_data[$j]['elemen_data'] = $elemen_data;

							//get jumlah
							foreach ($elemen_data as $k => $data) {
								$data_puskesmas = $this->db->get('puskesmas')->result_array();
								$kategori_data[$j]['elemen_data'][$k]['puskesmas'] = $data_puskesmas;
								foreach ($data_puskesmas as $l => $puskesmas) {
									$detail_elemen_data = $this->db->get_where('detail_elemen_data', ['id_elemen_data' => $data['id'], 'id_sesi' => $id_sesi, 'id_puskesmas' => $puskesmas['id']])->result_array();
									$kategori_data[$j]['elemen_data'][$k]['puskesmas'][$l]['detail_elemen_data'] = $detail_elemen_data;
								}
							}
						}
						$data_turunan[$i]['kategori_data'] = $kategori_data;
					}
					if ($turunan['punya_elemen_usia'] == 1 || $turunan['is_stp'] == 1) {
						$data_puskesmas = $this->db->get('puskesmas')->result_array();
						$elemen_usia = $this->get_elemen_usia($turunan['id']);
						foreach ($elemen_usia as $j => $usia) {
							$elemen_usia[$j]['puskesmas'] = $data_puskesmas;
							foreach ($data_puskesmas as $k => $puskesmas) {
								$detail_elemen_usia = $this->db->get_where('detail_elemen_data_usia', [
									'id_elemen_data_usia' => $usia['id'],
									'id_sesi' => $id_sesi,
									'id_puskesmas' => $puskesmas['id']
								])->result_array();
								$elemen_usia[$j]['puskesmas'][$k]['detail_elemen_usia'] = $detail_elemen_usia;
							}
						}

						$data_turunan[$i]['elemen_usia'] = $elemen_usia;
						// var_dump($data_turunan[$i]);
						// die();
						// var_dump("here");
					}
				}
				// var_dump($data_turunan);
				// die();
				return $data_turunan;
			}
		} else {
			return null;
		}
	}
	public function get_form_elemen_apotik()
	{
		$kategori_data = $this->get_kategori_elemen_data_apotik();
		foreach ($kategori_data as $key => $kategori) {
			$kategori_data[$key]['elemen_data'] = $this->get_elemen_data_apotik($kategori['id']);
		}
		return $kategori_data;
	}
	public function get_detail_elemen_data_apotik($id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$kategori_data = $this->get_kategori_elemen_data_apotik();
			foreach ($kategori_data as $key => $kategori) {
				$elemen_data = $this->db->get_where('elemen_data_apotik', ['id_kategori_data_apotik' => $kategori['id']])->result_array();
				$kategori_data[$key]['elemen_data'] = $elemen_data;
				foreach ($elemen_data as $i => $elemen) {
					$detail_elemen_data = $this->db->get_where('detail_elemen_data_apotik', [
						'id_puskesmas' => $id_puskesmas,
						'id_sesi' => $id_sesi,
						'id_elemen_data_apotik' => $elemen['id']
					])->row_array();

					$kategori_data[$key]['elemen_data'][$i]['detail_elemen_data'] = $detail_elemen_data;
				}
			}
			return $kategori_data;
		} else {
			$kategori_data = $this->get_kategori_elemen_data_apotik();
			foreach ($kategori_data as $key => $kategori) {
				$elemen_data = $this->db->get_where('elemen_data_apotik', ['id_kategori_data_apotik' => $kategori['id']])->result_array();
				$kategori_data[$key]['elemen_data'] = $elemen_data;

				foreach ($elemen_data as $i => $elemen) {
					$data_puskesmas = $this->db->get_where('puskesmas', ['is_deleted' => 0])->result_array();

					$kategori_data[$key]['elemen_data'][$i]['puskesmas'] = $data_puskesmas;
					foreach ($data_puskesmas as $j => $puskesmas) {

						$detail_elemen_data = $this->db->get_where('detail_elemen_data_apotik', [
							'id_puskesmas' => $puskesmas['id'],
							'id_sesi' => $id_sesi,
							'id_elemen_data_apotik' => $elemen['id']
						])->row_array();


						$kategori_data[$key]['elemen_data'][$i]['puskesmas'][$j]['detail_elemen_data'] = $detail_elemen_data;
					}
				}
			}

			return $kategori_data;
		}
	}
	public function get_detail_elemen_data($id_data, $id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$kategori_data = $this->get_kategori_by_data($id_data);
			foreach ($kategori_data as $key => $kategori) {
				$elemen_data = $this->get_elemen_data_by_kategori($kategori['id'], $id_data);
				$kategori_data[$key]['elemen_data'] = $elemen_data;

				//get jumlah
				foreach ($elemen_data as $i => $data) {
					$detail_elemen_data = $this->db->get_where('detail_elemen_data', ['id_elemen_data' => $data['id'], 'id_sesi' => $id_sesi, 'id_puskesmas' => $id_puskesmas])->result_array();
					$kategori_data[$key]['elemen_data'][$i]['detail_elemen_data'] = $detail_elemen_data;
				}
			}
			// return var_dump($kategori_data);
			return $kategori_data;
		} else {
			$kategori_data = $this->get_kategori_by_data($id_data);
			foreach ($kategori_data as $key => $kategori) {
				$elemen_data = $this->get_elemen_data_by_kategori($kategori['id'], $id_data);
				$kategori_data[$key]['elemen_data'] = $elemen_data;

				//get jumlah
				foreach ($elemen_data as $i => $data) {
					$data_puskesmas = $this->db->get('puskesmas')->result_array();
					$kategori_data[$key]['elemen_data'][$i]['puskesmas'] = $data_puskesmas;
					foreach ($data_puskesmas as $j => $puskesmas) {
						$detail_elemen_data = $this->db->get_where('detail_elemen_data', ['id_elemen_data' => $data['id'], 'id_sesi' => $id_sesi, 'id_puskesmas' => $puskesmas['id']])->result_array();
						$kategori_data[$key]['elemen_data'][$i]['puskesmas'][$j]['detail_elemen_data'] = $detail_elemen_data;
					}
				}
			}
			return $kategori_data;
		}
	}
	public function get_detail_data_obat($id_sesi, $id_puskesmas = null)
	{
		$data_obat = $this->M_obat->get_obat();
		if ($id_puskesmas != null) {
			foreach ($data_obat as $key => $obat) {
				$detail_obat = $this->db->get_where('data_obat', [
					'id_puskesmas' => $id_puskesmas,
					'id_sesi' => $id_sesi,
					'id_obat' => $obat['id']
				])->row_array();
				$data_obat[$key]['detail'] = $detail_obat;
			}
			return $data_obat;
		} else {
			foreach ($data_obat as $key => $obat) {
				$data_puskesmas = $this->db->get('puskesmas')->result_array();
				$data_obat[$key]['puskesmas'] = $data_puskesmas;
				foreach ($data_puskesmas as $i => $puskesmas) {
					$detail_obat = $this->db->get_where('data_obat', [
						'id_puskesmas' => $puskesmas['id'],
						'id_sesi' => $id_sesi,
						'id_obat' => $obat['id']
					])->row_array();
					$data_obat[$key]['puskesmas'][$i]['detail'] = $detail_obat;
				}
			}
		}
		return $data_obat;
	}


	//PTM
	public function get_ptm()
	{
		$this->db->distinct('sesi.*');
		$this->db->select('sesi.*, tahun.tahun, bulan.nama_bulan');
		$this->db->from('sesi');
		$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
		$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
		return $this->db->get()->result_array();
	}
	public function get_laporan_ptm($id_sesi, $id_puskesmas)
	{
		$data_ptm = $this->db->get_where('data', ['is_ptm' => 1])->result_array();
		foreach ($data_ptm as $i => $ptm) {
			$atribut = $this->db->get('atribut_ptm')->result_array();
			$data_ptm[$i]['atribut'] = $atribut;
			foreach ($atribut as $j => $atr) {
				$usia_ptm = $this->db->get('usia_ptm')->result_array();
				$data_ptm[$i]['atribut'][$j]['usia'] = $usia_ptm;
				foreach ($usia_ptm as $k => $usia) {
					$detail = $this->db->get_where('data_ptm', [
						'id_data' => $ptm['id'],
						'id_atribut' => $atr['id'],
						'id_usia' => $usia['id'],
						'id_sesi' => $id_sesi,
						'id_puskesmas' => $id_puskesmas
					])->row_array();
					$data_ptm[$i]['atribut'][$j]['usia'][$k]['detail'] = $detail;
				}
			}
		}
		return $data_ptm;
	}
	public function get_form_ptm()
	{
		$data_ptm = $this->db->get_where('data', ['is_ptm' => 1])->result_array();
		foreach ($data_ptm as $i => $ptm) {
			$usia_ptm = $this->db->get('usia_ptm')->result_array();
			$data_ptm[$i]['usia'] = $usia_ptm;
		}
		return $data_ptm;
	}



	//DBD FILCA
	public function get_dbdfilca($kondisi = null)
	{
		$this->db->distinct('dbd_filca.*');
		$this->db->select('dbd_filca.*, puskesmas.nama_puskesmas, tahun.tahun, bulan.nama_bulan');
		$this->db->from('dbd_filca');
		$this->db->join('sesi', 'sesi.id = dbd_filca.id_sesi');
		$this->db->join('puskesmas', 'puskesmas.id = dbd_filca.id_puskesmas');
		$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
		$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
		if ($kondisi != null) {
			$this->db->where($kondisi);
		}
		// var_dump($this->db->get()->result_array());
		// die();
		return $this->db->get()->result_array();
	}
	public function get_index_dbdfilca($kondisi = null)
	{
		$this->db->distinct('dbd_filca.id_sesi');
		$this->db->select('dbd_filca.*, puskesmas.nama_puskesmas, tahun.tahun, bulan.nama_bulan');
		$this->db->from('dbd_filca');
		$this->db->join('sesi', 'sesi.id = dbd_filca.id_sesi');
		$this->db->join('puskesmas', 'puskesmas.id = dbd_filca.id_puskesmas');
		$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
		$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
		if ($kondisi != null) {
			$this->db->where($kondisi);
		}
		// var_dump($this->db->get()->result_array());
		// die();
		return $this->db->get()->result_array();
	}

	public function get_usia_dbdfilca()
	{
		return $this->db->get('usia_dbd_filca')->result_array();
	}

	public function get_laporan_dbdfilca($id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas == null) {
			$data_dbdfilca = $this->get_dbdfilca([
				'id_sesi' => $id_sesi,
			]);
			foreach ($data_dbdfilca as $i => $dbdfilca) {
				$this->db->from('detail_dbd_filca');
				$this->db->join('usia_dbd_filca', 'detail_dbd_filca.id_usia_dbd_filca = usia_dbd_filca.id');
				$this->db->where([
					'detail_dbd_filca.id_dbd_filca' => $dbdfilca['id']
				]);
				$this->db->order_by('detail_dbd_filca.id_usia_dbd_filca');
				$data_dbdfilca[$i]['detail'] = $this->db->get()->result_array();
			}
			return $data_dbdfilca;
		} else {
			$this->db->distinct('dbd_filca.*');
			$this->db->select('dbd_filca.*, puskesmas.nama_puskesmas, tahun.tahun, bulan.nama_bulan');
			$this->db->from('dbd_filca');
			$this->db->join('sesi', 'sesi.id = dbd_filca.id_sesi');
			$this->db->join('puskesmas', 'puskesmas.id = dbd_filca.id_puskesmas');
			$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
			$this->db->join('bulan', 'bulan.id = sesi.id_bulan');

			$this->db->where([
				'id_sesi' => $id_sesi,
				'id_puskesmas' => $id_puskesmas
			]);
			$dbdfilca = $this->db->get()->row_array();
			$this->db->from('detail_dbd_filca');
			$this->db->join('usia_dbd_filca', 'detail_dbd_filca.id_usia_dbd_filca = usia_dbd_filca.id');
			$this->db->where([
				'detail_dbd_filca.id_dbd_filca' => $dbdfilca['id']
			]);
			$this->db->order_by('detail_dbd_filca.id_usia_dbd_filca');
			$dbdfilca['detail'] = $this->db->get()->result_array();
			return $dbdfilca;
		}
	}

	//sarana - TTU TPM
	public function get_sarana($id = null)
	{
		$this->db->select('sarana.*, jenis_sarana.nama_jenis');
		$this->db->from('sarana');
		$this->db->join('jenis_sarana', 'jenis_sarana.id = sarana.id_jenis_sarana');
		if ($id == null) {
			$this->db->where('is_deleted', 0);
			return $this->db->get()->result_array();
		} else {
			$this->db->where('id', $id);
			return $this->db->get()->row_array();
		}
	}

	public function get_data_inspeksi($id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$query = "SELECT DISTINCT sesi.*, tahun.tahun, bulan.nama_bulan FROM sesi, bulan, tahun, inspeksi_sarana WHERE sesi.id_tahun = tahun.id AND sesi.id_bulan = bulan.id AND inspeksi_sarana.id_sesi = sesi.id AND inspeksi_sarana.id_puskesmas = '$id_puskesmas'";
			return $this->db->query($query)->result_array();
		} else {
			return null;
		}
	}
	public function get_data_imunisasi($id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$query = "SELECT DISTINCT sesi.*, tahun.tahun, bulan.nama_bulan FROM sesi, bulan, tahun, detail_imunisasi WHERE sesi.id_tahun = tahun.id AND sesi.id_bulan = bulan.id AND detail_imunisasi.id_sesi = sesi.id AND detail_imunisasi.id_puskesmas = '$id_puskesmas'";
			return $this->db->query($query)->result_array();
		} else {
			return null;
		}
	}
	public function get_form_inspeksi()
	{
		$jenis_sarana = $this->db->get('jenis_sarana')->result_array();
		foreach ($jenis_sarana as $i => $jenis) {
			$sarana = $this->db->get_where('sarana', ['id_jenis_sarana' => $jenis['id'], 'is_deleted' => 0])->result_array();
			$jenis_sarana[$i]['sarana'] = $sarana;
		}
		return $jenis_sarana;
	}
	public function get_form_imunisasi()
	{
		$data_imunisasi = $this->db->get('imunisasi')->result_array();
		return $data_imunisasi;
	}
	public function get_detail_imunisasi($id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$this->db->from('detail_imunisasi');
			$this->db->join('imunisasi', 'imunisasi.id = detail_imunisasi.id_imunisasi');
			$this->db->where([
				'id_sesi' => $id_sesi,
				'id_puskesmas' => $id_puskesmas,
			]);
			$data_imunisasi = $this->db->get()->result_array();
			return $data_imunisasi;
		} else {
			$data_puskesmas = $this->db->get('puskesmas')->result_array();
			foreach ($data_puskesmas as $i => $puskesmas) {
				$data_imunisasi = $this->db->get('imunisasi')->result_array();
				$data_puskesmas[$i]['data_imunisasi'] = $data_imunisasi;
				foreach ($data_imunisasi as $j => $imunisasi) {
					$this->db->from('detail_imunisasi');
					$this->db->join('imunisasi', 'imunisasi.id = detail_imunisasi.id_imunisasi');
					$this->db->where([
						'id_sesi' => $id_sesi,
						'id_puskesmas' => $puskesmas['id'],
						'id_imunisasi' => $imunisasi['id']
					]);
					$detail = $this->db->get()->row_array();
					$data_puskesmas[$i]['data_imunisasi'][$j][$detail] = $data_imunisasi;
				}
			}
			return $data_puskesmas;
		}
	}
	public function get_detail_inspeksi($id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$inspeksi_sarana = $this->db->get_where('inspeksi_sarana', [
				'id_sesi' => $id_sesi,
				'id_puskesmas' => $id_puskesmas
			])->row_array();
			$jenis_sarana = $this->db->get('jenis_sarana')->result_array();
			foreach ($jenis_sarana as $i => $jenis) {
				$data_sarana = $this->db->get_where('sarana', [
					'id_jenis_sarana' => $jenis['id'],
					'is_deleted' => 0
				])->result_array();
				$jenis_sarana[$i]['sarana'] = $data_sarana;
				foreach ($data_sarana as $j => $sarana) {
					$atribut_inspeksi = $this->db->get('atribut_inspeksi_sarana')->result_array();
					$jenis_sarana[$i]['sarana'][$j]['atribut'] = $atribut_inspeksi;
					foreach ($atribut_inspeksi as $k => $atribut) {
						$detail = $this->db->get_where('inspeksi_sarana_detail', [
							'id_inspeksi_sarana' => $inspeksi_sarana['id'],
							'id_sarana' => $sarana['id'],
							'id_atribut_inspeksi_sarana' => $atribut['id'],
						])->row_array();
						$jenis_sarana[$i]['sarana'][$j]['atribut'][$k]['detail'] = $detail;
					}
				}
				$inspeksi_sarana['jenis_sarana'] = $jenis_sarana;
			}
			return $inspeksi_sarana;
		} else {
			$data_puskesmas = $this->db->get('puskesmas')->result_array();
			$inspeksi_sarana['puskesmas'] = $data_puskesmas;
			foreach ($data_puskesmas as $i => $puskesmas) {
				$data_inspeksi = $this->db->get_where('inspeksi_sarana', [
					'id_sesi' => $id_sesi,
					'id_puskesmas' => $puskesmas['id']
				])->row_array();
				$inspeksi_sarana['puskesmas'][$i]['inspeksi'] = $data_inspeksi;
			}
			$jenis_sarana = $this->db->get('jenis_sarana')->result_array();
			foreach ($jenis_sarana as $i => $jenis) {
				$data_sarana = $this->db->get_where('sarana', [
					'id_jenis_sarana' => $jenis['id'],
					'is_deleted' => 0
				])->result_array();
				$jenis_sarana[$i]['sarana'] = $data_sarana;
				foreach ($data_sarana as $j => $sarana) {
					$atribut_inspeksi = $this->db->get('atribut_inspeksi_sarana')->result_array();
					$jenis_sarana[$i]['sarana'][$j]['atribut'] = $atribut_inspeksi;
					foreach ($atribut_inspeksi as $k => $atribut) {
						$jenis_sarana[$i]['sarana'][$j]['atribut'][$k]['puskesmas'] = $data_puskesmas;
						foreach ($data_puskesmas as $l => $puskesmas) {
							$data_inspeksi = $this->db->get_where('inspeksi_sarana', [
								'id_sesi' => $id_sesi,
								'id_puskesmas' => $puskesmas['id']
							])->row_array();
							if ($data_inspeksi != null) {
								$detail = $this->db->get_where('inspeksi_sarana_detail', [
									'id_inspeksi_sarana' => $data_inspeksi['id'],
									'id_sarana' => $sarana['id'],
									'id_atribut_inspeksi_sarana' => $atribut['id'],
								])->row_array();
								$jenis_sarana[$i]['sarana'][$j]['atribut'][$k]['puskesmas'][$l]['detail'] = $detail;
							} else {
								$jenis_sarana[$i]['sarana'][$j]['atribut'][$k]['puskesmas'][$l]['detail'] = null;
							}
						}
					}

					// $jenis_sarana[$i]['sarana'][$j]['atribut'] = $atribut_inspeksi;
				}
				$inspeksi_sarana['jenis_sarana'] = $jenis_sarana;
			}
			return $inspeksi_sarana;
		}
	}

	public function get_stp($id_puskesmas = null)
	{
		$this->db->distinct('sesi.*');
		$this->db->select('sesi.*, tahun.tahun, bulan.nama_bulan');
		$this->db->from('sesi');
		$this->db->join('detail_elemen_data_usia', 'detail_elemen_data_usia.id_sesi = sesi.id');
		$this->db->join('elemen_data_usia', 'elemen_data_usia.id = detail_elemen_data_usia.id_elemen_data_usia');
		$this->db->join('data', 'data.id = elemen_data_usia.id_data');
		$this->db->join('tahun', 'tahun.id = sesi.id_tahun');
		$this->db->join('bulan', 'bulan.id = sesi.id_bulan');
		$this->db->where('data.is_stp', 1);
		if ($id_puskesmas != null) {
			$this->db->where('id_puskesmas', $id_puskesmas);
		}
		return $this->db->get()->result_array();
	}
	public function get_detail_stp($id_sesi, $id_puskesmas)
	{
		$data_stp = $this->db->get_where('data', ['is_stp' => 1])->result_array();
		foreach ($data_stp as $i => $stp) {
			$elemen_data_usia = $this->db->get_where('elemen_data_usia', ['id_data' => $stp['id']])->result_array();
			$data_stp[$i]['elemen_data_usia'] = $elemen_data_usia;
			foreach ($elemen_data_usia as $j => $elemen) {
				$this->db->select_sum('detail_elemen_data_usia.jumlah');
				$this->db->from('detail_elemen_data_usia');
				$this->db->join('atribut_data', 'atribut_data.id = detail_elemen_data_usia.id_atribut_data');
				$this->db->join('atribut', 'atribut.id = atribut_data.id_atribut');
				$this->db->where('atribut.kategori_atribut', 'L');
				$this->db->where('detail_elemen_data_usia.id_puskesmas', $id_puskesmas);
				$this->db->where('detail_elemen_data_usia.id_sesi', $id_sesi);
				$this->db->where('detail_elemen_data_usia.id_elemen_data_usia', $elemen['id']);
				$l = $this->db->get()->row_array;
				$this->db->select_sum('detail_elemen_data_usia.jumlah');
				$this->db->from('detail_elemen_data_usia');
				$this->db->join('atribut_data', 'atribut_data.id = detail_elemen_data_usia.id_atribut_data');
				$this->db->join('atribut', 'atribut.id = atribut_data.id_atribut');
				$this->db->where('atribut.kategori_atribut', 'P');
				$this->db->where('detail_elemen_data_usia.id_puskesmas', $id_puskesmas);
				$this->db->where('detail_elemen_data_usia.id_sesi', $id_sesi);
				$this->db->where('detail_elemen_data_usia.id_elemen_data_usia', $elemen['id']);
				$p = $this->db->get()->row_array;
				$data_stp[$i]['elemen_data_usia'][$j]['l'] = $l['jumlah'];
				$data_stp[$i]['elemen_data_usia'][$j]['p'] = $p['jumlah'];
			}
		}
		return $data_stp;
	}

	public function get_form_stp()
	{
		$list_data = $this->db->get_where('data', [
			'is_deleted' => 0,
			'is_stp' => 1,
			'id_induk_penyakit' => 'is null',
			'punya_elemen_data' => 0
		])->result_array();
		// var_dump($list_data);
		// die();
		foreach ($list_data as $key => $data) {
			$this->db->from('atribut_data');
			$this->db->join('atribut', 'atribut.id = atribut_data.id_atribut');
			$this->db->where(['id_data' => $data['id']]);
			$atribut_data = $this->db->get()->result_array();
			$list_data[$key]['atribut'] = $atribut_data;
			$this->db->select('elemen_data_usia.*, usia.rentang_usia');
			$this->db->from('elemen_data_usia');
			$this->db->join('usia', 'usia.id = elemen_data_usia.id_usia');
			$this->db->where('elemen_data_usia.id_data', $data['id']);
			$elemen_usia = $this->db->get()->result_array();
			$list_data[$key]['elemen_usia'] = $elemen_usia;
		}
		return $list_data;
	}

	public function get_laporan_stp($id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$data_stp = $this->db->get_where('data', ['is_stp' => 1])->result_array();
			foreach ($data_stp as $i => $stp) {
				$data_usia = $this->db->get_where('usia', ['stp' => 1])->result_array();
				$id_stp = $stp['id'];
				$data_stp[$i]['usia'] = $data_usia;
				foreach ($data_usia as $j => $usia) {
					$id_usia = $usia['id'];
					//Laki-Laki
					$query = "SELECT sum(detail_elemen_data_usia.jumlah) as jumlah from elemen_data_usia, detail_elemen_data_usia, atribut WHERE elemen_data_usia.id_data = '$id_stp' AND elemen_data_usia.id = detail_elemen_data_usia.id_elemen_data_usia AND detail_elemen_data_usia.id_sesi = '$id_sesi' AND detail_elemen_data_usia.id_atribut_data = atribut.id AND atribut.kategori_atribut = 'L' AND detail_elemen_data_usia.id_puskesmas = '$id_puskesmas' AND elemen_data_usia.id_usia = '$id_usia' GROUP by detail_elemen_data_usia.id_atribut_data";
					$l = $this->db->query($query)->row_array();
					if (!empty($l)) {
						$data_stp[$i]['usia'][$j]['l'] = $l['jumlah'];
					} else {
						$data_stp[$i]['usia'][$j]['l'] = null;
					}


					//P
					$query = "SELECT sum(detail_elemen_data_usia.jumlah) as jumlah from elemen_data_usia, detail_elemen_data_usia, atribut WHERE elemen_data_usia.id_data = '$id_stp' AND elemen_data_usia.id = detail_elemen_data_usia.id_elemen_data_usia AND detail_elemen_data_usia.id_sesi = '$id_sesi' AND detail_elemen_data_usia.id_atribut_data = atribut.id AND atribut.kategori_atribut = 'P' AND detail_elemen_data_usia.id_puskesmas = '$id_puskesmas' AND elemen_data_usia.id_usia = '$id_usia' GROUP by detail_elemen_data_usia.id_atribut_data";
					$p = $this->db->query($query)->row_array();
					if (!empty($l)) {
						$data_stp[$i]['usia'][$j]['p'] = $p['jumlah'];
					} else {
						$data_stp[$i]['usia'][$j]['p'] = null;
					}
				}
			}
			return $data_stp;
		}
	}

	//PKP
	public function get_data_pkp($id_puskesmas = null)
	{
		if ($id_puskesmas == null) {
			$query = "SELECT DISTINCT sesi.*, tahun.tahun, bulan.nama_bulan FROM sesi, bulan, tahun, pkp WHERE sesi.id_tahun = tahun.id AND sesi.id_bulan = bulan.id AND pkp.id_sesi = sesi.id";
		} else {
			$query = "SELECT DISTINCT sesi.*, tahun.tahun, bulan.nama_bulan FROM sesi, bulan, tahun, pkp, detail_pkp WHERE sesi.id_tahun = tahun.id AND sesi.id_bulan = bulan.id AND pkp.id_sesi = sesi.id AND pkp.id = detail_pkp.id_pkp AND detail_pkp.id_puskesmas = '$id_puskesmas'";
		}
		return $this->db->query($query)->result_array();
	}
	public function get_jenis_kegiatan($id_puskesmas = null, $id_sesi = null)
	{
		if ($id_puskesmas == null) {
			$jenis_kegiatan = $this->db->get('jenis_kegiatan')->result_array();
			foreach ($jenis_kegiatan as $i => $jenis) {
				$this->db->from('kegiatan');
				$this->db->where('id_jenis_kegiatan', $jenis['id']);
				// $this->db->order_by('id');
				$this->db->order_by('kelompok_kegiatan');
				$kegiatan = $this->db->get()->result_array();
				$jenis_kegiatan[$i]['kegiatan'] = $kegiatan;
				foreach ($kegiatan as $j => $keg) {
					$pkp = $this->db->get_where('pkp', ['id_sesi' => $id_sesi, 'id_kegiatan' => $keg['id']])->row_array();
					$jenis_kegiatan[$i]['kegiatan'][$j]['pkp'] = $pkp;
				}
			}
			// var_dump($jenis_kegiatan);
			// die();
			return $jenis_kegiatan;
		} else {
			$jenis_kegiatan = $this->db->get('jenis_kegiatan')->result_array();
			foreach ($jenis_kegiatan as $i => $jenis) {
				$this->db->from('kegiatan');
				$this->db->where('id_jenis_kegiatan', $jenis['id']);
				$this->db->order_by('id');
				$this->db->group_by('kelompok_kegiatan');
				$kegiatan = $this->db->get()->result_array();
				$jenis_kegiatan[$i]['kegiatan'] = $kegiatan;
				foreach ($kegiatan as $j => $keg) {
					$query = "SELECT detail_pkp.* from detail_pkp, pkp WHERE detail_pkp.id_pkp = pkp.id AND pkp.id_sesi = '$id_sesi' AND detail_pkp.id_puskesmas = '$id_puskesmas' AND pkp.id_kegiatan = " . $keg['id'];
					$detail = $this->db->query($query)->row_array();
					$jenis_kegiatan[$i]['kegiatan'][$j]['abs'] = $detail['abs'];
					$jenis_kegiatan[$i]['kegiatan'][$j]['kom'] = $detail['kom'];
					$jenis_kegiatan[$i]['kegiatan'][$j]['id_pkp'] = $detail['id_pkp'];
				}
			}
		}
	}
	public function get_detail_pkp($id_sesi, $id_puskesmas = null)
	{
		if ($id_puskesmas != null) {
			$jenis_kegiatan = $this->db->get('jenis_kegiatan')->result_array();
			foreach ($jenis_kegiatan as $i => $jenis) {
				$kegiatan = $this->db->get_where('kegiatan', ['id_jenis_kegiatan' => $jenis['id']])->result_array();
				$jenis_kegiatan[$i]['kegiatan'] = $kegiatan;
				foreach ($kegiatan as $j => $keg) {


					$query = "SELECT detail_pkp.* from detail_pkp, pkp WHERE detail_pkp.id_pkp = pkp.id AND pkp.id_sesi = '$id_sesi' AND detail_pkp.id_puskesmas = '$id_puskesmas' AND pkp.id_kegiatan = " . $keg['id'];
					$detail = $this->db->query($query)->row_array();

					if (!empty($detail)) {
						$jenis_kegiatan[$i]['kegiatan'][$j]['abs'] = $detail['abs'];
						$jenis_kegiatan[$i]['kegiatan'][$j]['kom'] = $detail['kom'];
						$jenis_kegiatan[$i]['kegiatan'][$j]['id_pkp'] = $detail['id_pkp'];
					} else {
						$jenis_kegiatan[$i]['kegiatan'][$j]['abs'] = '-';
						$jenis_kegiatan[$i]['kegiatan'][$j]['kom'] = '-';
						$jenis_kegiatan[$i]['kegiatan'][$j]['id_pkp'] = '-';
					}
					$pkp = $this->db->get_where('pkp', ['id_sesi' => $id_sesi, 'id_kegiatan' => $keg['id']])->row_array();
					$jenis_kegiatan[$i]['kegiatan'][$j]['pkp'] = $pkp;
				}
			}
			return $jenis_kegiatan;
		} else {
			$jenis_kegiatan = $this->db->get('jenis_kegiatan')->result_array();
			foreach ($jenis_kegiatan as $i => $jenis) {
				$kegiatan = $this->db->get_where('kegiatan', ['id_jenis_kegiatan' => $jenis['id']])->result_array();
				$jenis_kegiatan[$i]['kegiatan'] = $kegiatan;
				foreach ($kegiatan as $j => $keg) {
					$data_puskesmas = $this->db->get('puskesmas')->result_array();
					$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'] = $data_puskesmas;
					foreach ($data_puskesmas as $k => $puskesmas) {
						$query = "SELECT detail_pkp.* from detail_pkp, pkp WHERE detail_pkp.id_pkp = pkp.id AND pkp.id_sesi = '$id_sesi' AND detail_pkp.id_puskesmas = " . $puskesmas['id'] . " AND pkp.id_kegiatan = " . $keg['id'];
						$detail = $this->db->query($query)->row_array();
						if (!empty($detail)) {
							$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'][$k]['abs'] = $detail['abs'];
							$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'][$k]['kom'] = $detail['kom'];
							$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'][$k]['id_pkp'] = $detail['id_pkp'];
						} else {
							$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'][$k]['abs'] = null;
							$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'][$k]['kom'] = null;
							$jenis_kegiatan[$i]['kegiatan'][$j]['puskesmas'][$k]['id_pkp'] = null;
						}
					}
					$pkp = $this->db->get_where('pkp', ['id_sesi' => $id_sesi, 'id_kegiatan' => $keg['id']])->row_array();
					$jenis_kegiatan[$i]['kegiatan'][$j]['pkp'] = $pkp;
				}
			}
			return $jenis_kegiatan;
		}
	}

	//TB Program
	public function get_data_tbprogram()
	{
		$this->db->from('tb_program');
		$this->db->order_by('tahun_mulai', 'desc');
		$this->db->order_by('bulan_mulai', 'desc');
		$this->db->order_by('tanggal_mulai', 'desc');
		$data_tb = $this->db->get()->result_array();
		return $data_tb;
	}
	public function get_laporan_tbprogram($id_sesi, $id_puskesmas = null)
	{
		$sesi = $this->get_sesi($id_sesi);
		$this->db->from('tb_program');
		if ($id_puskesmas != null) {
			$this->db->where('id_puskesmas', $id_puskesmas);
		}
		$this->db->where([
			'bulan_mulai <= ' => $sesi['angka_bulan'],
			'tahun_mulai <= ' => $sesi['tahun'],
			'bulan_selesai >=' => $sesi['angka_bulan'],
			'tahun_selesai >=' => $sesi['tahun']
		]);
		$this->db->or_where('tanggal_selesai', null);

		$data_tbprogram = $this->db->get()->result_array();
		// var_dump($data_tbprogram);
		// die();
		return $data_tbprogram;
	}
}
