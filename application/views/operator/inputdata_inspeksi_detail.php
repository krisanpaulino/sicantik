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
					<form class="form col-lg-12" action="<?= base_url() ?>operator/store_inspeksi" method="post" style="width: 100%;">
						<input type="hidden" name="id_sesi" value="<?= $sesi['id'] ?>">
						<div class="card card-white">
							<div class="card-header">
								<h3>Total Kegiatan Pembinaan :</h3>
							</div>
							<div class="card-body">
								<label for="">Bulan Ini</label>
								<div class="form-inline">
									<input type="number" name="bulan_ini_jumlah" id="" class="form-control" placeholder="JUMLAH" required>
									<input type="number" name="bulan_ini_persen" id="" class="form-control" placeholder="%" required>
								</div> <br>
								<label for="">Kumulatif s.d bulan lalu</label>
								<div class="form-inline">
									<input type="number" name="kumulatif_bulan_lalu_jumlah" id="" class="form-control" placeholder="JUMLAH" required>
									<input type="number" name="kumulatif_bulan_lalu_persen" id="" class="form-control" placeholder="%" required>
								</div>
							</div>
						</div>
						<?php foreach ($jenis_sarana as $jenis) : ?>
							<div class="card card-white" style="width: 100%;">
								<div class=" card-header">
									<h3><?= $jenis['nama_jenis'] ?></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<?php foreach ($jenis['sarana'] as $sarana) : ?>
											<div class="col-lg-6">
												<h3 for=""><?= $sarana['nama_sarana'] ?></h3>

												<input type="hidden" name="id_sarana[]" value="<?= $sarana['id'] ?>">
												<?php foreach ($atribut_inspeksi as $atribut) : ?>
													<label for=""><?= $atribut['nama_atribut'] ?></label>
													<div class="form-inline">
														<input type="hidden" name="id_atribut_<?= $sarana['id'] ?>[]" value="<?= $atribut['id'] ?>">
														<input type="number" name="jumlah_<?= $sarana['id'] ?>_<?= $atribut['id'] ?>" id="" class="form-control" placeholder="Jumlah" required>
														<input type="number" name="persen_<?= $sarana['id'] ?>_<?= $atribut['id'] ?>" id="" class="form-control" placeholder="persentase" required>%
													</div>
												<?php endforeach; ?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

						<div class="col-lg-12">
							<div class="form-group">
								<button type="submit" class="btn btn-block btn-primary">Simpan Data</button>
							</div>
						</div>
					</form>
				</div>
			</div> <!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
