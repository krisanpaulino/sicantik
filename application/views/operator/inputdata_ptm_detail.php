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
				<!-- <form action="<?= base_url() ?>operator/store_data_apotik" method="post">
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
		</form> -->
		<!--/.col (right) -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Hipertensi</h5> -->

					<p>Hipertensi</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/ptm') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Penyakit Jantung Koroner</h5> -->

					<p>Penyakit Jantung Koroner</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Diabetes Melitus (Kencing Manis)</h5> -->

					<p>Diabetes Melitus (Kencing Manis)</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Obesitas</h5> -->

					<p>Obesitas</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Penyakit Tiroid</h5> -->

					<p>Penyakit Tiroid</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Stroke</h5> -->

					<p>Stroke</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Asma</h5> -->

					<p>Asma</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>PPOK</h5> -->

					<p>PPOK</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Osteoporosis</h5> -->

					<p>Osteoporosis</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Penyakit Ginjal Kronistensi</h5> -->

					<p>Penyakit Ginjal Kronistensi</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Tumor Payudara</h5> -->

					<p>Tumor Payudara</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Retinoblastoma</h5> -->

					<p>Retinoblastoma</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Leukemia</h5> -->

					<p>Leukemia</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Lesi Pra Kanker Leher Rahim</h5> -->

					<p>Lesi Pra Kanker Leher Rahim</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Cedera Akibat Kecelakaan Lalu Lintas</h5> -->

					<p>Cedera Akibat Kecelakaan Lalu Lintas</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Cedera Akibat Kekerasan dalam Rumah Tangga</h5> -->

					<p>Cedera Akibat KDRT</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<!-- <h5>Cedera Akibat Lain</h5> -->

					<p>Cedera Akibat Lain</p>
				</div>
				<div class="icon">
					<i class="ion ion-clipboard"></i>
				</div>
				<a href="<?= base_url('operator/data_obat') ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- /.row -->
		</div><!-- /.container-fluid -->

	</section>
	<!-- /.content -->
</div>
