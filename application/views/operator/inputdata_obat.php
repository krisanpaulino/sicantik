<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					
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
					<form action="<?= base_url() ?>operator/store_data_obat" method="post">
						<input type="hidden" name="id_sesi" value="<?= $sesi ?>">
						<div class="card">
							<div class="card-header">
								<h3>Input Data Obat</h3>
							</div>
							<div class="card-body">
								<?php foreach ($data_obat as $obat) : ?>
									<label><?= $obat['nama_obat'] ?></label>

									<div class="form-inline text-small">
										<input type="text" name="" id="" value="<?= $obat['satuan'] ?>" class="form-control mr-2 mb-2" disabled>
										<input type="hidden" name="id_obat[]" value="<?= $obat['id'] ?>">
										<input type="number" name="jumlah_pemakaian_obat[]" id="" class="form-control mr-2 mb-2" placeholder="Jumlah Pemakaian Obat" required>
										<input type="number" name="stok_awal[]" id="" class="form-control mr-2 mb-2" placeholder="Stok Awal" required>
										<input type="number" name="diterima[]" id="" class="form-control mr-2 mb-2" placeholder="Yang Diterima" required>
										<input type="number" name="ketersediaan[]" id="" class="form-control mr-2 mb-2" placeholder="Ketersediaan" required>
										<input type="number" name="sisa_stok[]" id="" class="form-control mr-2 " placeholder="Sisa Stok" required>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="form-group ml-4">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!--/.col (right) -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
