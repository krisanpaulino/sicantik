<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $judul ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#inputModal">
						+ Input Pasien Baru
					</button>
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered" id="dtable1">
								<thead>
									<tr>
										<th>Nama Pasien</th>
										<th>Tgl Mulai Pengobatan</th>
										<th>Jenis</th>
										<th>Tipe</th>
										<th>Tgl Selesai Berobat</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_tbprogram as $data) : ?>
										<tr>
											<td><?= $data['nama_pasien'] ?></td>
											<td><?= $data['tanggal_mulai'] ?>/<?= $data['bulan_mulai'] ?>/<?= $data['tahun_mulai'] ?></td>
											<td><?= $data['jenis_tb'] ?></td>
											<td><?= $data['tipe_tb'] ?></td>
											<td><?= $data['tanggal_selesai'] ?>/<?= $data['bulan_selesai'] ?>/<?= $data['tahun_selesai'] ?></td>
											<td><?= $data['status'] ?></td>
											<td>
												Lihat Detail | <button type="button" class="badge badge-success" data-toggle="modal" data-target="#update<?= $data['id'] ?>">
													update data
												</button>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
				<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="inputModalLabel">INPUT PASIEN BARU</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url() ?>operator/store_tbprogram" method="post">
								<div class="modal-body">
									<div class="form-group">
										<label for="">Nama Pasien</label>
										<input type="text" name="nama_pasien" id="" class="form-control">
									</div>
									<div class="form-group">
										<select name="jk_pasien" id="" class="custom-select" required>
											<option value="">Pilih</option>
											<option value="L">Laki - Laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Umur Pasien</label>
										<input type="number" name="umur_pasien" id="" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Alamat Pasien</label>
										<input type="text" name="alamat_pasien" id="" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Tanggal Mulai Berobat</label>
										<input type="number" name="tanggal_mulai" id="" class="form-control" placeholder="Tanggal">
										<input type="number" name="bulan_mulai" id="" class="form-control" placeholder="Bulan">
										<input type="number" name="tahun_mulai" id="" class="form-control" placeholder="Tahun">
									</div>
									<div class="form-group">
										<label for="">Jenis TB</label>
										<select name="jenis_tb" id="" class="custom-select">
											<option value="Paru">Paru</option>
											<option value="Ekstra Paru">Ekstra Paru</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Tipe Pasien</label>
										<select name="tipe_tb" id="" class="custom-select">
											<option value="Baru">Baru</option>
											<option value="Kambuh">Kambuh</option>
											<option value="Pindahan">Pindahan</option>
											<option value="DO">DO</option>
											<option value="Gagal">Gagal</option>
											<option value="Lain-lain">Lain-lain</option>
										</select>
									</div>

									<div class="form-group">
										<label for="">Hasil Pemeriksaan HIV</label>
										<select name="hasil_hiv" id="" class="custom-select">
											<option value="Tidak Ada">Tidak Ada</option>
											<option value="Ada">Ada</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Hasil Pemeriksaan Lab Awal</label>
										<select name="lab_awal" id="" class="custom-select">
											<option value="Tidak Ada">Tidak Ada</option>
											<option value="Ada">Ada</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Input Data</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php foreach ($data_tbprogram as $data) : ?>
					<div class="modal fade" id="update<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="inputModalLabel">Update Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url() ?>operator/update_tbprogram" method="post">
									<input type="hidden" name="id" value="<?= $data['id'] ?>">
									<div class="modal-body">
										<div class="form-group">
											<label for="">Nama Pasien</label>
											<input type="text" name="nama_pasien" id="" class="form-control" value="<?= $data['nama_pasien'] ?>" disabled>
										</div>
										<div class="form-group">
											<label for="">Umur Pasien</label>
											<input type="number" name="umur_pasien" id="" class="form-control" value="<?= $data['umur_pasien'] ?>" disabled>
										</div>
										<div class="form-group">
											<label for="">Alamat Pasien</label>
											<input type="text" name="alamat_pasien" id="" class="form-control" value="<?= $data['alamat_pasien'] ?>">
										</div>
										<div class="form-group">
											<label for="">Tanggal Mulai Berobat</label>
											<input type="number" name="tanggal_mulai" id="" class="form-control" placeholder="Tanggal" value="<?= $data['tanggal_mulai'] ?>" disabled>
											<input type="number" name="bulan_mulai" id="" class="form-control" placeholder="Bulan" value="<?= $data['bulan_mulai'] ?>" disabled>
											<input type="number" name="tahun_mulai" id="" class="form-control" placeholder="Tahun" value="<?= $data['tahun_mulai'] ?>" disabled>
										</div>
										<div class="form-group">
											<label for="">Jenis TB</label>
											<select name="jenis_tb" id="" class="custom-select">
												<option value="Paru" <?= ($data['jenis_tb'] == "Paru") ? 'selected' : '' ?>>Paru</option>
												<option value="Ekstra Paru" <?= ($data['jenis_tb'] == "Ekstra Paru") ? 'selected' : '' ?>>Ekstra Paru</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Tipe Pasien</label>
											<select name="tipe_tb" id="" class="custom-select">
												<option value="Baru" <?= ($data['tipe_tb'] == "Baru") ? 'selected' : '' ?>>Baru</option>
												<option value="Kambuh" <?= ($data['tipe_tb'] == "Kambuh") ? 'selected' : '' ?>>Kambuh</option>
												<option value="Pindahan" <?= ($data['tipe_tb'] == "Pindahan") ? 'selected' : '' ?>>Pindahan</option>
												<option value="DO" <?= ($data['tipe_tb'] == "DO") ? 'selected' : '' ?>>DO</option>
												<option value="Gagal" <?= ($data['tipe_tb'] == "Gagal") ? 'selected' : '' ?>>Gagal</option>
												<option value="Lain-lain" <?= ($data['tipe_tb'] == "Lain-lain") ? 'selected' : '' ?>>Lain-lain</option>
											</select>
										</div>

										<div class="form-group">
											<label for="">Hasil Pemeriksaan HIV</label>
											<select name="hasil_hiv" id="" class="custom-select">
												<option value="Tidak Ada" <?= ($data['hasil_hiv'] == "Tidak Ada") ? 'selected' : '' ?>>Tidak Ada</option>
												<option value="Ada" <?= ($data['hasil_hiv'] == "Ada") ? 'selected' : '' ?>>Ada</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Hasil Pemeriksaan Lab Awal</label>
											<select name="lab_awal" id="" class="custom-select">
												<option value="">Pilih</option>
												<option value="Tidak Ada" <?= ($data['lab_awal'] == "Tidak Ada") ? 'selected' : '' ?>>Tidak Ada</option>
												<option value="Ada" <?= ($data['lab_awal'] == "Ada") ? 'selected' : '' ?>>Ada</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Hasil Pemeriksaan Bulan Ke-2/3</label>
											<select name="lab_2" id="" class="custom-select">
												<option value="">Pilih</option>
												<option value="Tidak Ada" <?= ($data['lab_2'] == "Tidak Ada") ? 'selected' : '' ?>>Tidak Ada</option>
												<option value="Ada" <?= ($data['lab_2'] == "Ada") ? 'selected' : '' ?>>Ada</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Hasil Pemeriksaan Bulan Ke-5/6</label>
											<select name="lab_3" id="" class="custom-select">
												<option value="">Pilih</option>
												<option value="Tidak Ada" <?= ($data['lab_3'] == "Tidak Ada") ? 'selected' : '' ?>>Tidak Ada</option>
												<option value="Ada" <?= ($data['lab_3'] == "Ada") ? 'selected' : '' ?>>Ada</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Hasil Pemeriksaan AP</label>
											<select name="lab_ap" id="" class="custom-select">
												<option value="">Pilih</option>
												<option value="Tidak Ada" <?= ($data['lab_ap'] == "Tidak Ada") ? 'selected' : '' ?>>Tidak Ada</option>
												<option value="Ada" <?= ($data['lab_ap'] == "Ada") ? 'selected' : '' ?>>Ada</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Tanggal Selesai Berobat</label>
											<input type="number" name="tanggal_selesai" id="" class="form-control" placeholder="Tanggal" value="<?= $data['tanggal_selesai'] ?>">
											<input type="number" name="bulan_selesai" id="" class="form-control" placeholder="Bulan" value="<?= $data['bulan_selesai'] ?>">
											<input type="number" name="tahun_selesai" id="" class="form-control" placeholder="Tahun" value="<?= $data['tahun_selesai'] ?>">
										</div>
										<div class="form-group">
											<label for="">Status</label>
											<select name="status" id="" class="custom-select">
												<option value="">Pilih</option>
												<option value="Sembuh" <?= ($data['status'] == "Sembuh") ? 'selected' : '' ?>>Sembuh</option>
												<option value="PL" <?= ($data['status'] == "PL") ? 'selected' : '' ?>>PL</option>
												<option value="Meninggal" <?= ($data['status'] == "Meninggal") ? 'selected' : '' ?>>Meninggal</option>
												<option value="DO" <?= ($data['status'] == "DO") ? 'selected' : '' ?>>DO</option>
												<option value="Pindah" <?= ($data['status'] == "Pindah") ? 'selected' : '' ?>>Pindah</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update Data</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
