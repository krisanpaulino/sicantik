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
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_data_excel/' . $info_data['id'] . '/' . $sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">

							<table class="table table-bordered" id="example2">
								<thead>
									<tr>
										<th>Elemen Data</th>
										<?php foreach ($atribut_data as $atribut) : ?>
											<th><?= $atribut['nama_atribut'] ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1 ?>
									<?php foreach ($kategori_data as $kategori) : ?>
										<?php if ($i == 2) : ?>
											<?php if ($detail_turunan != null) : ?>
												<?php foreach ($detail_turunan as $turunan) : ?>
													<?php if ($turunan['punya_elemen_data'] == 1) : ?>
														<tr>
															<th><?= $turunan['nama_data'] ?></th>
														</tr>
														<?php foreach ($turunan['kategori_data'] as $ktg) : ?>
															<?php foreach ($ktg['elemen_data'] as $el) : ?>
																<tr>
																	<td><?= $el['nama_elemen_data'] ?></td>
																	<?php foreach ($el['detail_elemen_data'] as $det) : ?>
																		<td><?= $det['jumlah'] ?></td>
																	<?php endforeach; ?>
																</tr>
															<?php endforeach; ?>
														<?php endforeach; ?>
													<?php endif; ?>


													<?php if ($turunan['is_stp'] == 1 || $turunan['punya_elemen_usia'] == 1) : ?>
														<tr>
															<th><?= $turunan['nama_data'] ?></th>
														</tr>
														<?php foreach ($turunan['elemen_usia'] as $usia) : ?>
															<tr>
																<td><?= $usia['rentang_usia'] ?></td>
																<?php foreach ($usia['detail_elemen_usia'] as $detail) : ?>
																	<td><?= $detail['jumlah'] ?></td>
																<?php endforeach; ?>
															</tr>
														<?php endforeach; ?>
													<?php endif; ?>
												<?php endforeach; ?>
											<?php endif; ?>
										<?php endif; ?>
										<tr>
											<th class="bg-primary"><?= $kategori['nama_kategori'] ?></th>
										</tr>
										<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
											<tr>
												<td><?= $elemen['nama_elemen_data'] ?></td>
												<?php foreach ($elemen['detail_elemen_data'] as $detail) : ?>
													<td><?= $detail['jumlah'] ?></td>
												<?php endforeach; ?>
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
