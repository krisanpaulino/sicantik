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
				 <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Total Kegiatan Promosi Kesehatan</h3>
              </div>
              <div class="card-body">
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Bulan ini</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Kumulatif s.d. bulan lalu</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
 
 						<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Materi Promosi Kesehatan  </h3>
              </div>
              <div class="card-body">
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Diare</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">DBD</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Imun</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">VIT A</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">GIZI/GAKI</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">KIA/KB</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">TBC</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Malaria</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Ispa</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Kesling</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Kes.Gigi</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">HIV/AIDS</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Saran Air Bersih</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">PMS</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">KESPRO/NAPZA</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">ISPA & Pneumonia</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
				</div>
				 <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Lokasi </h3>
              </div>
              <div class="card-body">
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Puskesmas</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Pustu</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Poskesdes</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Posyandu</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Pemukiman Warga</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-6 col-form-label">Institusi Pendidikan</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
 							<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Jenis Kegiatan/Penyuluhan </h3>
              </div>
              <div class="card-body">
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Penyuluhan individu</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Penyuluhan Keluarga</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Penyuluhan Masyarakat</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
								 <div class="form-group row">
  								<label for="" class="col-sm-5 col-form-label">Penyuluhan institusi</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="" placeholder="input jlh">
                    </div>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- Form Element sizes -->
           
            <!-- /.card -->

				
           

				</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
