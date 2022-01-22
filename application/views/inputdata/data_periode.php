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
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?= $judul ?></li>
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
				<div class="col-md-8">
					<!-- jquery validation -->
					<div class="card card-white">

						<!-- /.card-header -->
						<div class="row">
							<div class="col-lg">
								<?= form_error('id_tahun', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= form_error('id_bulan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= $this->session->flashdata('message'); ?>
								<div class="card-body">
									<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPeriode">Tambah Data Periode</a>

									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col">Tahun</th>
												<th scope="col">Bulan</th>
												<th scope="col">Status</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($sesi as $s) : ?>
												<tr>
													<td><?= $s['tahun'] ?></td>
													<td><?= $s['nama_bulan'] ?></td>
													<td><?= ($s['is_open'] == 1) ? 'Open' : 'Closed' ?></td>
													<?php if ($s['is_open'] == 0) : ?>
														<td>
															<form action="<?= base_url() ?>admin/open_sesi" method="post">
																<input type="hidden" name="id_sesi" value="<?= $s['id'] ?>">
																<input type="submit" value="Buka Sesi" class="btn btn-success">
															</form>
														</td>
													<?php else : ?>
														<td>
															<form action="<?= base_url() ?>admin/close_sesi" method="post">
																<input type="hidden" name="id_sesi" value="<?= $s['id'] ?>">
																<input type="submit" value="Tutup Sesi" class="btn btn-danger">
															</form>
														</td>
													<?php endif; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>
					<!-- /.card -->
				</div>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-header">

							<b>Data Tahun</b>
							<div class="d-flex justify-content-end">
								<button class="badge badge-success" data-toggle="modal" data-target="#tambahtahun">+</button>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-borderless">
								<thead>
									<tr>
										<th>Tahun</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_tahun as $tahun) : ?>
										<form action="<?= base_url() ?>admin/nonaktifkan_tahun" method="post">
											<input type="hidden" name="id" value="<?= $tahun['id'] ?>">
											<tr>
												<td><?= $tahun['tahun'] ?></td>
												<!-- <td><button type="submit" class="badge badge-danger remove">X</button></td> -->
											</tr>
										</form>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal fade " id="tambahPeriode" tabindex="-1" role="dialog" aria-labelledby="tambahPeriodeLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg " role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="tambahPeriodeLabel">Input Data Periode</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('admin/input_periode'); ?>" method="post">
								<div class="modal-body">
									<div class="form-group">
										<label for="id_tahun">Tahun</label>
										<select name="id_tahun" id="" class="custom-select" required>
											<option value="">Pilih Tahun</option>
											<?php foreach ($data_tahun as $tahun) : ?>
												<option value="<?= $tahun['id'] ?>"><?= $tahun['tahun'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="id_bulan">Bulan</label>
										<select name="id_bulan" id="" class="custom-select" required>
											<option value="">Pilih Bulan</option>
											<?php foreach ($data_bulan as $bulan) : ?>
												<option value="<?= $bulan['id'] ?>"><?= $bulan['nama_bulan'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Tambah</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade " id="tambahtahun" tabindex="-1" role="dialog" aria-labelledby="tambahtahunLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg " role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="tambahtahunLabel">Input Data Tahun</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('admin/tambah_tahun'); ?>" method="post">
								<div class="modal-body">
									<div class="form-group">
										<label for="tahun">Tahun</label>
										<input type="number" name="tahun" id="" class="form-control" required>
									</div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Tambah</button>
								</div>
							</form>
						</div>
					</div>
				</div>

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
