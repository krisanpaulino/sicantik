<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Selamat datang <?=$profil['nama']?> Operator <?=$profil['nama_puskesmas']?></h1>
					<label">Silahkan menginput data dengan benar, data yang akan diinput secara otomatis akan direkam, semangat!!! </label>
					<hr>
				</div><!-- /.col -->
				
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?=$judul?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		
		<div class="container-fluid">
			
		 
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Obat</h3>

                <p>Data Obat</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="<?=base_url('operator/data_obat')?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Apotik</h3>

                <p>Data Apotik</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="<?=base_url('operator/data_apotik')?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
				<?php foreach ($list_data as $data) : ?>
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<h3><?= $data['nama_data'] ?></h3>

								<p>Data <?= $data['nama_data'] ?></p>
							</div>
							<div class="icon">
								<i class="ion ion-clipboard"></i>
							</div>
							<a href="<?= base_url() ?>operator/data/<?= $data['id'] ?>" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
	</section>
	<!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
