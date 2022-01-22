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
					<form class="form col-lg-12" action="<?= base_url() ?>operator/store_imunisasi" method="post" style="width: 100%;">
						<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
						<div class="card card-white">
							<div class="card-header">

							</div>
							<div class="card-body">
								<?php foreach ($form_imunisasi as $imunisasi) : ?>
									<input type="hidden" name="id_imunisasi[]" value="<?= $imunisasi['id'] ?>">
									<label for=""><?= $imunisasi['nama_imunisasi'] ?></label>
									<div class="row mb-4">
										<div class="col-md-6">
											<div class="form-group">
												<input type="number" name="l_<?= $imunisasi['id'] ?>" id="" class="form-control" placeholder="Laki - Laki" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="number" name="p_<?= $imunisasi['id'] ?>" id="" class="form-control" placeholder="Perempuan" required>
											</div>
										</div>
									</div>

								<?php endforeach; ?>
								<div class="form-group">
									<button type="submit" class="btn btn-success"> Simpan Data Imunisasi</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div> <!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
