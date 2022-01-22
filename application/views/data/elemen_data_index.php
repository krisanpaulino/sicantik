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
					<a href="<?= base_url() ?>adm/data/kategori_elemen/<?= $id ?>" class="btn btn-primary">+ Tambah Elemen Data</a>
					<div class="card card-white">
						<!-- /.card-header -->

						<div class="row">
							<div class="col-lg">
								<?= $this->session->flashdata('message'); ?>

								<div class="card-body">
									<table id="example2" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Kategori Elemen Data</th>
												<th scope="col">Elemen Data</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1; ?>
											<?php foreach ($elemen_data as $k) : ?>

												<tr>
													<th scope="row"><?= $i; ?></th>
													<td><?= $k['nama_kategori']; ?></td>
													<td><?= $k['nama_elemen_data']; ?></td>
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
