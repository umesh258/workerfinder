<?php

session_start();

require './connection.php';
if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
if($_POST)
{
  $opass = mysqli_real_escape_string($con,$_POST['opass']);
  $npass = mysqli_real_escape_string($con,$_POST['npass']);
  $cpass = mysqli_real_escape_string($con,$_POST['cpass']);

  $sq = mysqli_query($con,"select * from tbl_admin where admin_id='{$_SESSION['id']}'")or die(mysqli_error($con));
  $fr = mysqli_fetch_array($sq);

  if($fr['admin_password'] == $opass)
  {
    if($npass == $cpass)
    {
      if($opass == $npass)
      {
        echo "<script>alert('Old and NewPassword Mustbe Different !');</script>";
      }else
      {
        $uq = mysqli_query($con,"update tbl_admin set admin_password='{$npass}' where admin_id='{$_SESSION['id']}'")or die(mysqli_error($con));
        if($uq)
        {
          echo "<script>alert('Password Change Successfully !');window.location='login.php';</script>";
        }
      }
    }else
    {
      echo "<script>alert('New and Confirm Password Mustbe same !');</script>";  
    }
  }else
  {
    echo "<script>alert('Old Password Does not match !');</script>";
  }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Change Password (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form method="post">
      <div class="input-group mb-3">
          <input type="password" name="opass" class="form-control" placeholder="Old Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="npass" class="form-control" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="cpass" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
