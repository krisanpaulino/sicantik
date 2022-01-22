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
				<!-- left column -->
				<div class="col-md-4 col-sm-6">
					<div class="card card-white">
						<div class="card-header">
							<b>Ganti Foto</b>
						</div>
						<div class="card-body">
							<form action="<?= base_url() ?>admin/ganti_foto_puskesmas" enctype="multipart/form-data" method="post">
								<input type="hidden" name="id" value="<?= $puskesmas['id'] ?>" class="d-none">
								<img src="<?= base_url('assets/dist/img/puskesmas/') . $puskesmas['foto']; ?>" alt="" class="img-thumbnail mb-2">
								<div class="form-group">
									<input type="file" name="fotopost" id="" class="form-control">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Ganti Foto</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<!-- jquery validation -->
					<?= form_error('nama_puskesmas_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= form_error('jenis', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?= $this->session->flashdata('message'); ?>
					<div class="card card-white">
						<!-- /.card-header -->
						<div class="card-header">
							<b>Data Puskesmas</b>
						</div>
						<div class="card-body">
							<form action="<?= base_url('admin/update_puskesmas'); ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?= $puskesmas['id'] ?>" class="d-none">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Nama Puskesmas</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="nama_puskesmas" name="nama_puskesmas" value="<?= $puskesmas['nama_puskesmas'] ?>">
										<?= form_error('nama_puskesmas', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Alamat</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $puskesmas['alamat'] ?>">
										<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">No HP</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $puskesmas['no_telp'] ?>">
										<?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-primary">Ubah Data Puskesmas</button>
								</div>
							</form>
						</div>
					</div>
					<!-- /.card -->
				</div>


				<!--/.col (left) -->
				<!-- right column -->
				<div class="col-md-6">

				</div>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
