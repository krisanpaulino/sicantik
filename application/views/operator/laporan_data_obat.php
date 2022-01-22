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
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Obat</th>
										<th>Satuan</th>
										<th>Jmlh/Pemakaian Obat</th>
										<th>Stok Awal</th>
										<th>Sisa Stok</th>
										<th>Yang diterima</th>
										<th>Ketersediaan</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_obat as $obat) : ?>
										<tr>
											<td><?= $obat['nama_obat'] ?></td>
											<td><?= $obat['satuan'] ?></td>
											<td><?= $obat['detail']['jumlah_pemakaian_obat'] ?></td>
											<td><?= $obat['detail']['stok_awal'] ?></td>
											<td><?= $obat['detail']['sisa_stok'] ?></td>
											<td><?= $obat['detail']['diterima'] ?></td>
											<td><?= $obat['detail']['ketersediaan'] ?></td>
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
