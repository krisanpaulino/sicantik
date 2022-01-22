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

				<div class="col-md-12">
					<div class="card card-white" style="width: 100%;">
						<div class="card-body">
							<form action="<?= base_url() ?>operator/store_stp" method="post">
								<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
								<?php foreach ($data_stp as $stp) : ?>
									<input type="hidden" name="id_data[]" value="<?= $stp['id'] ?>">
									<h4 for=""><?= $stp['nama_data'] ?></h4>
									<div class="row">
										<?php foreach ($stp['elemen_usia'] as $usia) : ?>
											<div class="col-md-4">
												<input type="hidden" name="id_usia_<?= $stp['id'] ?>[]" value="<?= $usia['id'] ?>">
												<label><?= $usia['rentang_usia'] ?></label>
												<?php foreach ($stp['atribut'] as $atribut) : ?>
													<input type="hidden" name="id_atribut_<?= $stp['id'] ?>_<?= $usia['id'] ?>[]" value="<?= $atribut['id'] ?>">
													<input type="number" name="jumlah_<?= $stp['id'] ?>_<?= $usia['id'] ?>_<?= $atribut['id'] ?>" id="" class="form-control" placeholder="<?= $atribut['nama_atribut'] ?>" required>
												<?php endforeach; ?>
											</div>
										<?php endforeach; ?>
									</div>
									<hr>
								<?php endforeach; ?>
								<div class="form-group ml-4">
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</form>
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
