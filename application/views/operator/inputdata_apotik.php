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
				<form action="<?= base_url() ?>operator/store_data_apotik" method="post">
					<input type="hidden" name="id_sesi" value="<?= $sesi ?>">
					<?php foreach ($kategori_data_apotik as $kategori) : ?>
						<div class="col-md-12">
							<!-- jquery validation -->
							<div class="card card-white">
								<div class="card-header"><?= $kategori['nama_kategori'] ?></div>
								<div class="card-body">
									<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
										<div class="row">
											<div class="col-md-12">
												<input type="hidden" name="id_elemen_data[]" value="<?= $elemen['id'] ?>" class="d-none">
												<label><?= $elemen['nama_elemen'] ?></label>
												<input type="text" name="jumlah_pemakaian_obat_<?= $elemen['id'] ?>" id="" class="form-control">
											</div>
											<div class="col-md-12">
												<div class="form-group d-flex d-inline">

												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
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
