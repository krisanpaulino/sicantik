 <div class=" container">

 	<!-- Outer Row -->
 	<div class="row justify-content-center">

 		<div class=" col-lg-7 ">
 			<div class="card o-hidden border-0 shadow-lg my-5">
 				<div class="login1-handry card-body p-0">
 					<!-- Nested Row within Card Body -->
 					<div class="row">
 						<div class="col-lg">
 							<div class="p-5">
 								<div class="text-center">
 									<img src="assets/dist/img/ttu.png" class="img img-responsive" style="width: 20%;" alt="User Image">
 								</div>
 								<div class="text-center">
 									<h1 class="h4 text-dark mb-1">SICANTIK-BAW</h1>
 									<p class="text-dark mb-4"> Sistem Pencatatan dan Informasi Kesehatan bebasis Web</p>
 								</div>
 								<?= $this->session->flashdata('message');  ?>
 								<form class="user" method="post" action="<?= base_url('auth'); ?>">
 									<div class="input-group mb-3">
 										<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">

 										<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
 										<div class="input-group-append">
 											<div class="input-group-text">
 												<span class="fas fa-envelope"></span>
 											</div>
 										</div>
 									</div>
 									<div class="input-group mb-3">
 										<input type="password" class="form-control" id="password" name="password" placeholder="Password">
 										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
 										<div class="input-group-append">
 											<div class="input-group-text">
 												<span class="fas fa-lock"></span>
 											</div>
 										</div>
 									</div>
 									<button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
 									<hr>
 								</form>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>

 	</div>

 </div>
