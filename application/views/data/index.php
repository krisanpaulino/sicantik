<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>judul</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">judul</li>
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
					<!-- jquery validation -->
					<div class="card card-white">

						<!-- /.card-header -->
						<div class="row">
							<div class="col-lg">
								<?= form_error('nama_kabupaten_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= form_error('jenis', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= $this->session->flashdata('message'); ?>



								<div class="card-body">
									<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#datakabModal">Tambah Data Umum</a>

									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Nama</th>
												<th scope="col">STP</th>
												<th scope="col">PTM</th>
												<th scope="col" class="text-center">Elemen Data</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($data as $k) : ?>

												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $k['nama_data']; ?></td>
													<td><?= $k['is_stp']; ?></td>
													<td><?= $k['is_ptm']; ?></td>
													<td class="text-center">
														<?php if ($k['punya_elemen_data'] == 1) : ?>
															<a href="<?= base_url() ?>adm/data/elemen/<?= $k['id'] ?>" class="badge badge-primary">Tambah Elemen</a>|
														<?php endif; ?> <?php if ($k['punya_elemen_usia'] == 1) : ?>
															<a href="<?= base_url() ?>adm/data/elemen_usia/<?= $k['id'] ?>" class="badge badge-primary">Tambah Elemen Usia</a> |
														<?php endif; ?>
														<a href="<?= base_url() ?>adm/data/atribut/<?= $k['id'] ?>" class="badge badge-info">Tambah Atribut</a>
													</td>

													<td>
														<a href="<?= base_url() ?>admin/edit_kategori/" class="badge badge-success" data-toggle="modal" data-target="#update<?= $k['id'] ?>">edit</a>
														<a href="<?= base_url() ?>admin/deletekategori/" class="badge badge-danger" onclick="return confirm('yakin ingin menghapus?')">hapus</a>
													</td>
												</tr>
												<?php $i++; ?>

											<?php endforeach; ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>
				<div class="modal fade " id="datakabModal" tabindex="-1" role="dialog" aria-labelledby="datakabModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg " role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="datakabModalLabel">Input Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('adm/data/input'); ?>" method="post">
								<div class="modal-body">
									<div class="form-group">
										<label class="">Nama </label>
										<input type="text" class="form-control" id="nama_data" name="nama_data">
										<?= form_error('nama_data', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="kategori">Kategori Data</label>
										<select name="kategori" class="custom-select" required>
											<option value="penyakit">Penyakit</option>
											<option value="bukan penyakit">Bukan Penyakit</option>
										</select>
									</div>
									<label for="">STP</label>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="is_stp" id="" class="form-check-inpu" value="1">
											<label for="is_stp" class="form-check-label"> Ada </label>
										</div>
									</div>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="is_stp" id="" class="form-check-inpu" value="0">
											<label for="is_stp" class="form-check-label"> Tidak Ada </label>
										</div>
									</div> <br>
									<label for="">Punya Elemen Data</label>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="punya_elemen_data" id="" class="form-check-inpu" value="1">
											<label for="punya_elemen_data" class="form-check-label"> Ada </label>
										</div>
									</div>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="punya_elemen_data" id="" class="form-check-inpu" value="0">
											<label for="punya_elemen_data" class="form-check-label"> Tidak Ada </label>
										</div>
									</div> <br>
									<label for="">Punya Elemen Usia?</label>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="punya_elemen_usia" id="" class="form-check-inpu" value="1">
											<label for="punya_elemen_usia" class="form-check-label"> Ada </label>
										</div>
									</div>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="punya_elemen_usia" id="" class="form-check-inpu" value="0">
											<label for="punya_elemen_usia" class="form-check-label"> Tidak Ada </label>
										</div>
									</div> <br>
									<label for="">Masuk Dalam Penyakit Tidak Menular ?</label>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="is_ptm" id="" class="form-check-inpu" value="1">
											<label for="is_ptm" class="form-check-label"> Ada </label>
										</div>
									</div>
									<div class="form-check">
										<div class="col-sm-10">
											<input type="radio" name="is_ptm" id="" class="form-check-inpu" value="0">
											<label for="is_ptm" class="form-check-label"> Tidak Ada </label>
										</div>
									</div> <br>
									<div class="form-group">
										<label for="id_induk_penuakit">Induk Penyakit</label>
										<select name="id_induk_penyakit" id="" class="custom-select">
											<option value="">Pilih Induk Penyakit (Jika Ada)</option>
											<?php foreach ($data as $d) : ?>
												<option value="<?= $d['id'] ?>"><?= $d['nama_data'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php foreach ($data as $k) : ?>
					<div class="modal fade " id="update<?= $k['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="update<?= $k['id'] ?>Label" aria-hidden="true">
						<div class="modal-dialog modal-lg " role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="update<?= $k['id'] ?>Label">Input Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url('adm/data/update'); ?>" method="post">
									<input type="hidden" name="id" value="<?= $k['id'] ?>">
									<div class="modal-body">
										<div class="form-group">
											<label class="">Nama </label>
											<input type="text" class="form-control" id="nama_data" name="nama_data" value="<?= $k['nama_data'] ?>">
											<?= form_error('nama_data', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="kategori">Kategori Data</label>
											<select name="kategori" class="custom-select" required>
												<option value="penyakit" <?= ($k['kategori_data'] == 'penyakit') ? 'selected' : '' ?>>Penyakit</option>
												<option value="bukan penyakit" <?= ($k['kategori_data'] == 'bukan penyakit') ? 'selected' : '' ?>>Bukan Penyakit</option>
											</select>
										</div>
										<label for="">STP</label>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="is_stp" id="" class="form-check-inpu" value="1" <?= ($k['is_stp'] == 1) ? 'checked' : '' ?>>
												<label for="is_stp" class="form-check-label"> Ada </label>
											</div>
										</div>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="is_stp" id="" class="form-check-inpu" value="0" <?= ($k['is_stp'] == 0) ? 'checked' : '' ?>>
												<label for="is_stp" class="form-check-label"> Tidak Ada </label>
											</div>
										</div> <br>
										<label for="">Punya Elemen Data</label>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="punya_elemen_data" id="" class="form-check-inpu" value="1" <?= ($k['punya_elemen_data'] == 1) ? 'checked' : '' ?>>
												<label for="punya_elemen_data" class="form-check-label"> Ada </label>
											</div>
										</div>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="punya_elemen_data" id="" class="form-check-inpu" value="0" <?= ($k['punya_elemen_data'] == 0) ? 'checked' : '' ?>>
												<label for="punya_elemen_data" class="form-check-label"> Tidak Ada </label>
											</div>
										</div> <br>
										<label for="">Punya Elemen Usia?</label>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="punya_elemen_usia" id="" class="form-check-inpu" value="1" <?= ($k['punya_elemen_usia'] == 1) ? 'checked' : '' ?>>
												<label for="punya_elemen_usia" class="form-check-label"> Ada </label>
											</div>
										</div>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="punya_elemen_usia" id="" class="form-check-inpu" value="0" <?= ($k['punya_elemen_usia'] == 0) ? 'checked' : '' ?>>
												<label for="punya_elemen_usia" class="form-check-label"> Tidak Ada </label>
											</div>
										</div> <br>
										<label for="">Masuk Dalam Penyakit Tidak Menular ?</label>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="is_ptm" id="" class="form-check-inpu" value="1" <?= ($k['is_ptm'] == 1) ? 'checked' : '' ?>>
												<label for="is_ptm" class="form-check-label"> Ada </label>
											</div>
										</div>
										<div class="form-check">
											<div class="col-sm-10">
												<input type="radio" name="is_ptm" id="" class="form-check-inpu" value="0" <?= ($k['is_ptm'] == 0) ? 'checked' : '' ?>>
												<label for="is_ptm" class="form-check-label"> Tidak Ada </label>
											</div>
										</div> <br>
										<div class="form-group">
											<label for="id_induk_penuakit">Induk Penyakit</label>
											<select name="id_induk_penyakit" id="" class="custom-select">
												<option value="">Pilih Induk Penyakit (Jika Ada)</option>
												<?php foreach ($data as $d) : ?>
													<option value="<?= $d['id'] ?>" <?= ($d['id'] == $k['id_induk_penyakit']) ? 'selected' : '' ?>><?= $d['nama_data'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

				<!--/.col (left) -->
				<!-- right column -->
				<div class="col-md-6">

				</div>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
