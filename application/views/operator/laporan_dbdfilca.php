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
				<div class="col-lg-12">
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_data_dbdfilca_excel/' . $info_sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Jumlah Desa</th>
										<th>Jumlah Desa Diberi Obat</th>
										<th>(%) Desa Diberi Obat</th>
										<th>Jumlah Penduduk</th>
										<th>Jumlah Sasaran</th>

									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?= $dbdfilca['jumlah_desa'] ?></td>
										<td><?= $dbdfilca['jumlah_desa_diberi_obat'] ?></td>
										<td><?= $dbdfilca['jumlah_desa'] / $dbdfilca['jumlah_desa_diberi_obat'] * 100 ?>%</td>
										<td><?= $dbdfilca['jumlah_penduduk'] ?></td>
										<td><?= $dbdfilca['jumlah_sasaran'] ?></td>
									</tr>
								</tbody>
							</table>


							<h3>Jumlah Penduduk Minum Obat</h3>
							<table class="table table-bordered">
								<thead>
									<tr>
										<?php foreach ($usia_dbdfilca as $usia) : ?>
											<th colspan="3"><?= $usia['rentang_usia'] ?></th>
										<?php endforeach; ?>
										<th rowspan="2">LK</th>
										<th rowspan="2">PR</th>
										<th rowspan="2">TOTAL</th>
										<th rowspan="2">(%) Pddk minum obat dari jumlah penduduk</th>
										<th rowspan="2">(%) Pddk minum obat dari jumlah sasaran</th>
									</tr>
									<tr>
										<?php foreach ($usia_dbdfilca as $usia) : ?>
											<th>LK</th>
											<th>PR</th>
											<th>TOTAL</th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
										$l = 0;
										$p = 0;
										?>
										<?php foreach ($dbdfilca['detail'] as $detail) : ?>
											<td><?= $detail['l'] ?></td>
											<td><?= $detail['p'] ?></td>
											<td><?= $detail['l'] + $detail['p'] ?></td>
											<?php
											$l += $detail['l'];
											$p += $detail['p'];
											?>
										<?php endforeach; ?>
										<td><?= $l ?></td>
										<td><?= $p ?></td>
										<td><?= $l + $p ?></td>
										<td><?= ($l + $p) / $dbdfilca['jumlah_penduduk'] * 100 ?>%</td>
										<td><?= ($l + $p) / $dbdfilca['jumlah_sasaran'] * 100 ?>%</td>
										<td></td>
									</tr>
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
