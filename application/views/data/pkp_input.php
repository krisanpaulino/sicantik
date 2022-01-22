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
					<form class="form col-lg-12" action="<?= base_url() ?>adm/data/store_pkp" method="post" style="width: 100%;">
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
										<?php if ($kegiatan['kelompok_kegiatan'] != null && $kelompok != $kegiatan['kelompok_kegiatan']) : ?>
											<h3 for=""><?= $kegiatan['kelompok_kegiatan'] ?></h3>
											<hr>
											<?php $kelompok = $kegiatan['kelompok_kegiatan'] ?>
										<?php endif; ?>
										<label for=""><strong><?= $kegiatan['nama_kegiatan'] ?></strong></label>
										<div class="row">

											<div class="col-md-6">
												<div class="form-group">
													<p>Target Capaian</p>
													<input type="number" name="target_capaian_<?= $kegiatan['id'] ?>" id="" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<p for="">Jumlah Sasaran</p>
													<input type="number" name="jumlah_sasaran_<?= $kegiatan['id'] ?>" id="" class="form-control">
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
