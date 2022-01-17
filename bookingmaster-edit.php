<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';

if(isset($_GET['eid']))
{
    $eid=$_GET['eid'];
    $sq = mysqli_query($con,"select * from tbl_bookingmaster where book_id='{$eid}'")or die("error in selectq".mysqli_error($con));
    $fr = mysqli_fetch_array($sq);
}

if(isset($_POST['bsubmit'])){

    $id = $_POST['id'];
  $udate = date("d-m-Y");
  $uid = mysqli_real_escape_string($con,$_POST['uid']);
  $wid = mysqli_real_escape_string($con,$_POST['wid']);
  $bdate = mysqli_real_escape_string($con,$_POST['date']);
  $pblm = mysqli_real_escape_string($con,$_POST['pblm']);
  $time = mysqli_real_escape_string($con,$_POST['time']);
  
  
    $uq = mysqli_query($con,"update tbl_bookingmaster set date='{$udate}',user_id='{$uid}',worker_id='{$wid}',book_date='{$bdate}',book_time='{$time}',book_problemdetails='{$pblm}' where book_id='{$id}'")or die("error updateq".mysqli_error($con));

    if($uq)
    {

        echo "<script>alert('Record Updated !');window.location='bookingmaster-display.php';</script>";

    }
    
        
      
      
  

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Edit Form</title>

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
            <h1>Booking Edit Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Booking Edit Form</li>
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
                    <label for="exampleInputName1"></label>
                    <input type="hidden" name="id" value="<?php echo $fr['book_id'] ?>" class="form-control" id="exampleInputName1" >
                  </div>
                
                <div class="form-group">
                    <label for="exampleInputName1">User ID</label>
                    <input type="number" name="uid" value="<?php echo $fr['user_id'] ?>" class="form-control" id="exampleInputName1" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Worker Id</label>
                    <input type="number" name="wid" value="<?php echo $fr['worker_id'] ?>" class="form-control" id="exampleInputEmail1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Book Date</label>
                    <input type="date" name="date" value="<?php echo $fr['book_date'] ?>" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Problemdetails</label>
                    <input type="text" name="pblm" value="<?php echo $fr['book_problemdetails'] ?>" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Book Time</label>
                    <input type="time" name="time" value="<?php echo $fr['book_time'] ?>" class="form-control" id="exampleInputPassword1">
                  </div>
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="bsubmit" class="btn btn-primary">Submit</button>
                  <input type="button" value="Cancel" class="btn btn-primary" onclick="window.location='bookingmaster-display.php';">
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
