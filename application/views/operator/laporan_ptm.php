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
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_data_ptm_excel/' . $sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="3">Nama Penyakit</th>
										<th colspan="<?= count($usia_ptm) * 2 ?>">KUNJUNGAN MENURUT GOLONGAN UMUR (TAHUN) </th>
										<th rowspan="2" colspan="3">Total</th>
									</tr>
									<tr>
										<?php foreach ($usia_ptm as $usia) : ?>
											<th colspan="2"><?= $usia['rentang_usia'] ?></th>
										<?php endforeach; ?>


									</tr>
									<?php foreach ($usia_ptm as $usia) : ?>
										<th>L</th>
										<th>P</th>
									<?php endforeach; ?>
									<th>L</th>
									<th>P</th>
									<th>L+P</th>
								</thead>
								<tbody>
									<!-- $l_total = 0 -->
									<?php foreach ($data_ptm as $ptm) : ?>
										<tr>
											<td class="bg-success"><?= $ptm['nama_data'] ?></td>
											<td colspan="<?= count($usia_ptm) * 2 + 3 ?>" class="bg-success"></td>
										</tr>
										<?php foreach ($ptm['atribut'] as $atribut) : ?>
											<?php
											$l = 0;
											$p = 0;
											?>
											<tr>
												<td><?= $atribut['nama_atribut'] ?></td>
												<?php foreach ($atribut['usia'] as $usia) : ?>
													<td><?= $usia['detail']['l'] ?></td>
													<td><?= $usia['detail']['p'] ?></td>
													<?php
													$l += $usia['detail']['l'];
													$p += $usia['detail']['p'];
													?>
												<?php endforeach; ?>
												<td><?= $l ?></td>
												<td><?= $p ?></td>
												<td><?= $l + $p ?></td>
											</tr>
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
