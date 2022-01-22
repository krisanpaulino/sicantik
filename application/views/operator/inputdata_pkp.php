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
					<form class="form col-lg-12" action="<?= base_url() ?>operator/store_pkp" method="post" style="width: 100%;">
						<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
						<?php foreach ($jenis_kegiatan as $jenis) : ?>
							<div class="card card-white">
								<div class="card-header">
									<h4><?= $jenis['nama_jenis'] ?></h4>
								</div>
								<div class="card-body">
									<?php $kelompok = null; ?>
									<?php foreach ($jenis['kegiatan'] as $kegiatan) : ?>
										<input type="hidden" name="id_kegiatan[]" value="<?= $kegiatan['id'] ?>">
										<input type="hidden" name="id_jenis_kegiatan_<?= $kegiatan['id'] ?>" value="<?= $kegiatan['id_jenis_kegiatan'] ?>">
										<?php if ($kegiatan['kelompok_kegiatan'] != null && $kelompok != $kegiatan['kelompok_kegiatan']) : ?>
											<label for=""><?= $kegiatan['kelompok_kegiatan'] ?></label>
											<?php $kelompok = $kegiatan['kelompok_kegiatan'] ?>
										<?php endif; ?>
										<label for=""><strong><?= $kegiatan['nama_kegiatan'] ?></strong></label>
										<div class="row">
											<input type="hidden" name="id_pkp_<?= $kegiatan['id'] ?>" value="<?= $kegiatan['pkp']['id'] ?>">
											<div class="col-md-6">
												<div class="form-group">
													<p for="">Target Capaian</p>
													<input type="number" value="<?= $kegiatan['pkp']['target_capaian'] ?>" class="form-control" disabled>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<p for="">Jumlah Sasaran</p>
													<input type="number" value="<?= $kegiatan['pkp']['jumlah_sasaran'] ?>" class="form-control" disabled>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<p for="">ABS</p>
													<input type="number" name="abs_<?= $kegiatan['id'] ?>" id="" class="form-control" value="" required>
												</div>
												<div class="form-group">
													<p for="">KOM</p>
													<input type="number" name="kom_<?= $kegiatan['id'] ?>" id="" class="form-control" value="" required>
												</div>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						<?php endforeach; ?>
						<div class="form-group">
							<button type="submit" class="btn btn-success"> Simpan Data PKP</button>
						</div>
					</form>
				</div>
			</div> <!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
