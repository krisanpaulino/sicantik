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
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?= $judul ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg">
					<div class="card card-white">
						<div class="card-body">
							<form action="<?= base_url() ?>adm/obat/update_obat" method="post">
								<input type="hidden" name="id" value="<?= $obat['id'] ?>">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Nama Obat</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="nama_obat" value="<?= $obat['nama_obat'] ?>" name="nama_obat">
										<?= form_error('nama_obat', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Satuan</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="satuan" name="satuan" value="<?= $obat['satuan'] ?>">
										<?= form_error('satuan', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-primary">Ubah Data</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
