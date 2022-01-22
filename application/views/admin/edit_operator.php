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
				<div class="col-md-4 col-sm-8">
					<div class="card card-white">
						<div class="card-header"><b>Foto Profil</b></div>
						<div class="card-body">
							<img src="<?= base_url('assets/dist/img/puskesmas/') . $operator['foto']; ?>" alt="" class="img img-thumbnail mb-2">
							<form action="<?= base_url() ?>admin/update_foto_operator" method="post" enctype="multipart/form-data">
								<input type="hidden" name="id" class="d-none" value="<?= $operator['id'] ?>">
								<div class="form-group">
									<label for="fotopost">Ganti Foto Profil</label>
									<input type="file" name="fotopost" id="" class="form-control">
								</div>
								<button type="submit" class="btn btn-primary">Ganti Foto</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<!-- jquery validation -->
					<div class="card card-white">
						<!-- /.card-header -->
						<div class="row">
							<div class="col-lg">
								<!-- <?= form_error('nama_puskesmas_kota', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
								<?= form_error('jenis', '<div class="alert alert-danger" role="alert">', '</div>'); ?> -->
								<?= $this->session->flashdata('message'); ?>
								<div class="card-header">
									<b>Data Diri</b>
								</div>
								<div class="card-body">
									<form action="<?= base_url('admin/update_operator'); ?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?= $operator['id'] ?>">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Nama Operator</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="nama" name="nama" value="<?= $operator['nama'] ?>">
												<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-2"></div>
											<div class="col-sm-5">
												<label class="col-form-label">Tempat Lahir</label>
												<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $operator['tempat_lahir'] ?>">
												<?= form_error('tempat_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>

											<div class="col-sm-5">
												<label class="col-form-label">Tanggal Lahir</label>
												<input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $operator['tanggal_lahir'] ?>">
												<?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-sm-2 col-form-label">NIP</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="nip" name="nip" value="<?= $operator['nip'] ?>">
												<?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
											<div class="col-sm-10">
												<select name="jenis_kelamin" id="" class="custom-select">
													<option value="Laki-Laki" <?= ($operator['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki - Laki</option>
													<option value="Perempuan" <?= ($operator['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
												</select>
												<?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">No HP</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $operator['no_hp'] ?>">
												<?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Alamat</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $operator['alamat'] ?>">
												<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Puskesmas</label>
											<div class="col-lg">
												<select name="id_puskesmas" id="id_puskesmas" class="form-control">
													<option value="">Pilih Puskesmas</option>
													<?php foreach ($data_puskesmas as $p) : ?>
														<option value="<?= $p['id'] ?>" <?= ($operator['id_puskesmas'] == $p['id']) ? 'selected' : '' ?>>
															<?= $p['nama_puskesmas'] ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group text-right">
											<button type="submit" class="btn btn-primary">Update Data Operator</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>

				<!-- <div class="col-md-12"> -->

				<!-- </div> -->
				<!--/.col (right) -->
			</div>
			<div class="row d-flex justify-content-end">
				<div class="col-md-8">
					<div class="card card-white col-lg">
						<div class="card-header"><b>Reset Password</b></div>
						<div class="card-body">
							<form action="<?= base_url() ?>admin/reset_password" method="post" enctype="multipart/form-data">
								<input type="hidden" name="id" class="d-none" value="<?= $operator['id_user'] ?>">
								<div class="form-group">
									<label for="fotopost">Password baru</label>
									<input type="password" name="password1" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="fotopost">Konfirmasi Password baru</label>
									<input type="password" name="password1" id="" class="form-control">
								</div>
								<button type="submit" class="btn btn-primary" onclick="return confirm('yakin ingin reset password?')">Reset</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
