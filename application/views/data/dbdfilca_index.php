<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $judul ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?= $judul ?></li> -->
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Tahun</th>
							<th>Bulan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_dbdfilca as $dbdfilca) : ?>
							<tr>
								<td><?= $dbdfilca['nama_bulan'] ?></td>
								<td><?= $dbdfilca['tahun'] ?></td>
								<td><a href="<?= base_url() ?>adm/data/laporan_dbdfilca/<?= $dbdfilca['id'] ?>" class="badge badge-primary">Lihat Detail</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
