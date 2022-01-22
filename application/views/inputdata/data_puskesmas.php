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
								<?= form_error('nama_puskesmas_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= form_error('jenis', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= $this->session->flashdata('message'); ?>



								<div class="card-body">
									<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#datakabModal">Tambah Data Puskesmas</a>

									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Nama Puskesmas</th>
												<th scope="col">Alamat</th>
												<th scope="col">No. Telpon</th>
												<th scope="col">Foto</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($puskesmas as $k) : ?>

												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $k['nama_puskesmas']; ?></td>
													<td><?= $k['alamat']; ?></td>
													<td><?= $k['no_telp']; ?></td>
													<td><img width="100" src="<?= base_url('assets/dist/img/puskesmas/') . $k['foto']; ?> " class="img-thumbnail">


													<td>
														<a href="<?= base_url() ?>admin/edit_puskesmas/<?= $k['id'] ?>" class="badge badge-success">edit</a>
														<form action="<?= base_url() ?>admin/hapus_puskesmas" method="post">
															<input type="hidden" name="id" value="<?= $k['id'] ?>" class="d-none">
															<button type="submit" class="badge badge-danger" onclick="return confirm('yakin ingin menghapus?')">
																hapus
															</button>
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
								<h5 class="modal-title" id="datakabModalLabel">Input Data Puskesmas</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('admin/inputdata_puskesmas'); ?>" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Nama Puskesmas</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="nama_puskesmas" name="nama_puskesmas">
											<?= form_error('nama_puskesmas', '<small class="text-danger pl-3">', '</small>'); ?>
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
										<label class="col-sm-2 col-form-label">No HP</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="no_telp" name="no_telp">
											<?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>

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
