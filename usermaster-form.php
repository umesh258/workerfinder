<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';

if(isset($_POST['usubmit'])){

  $name = mysqli_real_escape_string($con,$_POST['uname']);
  $gender = $_POST['gender'];
  $email = mysqli_real_escape_string($con,$_POST['email']);
  $mb = $_POST['mb'];
  $address = mysqli_real_escape_string($con,$_POST['address']);
  $pass = mysqli_real_escape_string($con,$_POST['pass']);
  $city = $_POST['area'];
  

  $iq = mysqli_query($con,"insert into tbl_usermaster (user_name,user_gender,user_email,user_mobile,user_address,user_password,area_id) values('{$name}','{$gender}','{$email}','{$mb}','{$address}','{$pass}','{$city}')")or die("Error insertq".mysqli_error($con));

  if($iq)
  {
    
        echo "<script>alert('Record Inserted');</script>";
      }else
      {
        echo "<script>alert('Cant save the records');</script>";
      }
      
  }






?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Form</title>

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
            <h1>User Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Form</li>
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
                <h3 class="card-title">User Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="uname" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Gender</label>
                    <input type="radio" name="gender" value="0">Female
                    <input type="radio" name="gender" value="1" >Male
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mobile No</label>
                    <input type="number" name="mb" class="form-control" id="exampleInputPassword1" placeholder="Mobile">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <textarea type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="Address"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">City</label>
                    <select name="area">
                  <?php

                        $asq = mysqli_query($con,"select * from tbl_area")or die("Error in sq".mysqli_error($con));
                        while($afr=mysqli_fetch_array($asq))
                        {
                            echo "<option value='{$afr['area_id']}'>{$afr['area_name']}</option>";
                        }
                    ?>
                    </select>
                  </div>                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="usubmit" class="btn btn-primary">Submit</button>
                  <input type="button" value="Display" class="btn btn-primary" onclick="window.location='usermaster-display.php';">
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
