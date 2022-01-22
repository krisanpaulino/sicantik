<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#inputModal">
					+ Input Data
				</button>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Tahun</th>
							<th>Bulan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_pkp as $pkp) : ?>
							<tr>
								<td><?= $pkp['nama_bulan'] ?></td>
								<td><?= $pkp['tahun'] ?></td>
								<td><a href="<?= base_url() ?>adm/data/laporan_pkp/<?= $pkp['id'] ?>" class="badge badge-primary">Lihat Detail</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
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
						<form action="<?= base_url() ?>adm/data/to_inputpkp" method="post">
							<div class="modal-body">
								<div class="form-group">
									<select name="sesi" id="" class="custom-select" required>
										<option value="">Pilih Sesi</option>
										<?php foreach ($data_sesi as $s) : ?>
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
	</div>
</div>
