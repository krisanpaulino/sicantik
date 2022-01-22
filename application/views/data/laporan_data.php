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
					<a href="<?= base_url() ?>adm/data/laporan_data_excel/<?= $info_data['id'] ?>/<?= $sesi['id'] ?>" class="btn btn-info">Cetak</a>
				</div>
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body" style="overflow-x: scroll; overflow-y: scroll; height: 500px">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="2">Elemen Data</th>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<th colspan="2"><?= $puskesmas['nama_puskesmas'] ?></th>
										<?php endforeach; ?>
										<th colspan="<?= count($atribut_data) + 1 ?>">Total</th>
									</tr>
									<tr>
										<?php foreach ($data_puskesmas as $puskesmas) : ?>
											<?php foreach ($atribut_data as $atribut) : ?>
												<th><?= $atribut['nama_atribut'] ?></th>
											<?php endforeach; ?>
										<?php endforeach; ?>
										<?php foreach ($atribut_data as $atribut) : ?>
											<th><?= $atribut['nama_atribut'] ?></th>
										<?php endforeach; ?>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($kategori_data as $kategori) : ?>
										<?php if ($i == 2) : ?>
											<?php foreach ($detail_turunan as $turunan) : ?>
												<?php if ($turunan['punya_elemen_data'] == 1) : ?>

													<?php foreach ($turunan['kategori_data'] as $_kategori) : ?>
														<tr>
															<th><?= $turunan['nama_data'] ?></th>
														</tr>

														<?php foreach ($_kategori['elemen_data'] as $elemen) : ?>
															<tr>
																<?php $jumlah_atribut = []; ?>
																<?php foreach ($atribut_data as $atribut) : ?>
																	<?php
																	$jumlah_atribut['atr' . $atribut['id']] = 0;
																	?>
																<?php endforeach; ?>
																<td><?= $elemen['nama_elemen_data'] ?></td>
																<?php foreach ($elemen['puskesmas'] as $puskesmas) : ?>
																	<?php if (!empty($puskesmas['detail_elemen_data'])) : ?>
																		<?php foreach ($puskesmas['detail_elemen_data'] as $detail) : ?>
																			<?php if (isset($jumlah_atribut['atr' . $detail['id_atribut_data']]) || $jumlah_atribut['atr' . $detail['id_atribut_data']] != null) : ?>
																				<?php $jumlah_atribut['atr' . $detail['id_atribut_data']] = $detail['jumlah'] ?>
																			<?php else : ?>
																				<?php $jumlah_atribut['atr' . $detail['id_atribut_data']] += $detail['jumlah'] ?>
																			<?php endif; ?>
																			<td><?= $detail['jumlah'] ?></td>
																		<?php endforeach; ?>
																	<?php else : ?>
																		<?php foreach ($atribut_data as $atribut) : ?>
																			<td>-</td>
																		<?php endforeach; ?>
																	<?php endif; ?>
																<?php endforeach; ?>
																<?php foreach ($jumlah_atribut as $total) : ?>
																	<td><?= $total ?></td>
																<?php endforeach; ?>
																<td><?= array_sum($jumlah_atribut) ?></td>
															</tr>
														<?php endforeach; ?>

													<?php endforeach; ?>

												<?php endif; ?>

												<?php if ($turunan['punya_elemen_usia'] == 1 || $turunan['is_stp'] == 1) : ?>
													<tr>
														<th><?= $turunan['nama_data'] ?></th>
													</tr>
													<?php foreach ($turunan['elemen_usia'] as $usia) : ?>
														<tr>
															<?php $jumlah_atribut = []; ?>
															<?php foreach ($atribut_data as $atribut) : ?>
																<?php
																$jumlah_atribut['atr' . $atribut['id']] = 0;
																?>
															<?php endforeach; ?>
															<td><?= $usia['rentang_usia'] ?></td>
															<?php foreach ($usia['puskesmas'] as $puskesmas) : ?>
																<?php if (!empty($puskesmas['detail_elemen_usia'])) : ?>
																	<?php foreach ($puskesmas['detail_elemen_usia'] as $detail) : ?>
																		<?php if (isset($jumlah_atribut['atr' . $detail['id_atribut_data']]) || $jumlah_atribut['atr' . $detail['id_atribut_data']] != null) : ?>
																			<?php $jumlah_atribut['atr' . $detail['id_atribut_data']] = $detail['jumlah'] ?>
																		<?php else : ?>
																			<?php $jumlah_atribut['atr' . $detail['id_atribut_data']] += $detail['jumlah'] ?>
																		<?php endif; ?>
																		<td><?= $detail['jumlah'] ?></td>
																	<?php endforeach; ?>
																<?php else : ?>
																	<?php foreach ($atribut_data as $atribut) : ?>
																		<td>-</td>
																	<?php endforeach; ?>
																<?php endif; ?>
															<?php endforeach; ?>
															<?php foreach ($jumlah_atribut as $total) : ?>
																<td><?= $total ?></td>
															<?php endforeach; ?>
															<td><?= array_sum($jumlah_atribut) ?></td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>

										<tr>
											<th><?= $kategori['nama_kategori'] ?></th>
										</tr>
										<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
											<tr>
												<?php $jumlah_atribut = []; ?>
												<?php foreach ($atribut_data as $atribut) : ?>
													<?php
													$jumlah_atribut['atr' . $atribut['id']] = 0;
													?>
												<?php endforeach; ?>
												<td><?= $elemen['nama_elemen_data'] ?></td>
												<?php foreach ($elemen['puskesmas'] as $puskesmas) : ?>
													<?php if (!empty($puskesmas['detail_elemen_data'])) : ?>
														<?php foreach ($puskesmas['detail_elemen_data'] as $detail) : ?>
															<?php if (isset($jumlah_atribut['atr' . $detail['id_atribut_data']]) || $jumlah_atribut['atr' . $detail['id_atribut_data']] != null) : ?>
																<?php $jumlah_atribut['atr' . $detail['id_atribut_data']] = $detail['jumlah'] ?>
															<?php else : ?>
																<?php $jumlah_atribut['atr' . $detail['id_atribut_data']] += $detail['jumlah'] ?>
															<?php endif; ?>
															<td><?= $detail['jumlah'] ?></td>
														<?php endforeach; ?>
													<?php else : ?>
														<?php foreach ($atribut_data as $atribut) : ?>
															<td>-</td>
														<?php endforeach; ?>
													<?php endif; ?>
												<?php endforeach; ?>
												<?php foreach ($jumlah_atribut as $total) : ?>
													<td><?= $total ?></td>
												<?php endforeach; ?>
												<td><?= array_sum($jumlah_atribut) ?></td>
											</tr>
										<?php endforeach; ?>
										<?php $i++; ?>
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
