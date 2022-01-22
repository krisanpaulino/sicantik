<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-6 mt-4 ">
				<!-- Form Element sizes -->
				<div class="card card-success">
					<div class="card-header">
						<h3 class="card-title">Data Atribut</h3>
					</div>
					<div class="card-body">
						<?php $i = 1; ?>
						<?php foreach ($atribut as $k) : ?>

							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $k['nama_atribut']; ?></td>

							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					</div>

					<!-- /.card-body -->
				</div>
			</div>
			<div class="col-md-6 mt-4 ">
				<!-- Form Element sizes -->
				<div class="card card-success">
					<div class="card-header">
						<h3 class="card-title">Atribut Lain</h3>
					</div>
					<div class="card-body">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							<label class="form-check-label" for="defaultCheck1">
								Default checkbox
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
							<label class="form-check-label" for="defaultCheck2">
								Disabled checkbox
							</label>
						</div>
					</div>

					<!-- /.card-body -->
				</div>
			</div>
		</div>
	</div>
</div>
