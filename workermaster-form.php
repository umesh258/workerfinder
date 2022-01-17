<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';

if(isset($_POST['wsubmit'])){


  $name = mysqli_real_escape_string($con,$_POST['wname']);
  
  $email = mysqli_real_escape_string($con,$_POST['wemail']);
  
  $pass = mysqli_real_escape_string($con,$_POST['pass']);
  $gender = mysqli_real_escape_string($con,$_POST['gender']);
  $dob = mysqli_real_escape_string($con,$_POST['dob']);
  $address = mysqli_real_escape_string($con,$_POST['address']);
  $filepath = $_FILES['photo']['name'];
  $filelocation= $_FILES['photo']['tmp_name'];
  $area = $_POST['area'];
  $category = $_POST['category'];
  $exp = mysqli_real_escape_string($con,$_POST['exp']);
  $abt = mysqli_real_escape_string($con,$_POST['abt']);
  $time = mysqli_real_escape_string($con,$_POST['time']);
  $charges = mysqli_real_escape_string($con,$_POST['charges']);
  
  if($filelocation)
  {
      move_uploaded_file($filelocation,"workerimg/".$filepath);
      $iq = mysqli_query($con,"insert into tbl_workermaster (worker_name,worker_email,worker_password,worker_gender,worker_dob,worker_address,area_id,category_id,worker_photo,worker_exp,worker_aboutme,worker_time,worker_charge) 
      values('{$name}','{$email}','{$pass}','{$gender}','{$dob}','{$address}','{$area}','{$category}','{$filepath}','{$exp}','{$abt}','{$time}','{$charges}')")or die("Error insertq".mysqli_error($con));
        if($iq)
        {
            echo "<script>alert('Record Inserted');</script>";
        }else
        {
            echo "<script>alert('Cant save the records');</script>";
        }    
    }else
    {
        echo "<script>alert('Please Inser Image!');</script>";
    }

  
      
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Worker Form</title>

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
            <h1>Worker Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Worker Form</li>
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
                <h3 class="card-title">Worker</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="wname" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Email</label>
                    <input type="email" name="wemail" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Password</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <input type="radio" name="gender" value="1"  id="exampleInputEmail1">Male
                    <input type="radio" name="gender" value="0"  id="exampleInputEmail1">Female
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">DOB</label>
                    <input type="date" name="dob" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Address</label>
                    <textarea type="text" name="address" class="form-control" id="exampleInputName1" placeholder="Enter Address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
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
                  <div class="form-group">
                    <label for="exampleInputPassword1">Area</label>
                    <select name="area">
                  
                  <?php
                        $asq = mysqli_query($con,"select * from tbl_area")or die("Error areaselectq".mysqli_error($con));
                        while($afr = mysqli_fetch_array($asq))
                        {
                        echo "<option value='{$afr['area_id']}'>{$afr['area_name']}</option>";
                        }
                  ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Category</label>
                    <select name="category">
                  
                  <?php
                        $csq = mysqli_query($con,"select * from tbl_category")or die("Error cateselectq".mysqli_error($con));
                        while($cfr = mysqli_fetch_array($csq))
                        {
                        echo "<option value='{$cfr['category_id']}'>{$cfr['category_name']}</option>";
                        }
                  ?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Experiance</label>
                    <textarea type="text" name="exp" class="form-control" id="exampleInputName1" placeholder="Enter Experiance"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Aboutme</label>
                    <textarea type="text" name="abt" class="form-control" id="exampleInputName1" placeholder="Enter Aboutme"></textarea>
                  </div>
                          
                  <div class="form-group">
                    <label for="exampleInputName1">Time</label>
                    <input type="time" name="time" class="form-control" id="exampleInputName1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Charges</label>
                    <input type="number" name="charges" class="form-control" id="exampleInputName1" placeholder="Enter Charges">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="wsubmit" class="btn btn-primary">Submit</button>
                  <input type="button" value="Display" class="btn btn-primary" onclick="window.location='workermaster-display.php';">
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
