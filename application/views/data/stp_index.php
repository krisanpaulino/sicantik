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
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Bulan</th>
									<th>Tahun</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($data_sesi)) { ?>
									<?php foreach ($data_sesi as $data) : ?>
										<tr>
											<td><?= $data['nama_bulan'] ?></td>
											<td><?= $data['tahun'] ?></td>
											<td>
												<a href="<?= base_url() ?>adm/data/laporan_stp/<?= $data['id'] ?>/" class="badge badge-primary">Lihat</a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php } ?>
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
