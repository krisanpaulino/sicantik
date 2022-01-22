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
 				<img src="<?= base_url('assets/dist/img/puskesmas/') . $profil['foto']; ?>" class="img-circle elevation-2" alt="User Image">

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
 					<a href="<?= base_url('operator') ?>" class="nav-link active">
 						<i class="nav-icon fas fa-tachometer-alt"></i>
 						<p>
 							Dashboard

 						</p>
 					</a>

 				</li>

 				<li class="nav-header"> DATA LAPORAN BULANAN</li>


 				<li class="nav-item">
 					<a href="<?= base_url('operator/data_ptm/') ?>" class="nav-link">
 						<i class="fas fa-medkit"></i>
 						<p>DATA PTM PUSKESMAS</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('operator/inspeksi_ttu_tpm/') ?>" class="nav-link">
 						<i class="fas fa-stethoscope"></i>
 						<p>DATA INSPEKSI DAN TPM</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('operator/data_dbdfilca/') ?>" class="nav-link">
 						<i class="fas fa-notes-medical"></i>
 						<p>DATA DBD & FILCA</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('operator/data_tbprogram/') ?>" class="nav-link">
 						<i class="fas fa-virus-slash"></i>
 						<p>DATA TB PROGRAM</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('operator/data_pkp/') ?>" class="nav-link">
 						<i class="fas fa-medkit"></i>
 						<p>DATA PKP</p>
 					</a>
 				</li>
 				<li class="nav-item">
 					<a href="<?= base_url('operator/data_imunisasi/') ?>" class="nav-link">
 						<i class="fas fa-stethoscope"></i>
 						<p>DATA IMUNISASI</p>
 					</a>
 				</li>





 			</ul>
 		</nav>
 		<!-- /.sidebar-menu -->
 	</div>
 	<!-- /.sidebar -->
 </aside>
