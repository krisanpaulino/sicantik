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
					<!-- jquery validation -->
					<div class="card card-white">
						<div class="card-body">
							<form action="<?= base_url() ?>adm/data/store_elemen_data_apotik" method="post">
								<input type="hidden" name="id_kategori" class="d-none" value="<?= $id_kategori ?>">
								<?php for ($i = 1; $i <= $jumlah; $i++) : ?>
									<div class="form-group">
										<label for="nama_elemen">Nama Elemen Data <?= $i ?></label>
										<input type="text" name="nama_elemen[]" id="" class="form-control">
									</div>
								<?php endfor; ?>
								<div class="form-group">
									<button type="submit" class="btn btn-success">Simpan</button>
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
