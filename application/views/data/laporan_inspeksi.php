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
					<a href="<?= base_url() ?>adm/data/laporan_data_inspeksi_excel/<?= $sesi['id'] ?>" class="btn btn-info">Cetak</a>
				</div>
				<div class="col-lg-12">
					<div class="card card-white" style="overflow-x: scroll; overflow-y: scroll; height: 500px">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="2">Sarana</th>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<th colspan="2"><?= $puskesmas['nama_puskesmas'] ?></th>
										<?php endforeach; ?>
										<th colspan="2">Total</th>
									</tr>
									<tr>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<th>Jumlah</th>
											<th>%</th>
										<?php endforeach; ?>
										<th>Jumlah</th>
										<th>%</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>Total Kegiatan Pembinaan :</th>
										<th colspan="<?= count($data_puskesmas) * 2 ?>"></th>
									</tr>
									<tr>
										<th>Bulan Ini</th>
										<?php $jumlah = 0;
										$persen = 0; ?>
										<?php foreach ($inspeksi_sarana['puskesmas'] as $puskesmas) : ?>
											<?php if ($puskesmas['inspeksi'] != null) : ?>
												<td><?= $puskesmas['inspeksi']['bulan_ini_jumlah'] ?></td>
												<td><?= $puskesmas['inspeksi']['bulan_ini_persen'] ?></td>
												<?php $jumlah += $puskesmas['inspeksi']['bulan_ini_jumlah'];
												$persen += $puskesmas['inspeksi']['bulan_ini_persen']; ?>
											<?php else : ?>
												<td>Blm Isi</td>
												<td>Blm Isi</td>
											<?php endif; ?>
										<?php endforeach; ?>
										<td><?= $jumlah ?></td>
										<td><?= $persen ?></td>
									</tr>
									<tr>
										<td>Kumulatif s.d bulan lalu</td>
										<?php $jumlah = 0;
										$persen = 0; ?>
										<?php foreach ($inspeksi_sarana['puskesmas'] as $puskesmas) : ?>
											<?php if ($puskesmas['inspeksi'] != null) : ?>
												<td><?= $puskesmas['inspeksi']['kumulatif_bulan_lalu_jumlah'] ?></td>
												<td><?= $puskesmas['inspeksi']['kumulatif_bulan_lalu_persen'] ?></td>
												<?php $jumlah += $puskesmas['inspeksi']['kumulatif_bulan_lalu_jumlah'];
												$persen += $puskesmas['inspeksi']['kumulatif_bulan_lalu_persen']; ?>
											<?php else : ?>
												<td>Blm Isi</td>
												<td>Blm Isi</td>
											<?php endif; ?>
										<?php endforeach; ?>
										<td><?= $jumlah ?></td>
										<td><?= $persen ?></td>
									</tr>
									<?php foreach ($inspeksi_sarana['jenis_sarana'] as $jenis) : ?>
										<tr>
											<th>
												<h3>Sarana<?= $jenis['nama_jenis'] ?></h3>
											</th>
											<th colspan="<?= count($data_puskesmas) * 2 ?>"></th>

										</tr>
										<?php foreach ($jenis['sarana'] as $sarana) : ?>
											<tr>
												<th><?= $sarana['nama_sarana'] ?></th>
												<th colspan="<?= count($data_puskesmas) * 2 ?>"></th>
											</tr>

											<?php foreach ($sarana['atribut'] as $atribut) : ?>
												<tr>
													<td><?= $atribut['nama_atribut'] ?></td>
													<?php $jumlah = 0;
													$persen = 0; ?>
													<?php foreach ($atribut['puskesmas'] as $puskesmas) : ?>
														<?php if ($puskesmas['detail'] != null) : ?>
															<td><?= $puskesmas['detail']['jumlah'] ?></td>
															<td><?= $puskesmas['detail']['persen'] ?> %</td>
															<?php $jumlah += $puskesmas['detail']['jumlah'];
															$persen += $puskesmas['detail']['persen']; ?>
														<?php else : ?>
															<td>Blm Isi</td>
															<td>Blm Isi</td>
														<?php endif; ?>
													<?php endforeach; ?>
													<td><?= $jumlah ?></td>
													<td><?= $persen ?></td>
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
