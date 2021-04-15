<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>public/assets1/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>public/assets1/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5"><img src="<?php echo base_url(); ?>public/assets1/img/loginpage.jpg" class=" w-100 h-100" alt=""></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <div class="container mt-5">
                <?php
                $msg = $this->session->flashdata('msg');
                if ($msg != "") {
                // echo "<div class='alert alert-success'>". $msg ."</div>";
                }
                ?>
              </div>
              <div class="row">
                <div class="col-10 offset-1">

                  <form id="register_form" action="<?php echo base_url(). 'register'; ?>" method="post">
                    <?php $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); ?>

                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control"
                        value="<?php echo set_value('username'); ?>" placeholder="Username" id="username">
                      </div>
                        <?php echo "<p>" . form_error('username'). "</p>"; ?>
                    </div>

                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" name="email" class="form-control"
                        value="<?php echo set_value('email'); ?>" placeholder="Email" id="email">
                      </div>
                        <p><?php echo form_error('email'); ?></p>
                    </div>

                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" name="password" class="form-control"
                        value="<?php echo set_value('password'); ?>" placeholder="password" id="password">
                      </div>
                        <?php echo form_error('password'); ?>
                    </div>

                    <div class="form-group">
                      <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" name="phone" class="form-control"
                        value="<?php echo set_value('phone'); ?>" placeholder="phone" id="phone">
                      </div>
                        <?php echo form_error('phone'); ?>
                    </div>

                    <div class="col-12 pt-3 text-center">
                      <button type="submit" class="btn btn-primary px-5 py-2">SIGN UP</button>
                    </div>

                  <!-- <div class="bg-primary text-center mt-3">
                    <button class="btn btn-primary btn-lg" type="button">SIGN UP</button>
                  </div> -->
                  <hr>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="<?php echo base_url(); ?>login" class="text-primary">Login</a>
                  </div>
                </form>
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