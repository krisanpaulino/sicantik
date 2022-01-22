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
				<form action="<?= base_url() ?>operator/store_data" method="post">
					<input type="hidden" name="id_data" value="<?= $id_data ?>">
					<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
					<div class="col-md-12">
						<div class="card card-white">
							<div class="card-header">
								Usia
							</div>
							<div class="card-body">
								<div class="row">
									<?php foreach ($elemen_usia as $elemen) : ?>
										<div class="col-md-4">
											<div class="form-group">
												<input type="hidden" name="id_elemen_data_usia[]" class="d-none" value="<?= $elemen['id'] ?>">
												<label><?= $elemen['rentang_usia'] ?></label>
												<?php foreach ($atribut_data as $atribut) : ?>
													<input type="hidden" name="id_atribut_usia_<?= $elemen['id'] ?>[]" value="<?= $atribut['id'] ?>">
													<input type="number" name="jumlah_usia_<?= $elemen['id'] ?><?= $atribut['id'] ?>" id="" class="form-control" placeholder="<?= $atribut['nama_atribut'] ?>">
												<?php endforeach; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
					<?php $i = 1 ?>
					<?php foreach ($kategori_data as $kategori) : ?>
						<?php if ($i == 3 && $data_turunan != null) : ?>
							<div class="col-md-12">
								<div class="card card-white">
									<div class="card-header"></div>
									<div class="card-body">
										<?php foreach ($data_turunan as $turunan) : ?>
											<input type="hidden" name="id_turunan[]" value="<?= $turunan['id'] ?>">
											<h4><?= $turunan['nama_data'] ?></h4>
											<?php if ($turunan['elemen_usia'] != null) : ?>
												<?php foreach ($turunan['elemen_usia'] as $usia) : ?>
													<input type="hidden" name="turunan_id_elemen_data_usia_<?= $turunan['id'] ?>[]" value="<?= $usia['id'] ?>">
													<label for=""><?= $usia['rentang_usia'] ?></label>
													<div class="form-inline">
														<?php foreach ($turunan['atribut_data'] as $atribut) : ?>
															<input type="hidden" name="turunan_id_atribut_usia_<?= $turunan['id'] ?>_<?= $usia['id'] ?>[]" value="<?= $atribut['id'] ?>">
															<input type="number" name="turunan_jumlah_usia_<?= $turunan['id'] ?>_<?= $usia['id'] ?>_<?= $atribut['id'] ?>" id="" class="form-control" placeholder="<?= $atribut['nama_atribut'] ?>">
														<?php endforeach; ?>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>

											<?php if ($turunan['kategori_data'] != null) : ?>
												<?php foreach ($turunan['kategori_data'] as $kategori_) : ?>
													<?php foreach ($kategori_['elemen_data'] as $elemen) : ?>
														<div class="row">
															<div class="col-md-12">
																<input type="hidden" name="turunan_id_elemen_data[]" value="<?= $elemen['id'] ?>" class="d-none">
																<label><?= $elemen['nama_elemen_data'] ?></label>
															</div>
															<div class="col-md-12">
																<div class="form-group d-flex d-inline">
																	<?php foreach ($turunan['atribut_data'] as $atribut) : ?>
																		<input type="hidden" name="turunan_id_atribut_<?= $elemen['id'] ?>[]" value="<?= $atribut['id'] ?>">
																		<input type="number" name="turunan_jumlah_<?= $elemen['id'] . $atribut['id'] ?>" id="" class="form-control" placeholder="<?= $atribut['nama_atribut'] ?>" required>
																	<?php endforeach; ?>
																</div>
															</div>
														</div>
													<?php endforeach; ?>
												<?php endforeach; ?>
											<?php endif; ?>
											<hr>

										<?php endforeach; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="col-md-12">
							<!-- jquery validation -->
							<div class="card card-white">
								<div class="card-header"><?= $kategori['nama_kategori'] ?></div>
								<div class="card-body">
									<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
										<div class="row">
											<div class="col-md-12">
												<input type="hidden" name="id_elemen_data[]" value="<?= $elemen['id'] ?>" class="d-none">
												<label><?= $elemen['nama_elemen_data'] ?></label>
											</div>
											<div class="col-md-12">
												<div class="form-group d-flex d-inline">
													<?php foreach ($atribut_data as $atribut) : ?>
														<input type="hidden" name="id_atribut_<?= $elemen['id'] ?>[]" value="<?= $atribut['id'] ?>">
														<input type="number" name="jumlah_<?= $elemen['id'] . $atribut['id'] ?>" id="" class="form-control" placeholder="<?= $atribut['nama_atribut'] ?>">
													<?php endforeach; ?>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php $i++; ?>
					<?php endforeach; ?>
					<div class="form-group ml-4">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
