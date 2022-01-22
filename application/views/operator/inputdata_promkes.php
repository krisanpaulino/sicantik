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
					<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#inputModal">
						+ Input Data
					</button>
					<div class="card card-white">
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Bulan</th>
										<th>Tahun</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($list_data)) { ?>
										<?php foreach ($list_data as $data) : ?>
											<tr>
												<td><?= $data['nama_bulan'] ?></td>
												<td><?= $data['tahun'] ?></td>
												<td>
													<a href="<?= base_url() ?>operator/laporan_data_apotik/<?= $data['id'] ?>/<?= $data['id_sesi'] ?>" class="badge badge-primary">Lihat</a>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="inputModalLabel">Pilih Periode</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url() ?>operator/to_inputdata_promkes/" method="post">
									<div class="modal-body">
										<div class="form-group">
											<select name="sesi" id="" class="custom-select" required>
												<option value="">Pilih Sesi</option>
												<?php foreach ($sesi as $s) : ?>
													<option value="<?= $s['id'] ?>"><?= $s['nama_bulan'] ?> <?= $s['tahun'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Input Data</button>
									</div>
								</form>
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
