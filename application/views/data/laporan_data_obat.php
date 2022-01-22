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
										<th rowspan="2">Obat</th>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<th colspan="6"><?= $puskesmas['nama_puskesmas'] ?></th>
										<?php endforeach; ?>
									</tr>
									<tr>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<td>Satuan</td>
											<td>Jumlah Pemakaian Obat</td>
											<td>Stok Awal</td>
											<td>Sisa Stok</td>
											<td>Yang diterima</td>
											<td>Ketersediaan</td>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_obat as $obat) : ?>
										<tr>
											<td><?= $obat['nama_obat'] ?></td>

											<?php foreach ($obat['puskesmas'] as $puskesmas) : ?>
												<td><?= $obat['satuan'] ?></td>
												<?php if (!empty($puskesmas['detail'])) : ?>
													<td><?= $puskesmas['detail']['jumlah_pemakaian_obat'] ?></td>
													<td><?= $puskesmas['detail']['stok_awal'] ?></td>
													<td><?= $puskesmas['detail']['sisa_stok'] ?></td>
													<td><?= $puskesmas['detail']['diterima'] ?></td>
													<td><?= $puskesmas['detail']['ketersediaan'] ?></td>
												<?php else : ?>
													<td>Blm Isi</td>
													<td>Blm Isi</td>
													<td>Blm Isi</td>
													<td>Blm Isi</td>
													<td>Blm Isi</td>
												<?php endif; ?>
											<?php endforeach; ?>
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
