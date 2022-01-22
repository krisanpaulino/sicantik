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
				<div class="col-md-12">
					<!-- jquery validation -->
					<div class="card card-white">

						<!-- /.card-header -->
						<div class="row">
							<div class="col-lg">
								<!-- <?= form_error('nama_puskesmas_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= form_error('jenis', '<div class="alert alert-danger" role="alert">', '</div>'); ?> -->
								<?= $this->session->flashdata('message'); ?>



								<div class="card-body">
									<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#datakabModal">Tambah Data Operator</a>

									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Nama Operotor</th>
												<th scope="col">Nip</th>
												<th scope="col">Jenis Kelamin</th>
												<th scope="col">Email</th>
												<th scope="col">Puskesmas</th>
												<th scope="col">TTL</th>
												<th scope="col">Alamat</th>
												<th scope="col">Foto</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($data_operator as $k) : ?>

												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $k['nama']; ?></td>
													<td><?= $k['nip']; ?></td>
													<td><?= $k['jenis_kelamin']; ?></td>
													<td><?= $k['email']; ?></td>
													<td><?= $k['nama_puskesmas']; ?></td>
													<td><?= $k['tempat_lahir']; ?>, <?= $k['tanggal_lahir']; ?> </td>
													<td><?= $k['alamat']; ?></td>

													<td><img width="100" src="<?= base_url('assets/dist/img/puskesmas/') . $k['foto']; ?> " class="img-thumbnail">

													<td>
														<a href="<?= base_url() ?>admin/edit_operator/<?= $k['id'] ?>" class="badge badge-success">edit</a>
														<form action="<?= base_url() ?>admin/hapus_operator" method="post">
															<input type="hidden" name="id" value="<?= $k['id_user'] ?>" class="d-none">
															<button type="submit" class="badge badge-danger" onclick="return confirm('yakin ingin menghapus?')">hapus</button>
														</form>
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
								<h5 class="modal-title" id="datakabModalLabel">Input Data Operator</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('admin/store_operator'); ?>" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Nama Operator</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="nama" name="nama">
											<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-2"></div>
										<div class="col-sm-5">
											<label class="col-form-label">Tempat Lahir</label>
											<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
											<?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>

										<div class="col-sm-5">
											<label class="col-form-label">Tanggal Lahir</label>
											<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
											<?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" id="email" name="email">
											<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Nip</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="nip" name="nip">
											<?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin">
											<?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">No HP</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="no_hp" name="no_hp">
											<?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Alamat</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="alamat" name="alamat">
											<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Password</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" name="password1">
											<?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Konfirmasi Password</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" name="password2">
											<?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Input Puskesmas</label>
										<div class="col-lg">
											<select name="id_puskesmas" id="id_puskesmas" class="form-control">
												<option value="">Select Puskesmas</option>
												<?php foreach ($data_puskesmas as $p) : ?>
													<option value="<?= $p['id'] ?>">
														<?= $p['nama_puskesmas'] ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
										</di>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Foto</label>
											<div class="custom-file col-sm-10">
												<input type="file" class="custom-file-input" id="filefoto" name="filefoto" required>
												<label class="custom-file-label" for="foto">input foto</label>
												<small class="form-text text-danger"><?= form_error('filefoto'); ?></small>
											</div>
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
