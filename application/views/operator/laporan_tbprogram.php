<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h2><?= $judul ?></h2>
					<h3>Bulan : <?= $sesi['nama_bulan'] ?> <?= $sesi['tahun'] ?></h3>
					<h3><?= $this->session->userdata('profil')['nama_puskesmas']; ?></h3>
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
				<div class="col-lg-12">
					<a type="button" class="btn btn-info" href="<?= base_url('operator/laporan_tb_program_exel/' . $sesi['id']) ?>">Cetak</a>
				</div>
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered" id="dtable1">
								<thead>
									<tr>
										<th rowspan="2">Nama Pasien</th>
										<th rowspan="2">JK</th>
										<th rowspan="2">Umur</th>
										<th rowspan="2">Tgl Mulai Pengobatan</th>
										<th rowspan="2">Jenis</th>
										<th rowspan="2">Tipe</th>
										<th rowspan="2">Hasil PX HIV</th>
										<th colspan="4">Hasil Pemeriksaan Lab</th>
										<th rowspan="2">Tgl Selesai Berobat</th>
										<th rowspan="2">Status</th>
									</tr>
									<tr>
										<th>Awal</th>
										<th>Bulan Ke-2/3</th>
										<th>Bulan Ke-5/6</th>
										<th>AP</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_tbprogram as $data) : ?>
										<tr>
											<td><?= $data['nama_pasien'] ?></td>
											<td><?= $data['jk_pasien'] ?></td>
											<td><?= $data['umur_pasien'] ?></td>
											<td><?= $data['tanggal_mulai'] ?>/<?= $data['bulan_mulai'] ?>/<?= $data['tahun_mulai'] ?></td>
											<td><?= $data['jenis_tb'] ?></td>
											<td><?= $data['tipe_tb'] ?></td>
											<td><?= $data['hasil_hiv'] ?></td>
											<td><?= $data['lab_awal'] ?></td>
											<td><?= $data['lab_2'] ?></td>
											<td><?= $data['lab_3'] ?></td>
											<td><?= $data['lab_ap'] ?></td>
											<td><?= $data['tanggal_selesai'] ?>/<?= $data['bulan_selesai'] ?>/<?= $data['tahun_selesai'] ?></td>
											<td><?= $data['status'] ?></td>
										</tr>
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
