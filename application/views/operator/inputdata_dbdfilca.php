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
					<div class="card card-white">
						<div class="card-body">
							<form action="<?= base_url() ?>operator/store_dbdfilca" method="post">
								<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
								<div class="form-group">
									<label for="">Jumlah Desa</label>
									<input type="number" name="jumlah_desa" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Jumlah Desa Diberi Obat</label>
									<input type="number" name="jumlah_desa_diberi_obat" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Jumlah Penduduk</label>
									<input type="number" name="jumlah_penduduk" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Jumlah Sasaran</label>
									<input type="number" name="jumlah_sasaran" id="" class="form-control">
								</div>
								<?php foreach ($data_usia as $usia) : ?>
									<input type="hidden" name="id_usia[]" value="<?= $usia['id'] ?>">
									<div class="form-group">
										<label for=""><?= $usia['rentang_usia'] ?></label>
										<input type="number" name="l_<?= $usia['id'] ?>" id="" class="form-control" placeholder="Laki-Laki" required>
										<input type="number" name="p_<?= $usia['id'] ?>" id="" class="form-control" placeholder="Perempuan" required>
									</div>
								<?php endforeach; ?>
								<div class="form-group">
									<button type="submit" class="btn btn-success">
										Simpan
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

</div><!-- /.container-fluid -->
