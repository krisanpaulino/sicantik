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
					<div class="card card-white">
						<div class="card-header">
							<h3>Pilih Puskesmas</h3>
						</div>
						<div class="card-body">
							<table class="table table-bordered" id="dtable1">
								<thead>
									<tr>
										<td>Nama Puskesmas</td>
										<td>Action</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_puskesmas as $puskesmas) : ?>
										<tr>
											<td><?= $puskesmas['nama_puskesmas'] ?></td>
											<td>
												<a href="<?= base_url() ?>adm/data/laporan_stp/<?= $sesi['id'] ?>/<?= $puskesmas['id'] ?>" class="badge badge-info">Lihat</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>

				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
