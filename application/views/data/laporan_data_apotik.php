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
					<a href="<?= base_url() ?>adm/data/laporan_data_apotik_excel/<?= $sesi['id'] ?>" class="btn btn-info">Cetak</a>
				</div>
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body" style="overflow-x: scroll; overflow-y: scroll; height: 500px">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="2">Elemen Data</th>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<th><?= $puskesmas['nama_puskesmas'] ?></th>
										<?php endforeach; ?>
									</tr>
									<tr>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<th>Jumlah Pemakaian Obat</th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kategori_data as $kategori) : ?>
										<tr>
											<th><?= $kategori['nama_kategori'] ?></th>
											<th colspan="<?= count($data_puskesmas) ?>"></th>
										</tr>
										<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
											<tr>
												<td><?= $elemen['nama_elemen'] ?></td>
												<?php foreach ($elemen['puskesmas'] as $puskesmas) : ?>
													<?php if (!empty($puskesmas['detail_elemen_data'])) : ?>
														<td><?= $puskesmas['detail_elemen_data']['jumlah_pemakaian_obat'] ?></td>
													<?php else : ?>
														<td>Blm Isi</td>
													<?php endif; ?>
												<?php endforeach; ?>
											</tr>
										<?php endforeach; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card card-white">
						<div class="card-body" style="overflow-x: scroll; overflow-y: scroll; height: 500px">
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
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
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
