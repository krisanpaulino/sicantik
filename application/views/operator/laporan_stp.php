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
				<div class="col-lg-12">
					<div class="card card-white">
						<div class="card-body" style="overflow-x: scroll; overflow-y: scroll; height: 500px">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th rowspan="2">Jenis Penyakit</th>
										<?php foreach ($usia_stp as $usia) : ?>
											<th colspan="2"><?= $usia['rentang_usia'] ?></th>
										<?php endforeach; ?>
										<th colspan="2">Total</th>
										<th rowspan="2">Total Kunjungan</th>
									</tr>
									<tr>
										<?php foreach ($usia_stp as $usia) : ?>
											<th>L</th>
											<th>P</th>
										<?php endforeach; ?>
										<th>L</th>
										<th>P</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_stp as $data) : ?>
										<tr>
											<td><?= $data['nama_data'] ?></td>
											<?php $l = 0;
											$p = 0; ?>
											<?php foreach ($data['usia'] as $usia) : ?>
												<td><?= $usia['l'] ?></td>
												<td><?= $usia['p'] ?></td>
												<?php $l += $usia['l'];
												$p += $usia['p']; ?>
											<?php endforeach; ?>
											<td><?= $l ?></td>
											<td><?= $p ?></td>
											<td><?= $l + $p ?></td>
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
