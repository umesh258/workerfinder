<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';

if(isset($_POST['bsubmit'])){

  $cdate = date("d-m-Y");
  $uid = mysqli_real_escape_string($con,$_POST['user']);
  $wid = mysqli_real_escape_string($con,$_POST['worker']);
  $bdate = mysqli_real_escape_string($con,$_POST['date']);
  $time = mysqli_real_escape_string($con,$_POST['time']);
  $pblm = mysqli_real_escape_string($con,$_POST['pblm']);
  $filepath = $_FILES['photo']['name'];
  $filelocation = $_FILES['photo']['tmp_name'];

  $iq = mysqli_query($con,"insert into tbl_bookingmaster (date,user_id,worker_id,book_date,book_time,book_problemdetails,book_photo,status) values('{$cdate}','{$uid}','{$wid}','{$bdate}','{$time}','{$pblm}','{$filepath}','pending')")or die("Error insertq".mysqli_error($con));

  if($iq)
  {
     move_uploaded_file($filelocation,"bookingimg/".$filepath);
      
    
        echo "<script>alert('Record Inserted');</script>";
      
      
  }

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Form</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
    <?php

    require './themeportion/menu.php';
    require './themeportion/sidebar.php';
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Booking Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Booking Form</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Booking</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName1">User Name</label>
                    <select name="user">
                      <?php 
                        $usq = mysqli_query($con,"select * from tbl_usermaster")or die("Error usq".mysqli_error($con));
                        while($fusq = mysqli_fetch_array($usq))
                        {
                          echo "<option value='{$fusq['user_id']}'>{$fusq['user_name']}</option>";
                        }
                        
                      ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Worker Name</label>
                    <select name="worker">
                      <?php 
                        $wsq = mysqli_query($con,"select * from tbl_workermaster")or die("Error wsq".mysqli_error($con));
                        while($fwsq = mysqli_fetch_array($wsq))
                        {
                          echo "<option value='{$fwsq['worker_id']}'>{$fwsq['worker_name']}</option>";
                        }
                        
                      ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Book Date</label>
                    <input type="date" name="date" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Book Time</label>
                    <input type="time" name="time" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Problemdetails</label>
                    <input type="text" name="pblm"  class="form-control" id="exampleInputPassword1">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="bsubmit" class="btn btn-primary">Submit</button>
                  <input type="button" value="Display" class="btn btn-primary" onclick="window.location='bookingmaster-display.php';">
                </div>
              </form>
            </div>
            <!-- /.card -->
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

    require './themeportion/footer.php';
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
