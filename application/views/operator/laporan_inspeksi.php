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
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_data_inspeksi_exel/' . $sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Sarana</th>
										<th>Jumlah</th>
										<th>%</th>
									</tr>

								</thead>
								<tbody>
									<tr>
										<th>Total Kegiatan Pembinaan :</th>
									</tr>
									<tr>
										<th>Bulan Ini</th>
										<td><?= $inspeksi_sarana['bulan_ini_jumlah'] ?></td>
										<td><?= $inspeksi_sarana['bulan_ini_persen'] ?></td>
									</tr>
									<tr>
										<td>Kumulatif s.d bulan lalu</td>
										<td><?= $inspeksi_sarana['kumulatif_bulan_lalu_jumlah'] ?></td>
										<td><?= $inspeksi_sarana['kumulatif_bulan_lalu_persen'] ?></td>
									</tr>
									<?php foreach ($inspeksi_sarana['jenis_sarana'] as $jenis) : ?>
										<tr>
											<th>
												<h3>Sarana <?= $jenis['nama_jenis'] ?></h3>
											</th>
											<th></th>
											<th></th>
										</tr>
										<?php foreach ($jenis['sarana'] as $sarana) : ?>
											<tr>
												<th><?= $sarana['nama_sarana'] ?></th>
												<td></td>
												<td></td>
											</tr>

											<?php foreach ($sarana['atribut'] as $atribut) : ?>
												<tr>
													<td><?= $atribut['nama_atribut'] ?></td>
													<td><?= $atribut['detail']['jumlah'] ?></td>
													<td><?= $atribut['detail']['persen'] ?> %</td>
												</tr>
											<?php endforeach; ?>

										<?php endforeach; ?>
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
