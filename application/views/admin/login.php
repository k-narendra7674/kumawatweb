<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Login</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url(); ?>public/assets1/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link
	href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url(); ?>public/assets1/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6"><img src="<?php echo base_url(); ?>public/assets1/img/loginpage.jpg" class=" w-100 h-100" alt=""></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
									</div>

									<div>
										<?php
										if(!empty($this->session->flashdata('msg'))){
											echo "<div class='text-success mb-3'>". $this->session->flashdata('msg')."</div>";
										}
										?>
									</div>
									<!-- /.login-logo -->
									<div class="card">
										<div class="card-body login-card-body">
											<p class="login-box-msg">Sign in to start your session</p>

											<form action="<?php echo base_url().'authenticate'; ?>" method="post" name="loginForm" id="loginForm">
												<div class="input-group mb-3">
													<div class="input-group-append">
														<div class="input-group-text">
															<span class="fas fa-envelope text-blue"></span>
														</div>
													</div>
													<input type="text" name="username" id="username" class="form-control" placeholder="UserName">
												</div>
												<?php echo form_error('username', '<div class="text-danger pb-3">', '</div>'); ?>


												<div class="input-group mb-3">
													<div class="input-group-append">
														<div class="input-group-text">
															<span class="fas fa-lock text-blue"></span>
														</div>
													</div>
													<input type="password" name="password" id="password" class="form-control" placeholder="Password">
												</div>
												<?php echo form_error('password', '<div class="text-danger pb-3">', '</div>'); ?>


												<div class="row">
													<div class="col-8">
														<div class="icheck-primary">
															<input type="checkbox" id="remember">
															<label for="remember">
																Remember Me
															</label>
														</div>
													</div>
													<!-- /.col -->
													<div>
														<button type="submit" class="btn btn-primary btn-block">Sign In</button>
													</div>
													<!-- /.col -->
												</div>
											</form>
										</div>
										<!-- /.login-card-body -->
									</div>
									<div class="text-center">
										<a class="small" href="<?php echo base_url(); ?>register">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url(); ?>public/assets1/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url(); ?>public/assets1/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php echo base_url(); ?>public/assets1/js/sb-admin-2.min.js"></script>

</body>

</html>