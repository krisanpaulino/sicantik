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
				<div class="text-right">
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_data_apotik_exel/' . $sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Elemen Data</th>
										<th>Jumlah Pemakaian Obat</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kategori_data as $kategori) : ?>
										<tr>
											<th><?= $kategori['nama_kategori'] ?></th>
										</tr>
										<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
											<tr>
												<td><?= $elemen['nama_elemen'] ?></td>
												<td><?= $elemen['detail_elemen_data']['jumlah_pemakaian_obat'] ?></td>
											</tr>
										<?php endforeach; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
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
