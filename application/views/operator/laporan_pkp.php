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
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_data_pkp_excel/' . $sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<td>Jenis Kegiatan</td>
										<td>Sasaran</td>
										<td>Target Capaian</td>
										<td>Jumlah Sasaran</td>
										<td>ABS</td>
										<td>KOM</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($jenis_kegiatan as $jenis) : ?>
										<tr>
											<td class="bg-primary"><?= $jenis['nama_jenis'] ?></td>
										</tr>
										<?php $kelompok = null ?>
										<?php foreach ($jenis['kegiatan'] as $kegiatan) : ?>
											<?php if ($kelompok != $kegiatan['kelompok_kegiatan']) : ?>
												<tr>
													<th>
														<?= $kegiatan['kelompok_kegiatan'] ?>
													</th>
												</tr>
												<?php $kelompok = $kegiatan['kelompok_kegiatan'] ?>
											<?php endif; ?>
											<tr>
												<td><?= $kegiatan['nama_kegiatan'] ?></td>
												<td><?= $kegiatan['sasaran'] ?></td>
												<td><?= $kegiatan['pkp']['target_capaian'] ?></td>
												<td><?= $kegiatan['pkp']['jumlah_sasaran'] ?></td>
												<td><?= $kegiatan['abs'] ?></td>
												<td><?= $kegiatan['kom'] ?></td>
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
