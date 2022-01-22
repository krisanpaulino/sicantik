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
				<div class="col-md-12">

					<form action="<?= base_url() ?>/operator/store_ptm" method="post">
						<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
						<?php foreach ($data_ptm as $ptm) : ?>
							<div id="accordion<?= $ptm['id'] ?>">
								<div class="card card-white">
									<div class="card-header">
										<div class="d-flex justify-content-start">
											<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?= $ptm['id'] ?>" aria-expanded="true" aria-controls="collapse<?= $ptm['id'] ?>">
												<h3 for=""><?= $ptm['nama_data'] ?></h3>

											</a>

										</div>
									</div>

									<div id="collapse<?= $ptm['id'] ?>" class="collapse" data-parent="#accordion<?= $ptm['id'] ?>">
										<div class="card-body">
											<input type="hidden" name="id_data[]" value="<?= $ptm['id'] ?>">
											<?php foreach ($ptm['usia'] as $usia) : ?>
												<div class="form-inline">
													<h4 class="mt-4"><?= $usia['rentang_usia'] ?></h4>
													<input type="hidden" name="usia_<?= $ptm['id'] ?>[]" value="<?= $usia['id'] ?>">
												</div>

												<div class="row">
													<div class="col-2">
														<label class="mb-2">Laki-Laki</label>

													</div>
													<?php foreach ($atribut_ptm as $atribut) : ?>

														<div class="col-4">
															<input type="hidden" class="form-control" name="id_atribut_<?= $ptm['id'] . '_' . $usia['id'] ?>[]" id="" value="<?= $atribut['id'] ?>">
															<input type="number" name="l_<?= $ptm['id'] . '_' . $usia['id'] . '_' . $atribut['id'] ?>" id="" class="form-control mb-2" placeholder="<?= $atribut['nama_atribut'] ?>" required>
														</div>
													<?php endforeach; ?>
												</div>
												<div class="row">
													<div class="col-2">
														<label for="" class="mr-4">Perempuan</label>
													</div>
													<?php foreach ($atribut_ptm as $atribut) : ?>
														<div class="col-4">
															<input type="number" name="p_<?= $ptm['id'] . '_' . $usia['id'] . '_' . $atribut['id'] ?>" id="" class="form-control mr-4 mb-2" placeholder="<?= $atribut['nama_atribut'] ?>" required>
														</div>
													<?php endforeach; ?>
												</div>
											<?php endforeach; ?>
										</div>
									</div>

								</div>
							</div>
						<?php endforeach; ?>
						<div class="form-group">
							<button type="submit" class="btn btn-block btn-primary">
								Simpan
							</button>
						</div>
					</form>

				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

</div><!-- /.container-fluid -->
