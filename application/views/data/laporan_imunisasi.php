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
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Puskesmas</th>
										<?php foreach ($data_imunisasi as $imunisasi) : ?>
											<th><?= $imunisasi['nama_imunisasi'] ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_puskesmas as $puskesmas) : ?>
										<tr>
											<td><?= $puskesmas['nama_puskesmas'] ?></td>
											<?php foreach ($puskesmas['data_imunisasi'] as $imunisasi) : ?>
												<?php if ($imunisasi['detail'] != null) : ?>
													<td><?= $imunisasi['detail']['l'] ?></td>
													<td><?= $imunisasi['detail']['p'] ?></td>
													<td><?= $imunisasi['detail']['l'] + $imunisasi['detail']['p'] ?></td>
												<?php else : ?>
													<td></td>
													<td></td>
													<td></td>
												<?php endif; ?>
											<?php endforeach; ?>
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
