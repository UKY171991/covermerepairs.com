<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.min.css">

  <style type="text/css">
     .login-page{
        background: #23242a;
    }
     .login-box .card{
      overflow: hidden;
      justify-content: center;
      border-radius: 50px 5px;
      padding: 2px;
      background: #23242a;
     }
    .login-box .card::before{
      content: '';
      position: absolute;
      top: -80%;
      left: -50%;
      width: 370px;
      height: 450px;
      background: linear-gradient(60deg, #45f3ff, transparent);
      transform-origin: bottom right;
      animation: animate 2s linear infinite;
    }
    .login-box .card::after{
      content: '';
      position: absolute;
      top: -80%;
      left: -50%;
      width: 370px;
      height: 450px;
      background: linear-gradient(60deg, #d9138a, transparent);
      transform-origin: bottom right;
      animation: animate 2s linear infinite;
      animation-delay: -3s;
    }
    @keyframes animate{
      0%{
        transform: rotate(0deg);
      }
      100%{
        transform: rotate(360deg);
      }

    }
    .form{
/*      position: absolute;*/
      inset: 2px;
      border-radius: 50px 5px;
      background: #28292d;
      z-index: 10;
      padding: 30px 30px 30px 30px;
      flex-direction: column;

    }

  </style>
</head>
<body class="hold-transition login-page" style="background-image: url(<?=base_url('assets/custom/last.jpg')?>); background-repeat: no-repeat; background-size: cover;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-primary">
    <div class="form" style="background-image: url(<?=base_url('assets/custom/3333.jpg')?>); background-repeat: no-repeat; background-size: cover;">
    <div class="card-header text-center">
      <a href="<?= base_url();?>assets/index2.html" class="h1 text-light">Admin Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg text-light">Sign in to start your session</p>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

      <form action="<?php echo base_url('login/do_login'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>assets/dist/js/adminlte.min.js"></script>
</body>
</html>
