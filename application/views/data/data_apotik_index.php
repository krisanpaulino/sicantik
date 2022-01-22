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
								<?= form_error('nama_kabupaten_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= form_error('jenis', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= $this->session->flashdata('message'); ?>



								<div class="card-body">


									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Tahun</th>
												<th>Bulan</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($data_sesi as $data) : ?>
												<tr>
													<td><?= $data['tahun'] ?></td>
													<td><?= $data['nama_bulan'] ?></td>
													<td><a href="<?= base_url() ?>adm/data/laporan_data_apotik/<?= $data['id'] ?>" class="badge badge-info">Lihat</a></td>
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
