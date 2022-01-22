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
						<?php if ($this->session->flashdata('message')) { ?>
							<div class="alert alert-success">
								<?= $this->session->flashdata('message'); ?>
							</div>
						<?php } ?>
						<div class="row">
							<div class="col-lg">





								<div class="card-body">
									<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSarana">Tambah Sarana</a>

									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Jenis Sarana</th>
												<th scope="col">Nama Sarana</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($data_sarana as $sarana) : ?>

												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $sarana['nama_jenis']; ?></td>
													<td><?= $sarana['nama_sarana']; ?></td>
													<td class="text-center">
														<a href="#" class="badge badge-primary" data-toggle="modal" data-target="#update<?= $sarana['id'] ?>">Edit</a> | <form action="<?= base_url() ?>adm/data/hapus_sarana" method="post">
															<input type="hidden" name="id" value="<?= $sarana['id'] ?>">
															<button type="submit" class="badge badge-danger">Hapus</button>
														</form>
													</td>
												</tr>
												<?php $i++; ?>
												<div class="modal fade " id="update<?= $sarana['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="update<?= $sarana['id'] ?>Label" aria-hidden="true">
													<div class="modal-dialog modal-lg " role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="update<?= $sarana['id'] ?>Label">Edit Sarana</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<form action="<?= base_url('adm/data/update_sarana'); ?>" method="post">
																<input type="hidden" name="id" value="<?= $sarana['id'] ?>">
																<div class="modal-body">
																	<div class="form-group">
																		<label for="">Jenis Sarana</label>
																		<select name="id_jenis_sarana" id="" class="custom-select">
																			<?php foreach ($jenis_sarana as $jenis) : ?>
																				<option value="<?= $jenis['id'] ?>" <?= ($sarana['id_jenis_sarana'] == $jenis['id']) ? 'selected' : '' ?>><?= $jenis['nama_jenis'] ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																	<div class="form-group">
																		<label>Nama Sarana</label>
																		<input type="text" name="nama_sarana" id="" class="form-control" value="<?= $sarana['nama_sarana'] ?>">
																	</div>
																</div>

																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>
				<div class="modal fade " id="tambahSarana" tabindex="-1" role="dialog" aria-labelledby="tambahSaranaLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg " role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="tambahSaranaLabel">Input Data Sarana</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('adm/data/store_sarana'); ?>" method="post">
								<div class="modal-body">
									<div class="form-group">
										<label for="">Jenis Sarana</label>
										<select name="id_jenis_sarana" id="" class="custom-select" required>
											<option value="">Pilih Jenis Sarana</option>
											<?php foreach ($jenis_sarana as $jenis) : ?>
												<option value="<?= $jenis['id'] ?>"><?= $jenis['nama_jenis'] ?></option>
											<?php endforeach; ?>
										</select>
										<div class="form-group">
											<label for="">Nama Sarana</label>
											<input type="text" name="nama_sarana" id="" class="form-control">
										</div>
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
