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
					<div class="card card-success">
						<!-- /.card-header -->

						<?= $this->session->flashdata('message'); ?>
						<div class="card-header">
							<h3 class="card-title">Data Atribut</h3>
						</div>
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Atribut Data</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($atribut_data as $atribut) : ?>

										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= $atribut['nama_atribut']; ?></td>
											<td>
												Hapus
											</td>
										</tr>
										<?php $i++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.card -->
				</div>
				<div class="col-md-4">
					<div class="card card-success">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									Atribut Lain
								</div>
								<div class="col-md-2 d-flex justify-content-end">
									<button type="button" class="badge badge-success" data-toggle="modal" data-target="#atributModal">
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</div>
						<div class="card-body">
							<form action="<?= base_url() ?>adm/data/store_atribut_elemen" method="post">
								<input type="hidden" name="id_data" class="d-none" value="<?= $id_data ?>">
								<?php foreach ($atribut_lain as $atribut) : ?>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="id_atribut[]" value="<?= $atribut['id'] ?>" name="atribut">
										<label class="form-check-label">
											<?= $atribut['nama_atribut'] ?>
										</label>
									</div>
								<?php endforeach; ?>
								<div class="form-group mt-4">
									<button type="submit" class="btn btn-success">Tambah Atribut Ke Elemen Data</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
		<div class="modal fade" id="atributModal" tabindex="-1" role="dialog" aria-labelledby="atributModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="atributModalLabel">Tambah Atribut</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url() ?>adm/data/store_atribut" method="post">
						<input type="hidden" name="id_data" value="<?= $id_data ?>" class="d-none">
						<div class="modal-body">
							<label for="nama_atribut">Nama Atribut</label>
							<input type="text" name="nama_atribut" id="" class="form-control">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
