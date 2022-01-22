 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
 	<!-- Brand Logo -->
 	<a href="index3.html" class="brand-link">
 		<img src="<?= base_url('assets/') ?>dist/img/ttu.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
 		<span class="brand-text font-weight-light">DINKES TTU</span>
 	</a>

 	<!-- Sidebar -->
 	<div class="sidebar">
 		<!-- Sidebar user panel (optional) -->
 		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
 			<div class="image">
 				<img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

 			</div>
 			<div class="info">
 				<a href="#" class="d-block"><?= $this->session->userdata('nama') ?>(<?= $this->session->userdata('role') ?>)</a>
 			</div>
 		</div>

 		<!-- SidebarSearch Form -->
 		<div class="form-inline">
 			<div class="input-group" data-widget="sidebar-search">
 				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
 				<div class="input-group-append">
 					<button class="btn btn-sidebar">
 						<i class="fas fa-search fa-fw"></i>
 					</button>
 				</div>
 			</div>
 		</div>

 		<!-- Sidebar Menu -->
 		<nav class="mt-2">
 			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
 				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
 				<li class="nav-item menu-open">
 					<a href="<?= base_url('admin') ?>" class="nav-link active">
 						<i class="nav-icon fas fa-tachometer-alt"></i>
 						<p>
 							Dashboard
 						</p>
 					</a>

 				</li>

 				<li class="nav-header"> KELOLA DATA</li>
 				<!-- <li class="nav-item">
 					<a href="<?= base_url() ?>admin/inputdata_kabupaten/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Data Kabupaten
 						</p>
 					</a>
 				</li> -->
 				<!-- <li class="nav-item">
 					<a href="<?= base_url() ?>admin/inputdata_kecamatan/" class="nav-link">
 						<i class="nav-icon far fa-image"></i>
 						<p>
 							Data Kecamatan
 						</p>
 					</a>
 				</li> -->
 				<li class="nav-item">
 					<a href="<?= base_url('admin/inputdata_puskesmas/') ?>" class="nav-link">
 						<i class="fa fa-plus-square" aria-hidden="true"></i>
 						<p>
 							Data Puskesmas
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('admin/input_periode/') ?>" class="nav-link">
 						<i class="fa fa-plus-square" aria-hidden="true"></i>
 						<p>
 							Data Periode
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('admin/inputdata_operator/') ?>" class="nav-link">
 						<i class="fa fa-user-md" aria-hidden="true"></i>
 						<p>
 							Data Operator
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url("/adm/obat") ?>" class="nav-link">
 						<i class="fa fa-plus-square" aria-hidden="true"></i>
 						<p>Data Obat</p>
 					</a>
 				</li>

 				<!-- <li class="nav-header">INPUT ELEMEN DATA</li>
 				<li class="nav-item">
 					<a href="#" class="nav-link">
 						<i class="nav-icon fas fa-file"></i>
 						<p>
 							Input Data
 							<i class="fas fa-angle-left right"></i>
 						</p>
 					</a>
 					<ul class="nav nav-treeview"> -->

 				<!-- <li class="nav-item">
 							<a href="<?= base_url("/adm/data/apotik") ?>" class="nav-link">
 								<i class="far fa-circle nav-icon"></i>
 								<p>Elemen Data Apotik</p>
 							</a>
 						</li> -->
 				<!-- <li class="nav-item">
 							<a href="<?= base_url('adm/data/usia') ?>" class="nav-link">
 								<i class="far fa-circle nav-icon"></i>
 								<p>Rentang Usia</p>
 							</a>
 						</li> -->
 				<!-- 
 					</ul>
 				</li> -->

 				<!-- <li class="nav-item">
 					<a href="<?= base_url('/adm/data/index/penyakit') ?>" class="nav-link">
 						<i class="nav-icon fas fa-file"></i>
 						<p>Kelola Data umum </p>
 					</a>
 				</li> -->

 				<li class="nav-header">Data Laporan </li>
 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/pilih_laporan/" class="nav-link">
 						<i class="fa fa-stethoscope" aria-hidden="true"></i>
 						<p>
 							Laporan Data Umum
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('adm/data/data_apotik') ?>" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>Laporan Data Apotik</p>
 					</a>
 				</li>

 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/tbprogram/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Laporan TB Program
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/stp/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Laporan STP
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/dbdfilca/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Laporan DBD FILCA
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/ptm/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Laporan PTM
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/pkp/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Laporan PKP
 						</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url() ?>adm/data/data_inspeksi/" class="nav-link">
 						<i class="fa fa-medkit" aria-hidden="true"></i>
 						<p>
 							Laporan Inspeksi TTU & TPM
 						</p>
 					</a>
 				</li>

 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>
