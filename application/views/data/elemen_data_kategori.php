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
							<div class="row">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kategoriModal">
									+ Tambah Kategori
								</button>
							</div>

							<div class="row mt-4">
								<div class="col-lg-12">
									<form action="<?= base_url() ?>adm/data/tambah_elemen" method="post">
										<input type="hidden" name="id_data" value="<?= $id_data ?>">
										<div class="form-group">
											<label for="id_kategori">Kategori Elemen Data </label>
											<select name="id_kategori" id="" class="custom-select" required>
												<option value="">Pilih Kategori</option>
												<?php foreach ($kategori as $k) { ?>
													<option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label for="jumlah">Jumlah Elemen Data yang Ingin di Input</label>
											<input type="number" name="jumlah" id="" class="form-control">
										</div>
										<div class="form-group">
											<input type="submit" value="Selanjutnya" class="btn btn-success">
										</div>
									</form>
								</div>
							</div>
							<div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="kategoriModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="<?= base_url() ?>adm/data/store_kategori" method="post">
											<input type="hidden" name="id_data" value="<?= $id_data ?>">
											<div class="modal-body">
												<div class="form-group">
													<label for="nama_kategori">Nama Kategori Elemen Data</label>
													<input type="text" name="nama_kategori" id="" class="form-control">
												</div>


											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<input type="submit" class="btn btn-primary" value="Simpan">
										</form>
									</div>
								</div>
							</div>
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
