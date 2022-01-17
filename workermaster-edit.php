<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';

$eid = $_GET['eid'];

$sq = mysqli_query($con,"select * from tbl_workermaster where worker_id='{$eid}'")or die("Error sq".mysqli_error($con));
$fr = mysqli_fetch_array($sq);

if(isset($_POST['wsubmit'])){


  $id = $_POST['id'];    
  $name = mysqli_real_escape_string($con,$_POST['wname']);
  $email = mysqli_real_escape_string($con,$_POST['wemail']);
  $pass = mysqli_real_escape_string($con,$_POST['pass']);
  $gender = mysqli_real_escape_string($con,$_POST['gender']);
  $category = mysqli_real_escape_string($con,$_POST['category']);
  $area = mysqli_real_escape_string($con,$_POST['area']);
  $dob = mysqli_real_escape_string($con,$_POST['dob']);
  $address = mysqli_real_escape_string($con,$_POST['address']);
  $filepath = $_FILES['photo']['name'];
  $filelocation= $_FILES['photo']['tmp_name'];
 
  $exp = mysqli_real_escape_string($con,$_POST['exp']);
  $abt = mysqli_real_escape_string($con,$_POST['abt']);
  $time = mysqli_real_escape_string($con,$_POST['time']);
  $charges = mysqli_real_escape_string($con,$_POST['charges']);
  
  $uq = mysqli_query($con,"update tbl_workermaster set worker_name='{$name}',worker_email='{$email}',worker_password='{$pass}',worker_gender='{$gender}',worker_dob='{$dob}',worker_address='{$address}',area_id='{$area}',category_id='{$category}',worker_photo='{$filepath}',worker_exp='{$exp}',worker_aboutme='{$abt}',worker_time='{$time}',worker_charge='{$charges}' where worker_id='{$id}'")or die("Error updateq".mysqli_error($con));

  move_uploaded_file($filelocation,"workerimg/".$filepath);

  if($uq)
  {
      echo "<script>alert('Record updated');window.location='workermaster-display.php';</script>";
  }
  
      
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Worker Edit Form</title>

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
            <h1>Worker Edit Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Worker Edit Form</li>
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
                <h3 class="card-title">Worker Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName1"></label>
                    <input type="hidden" name="id" value="<?php echo $fr['worker_id'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="wname" value="<?php echo $fr['worker_name'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Email</label>
                    <input type="email" name="wemail" value="<?php echo $fr['worker_email'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Password</label>
                    <input type="password" name="pass" value="<?php echo $fr['worker_password'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <input type="radio" name="gender" <?php if($fr['worker_gender'] == "1") { echo "Checked"; } ?> value="1" id="exampleInputEmail1">Male
                    <input type="radio" name="gender" <?php if($fr['worker_gender'] == "0") { echo "Checked"; } ?>  value="0" id="exampleInputEmail1">Female
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">DOB</label>
                    <input type="date" name="dob" value="<?php echo $fr['worker_dob'] ?>" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Address</label>
                    <textarea type="text" name="address"  class="form-control" id="exampleInputName1" placeholder="Enter Address"><?php echo $fr['worker_address'] ?></textarea>
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
                      <div class="form-group">
                    <label for="exampleInputPassword1">Area</label>
                    <select name="area">
                  
                  <?php
                        $asq = mysqli_query($con,"select * from tbl_area")or die("Error areaselectq".mysqli_error($con));
                        while($afr = mysqli_fetch_array($asq))
                        {
                          $aselect = $afr['area_id'] == $fr['area_id'] ? "selected" : "";
                        echo "<option value='{$afr['area_id']}' $aselect>{$afr['area_name']}</option>";
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
                          $select = $cfr['category_id'] == $fr['category_id'] ? "selected" : "";
                        echo "<option value='{$cfr['category_id']}' $select>{$cfr['category_name']}</option>";
                        }
                  ?>
                  </select>
                  </div>

                      <div class="input-group-append">
                        <span class="input-group-text"><img style='width: 50px;' src='workerimg/<?php echo $fr['worker_photo'] ?>'></span>
                      </div>
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="exampleInputName1">Experiance</label>
                    <textarea type="text" name="exp" class="form-control" id="exampleInputName1" placeholder="Enter Experiance"><?php echo $fr['worker_exp'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Aboutme</label>
                    <textarea type="text" name="abt" class="form-control" id="exampleInputName1" placeholder="Enter Aboutme"><?php echo $fr['worker_aboutme'] ?></textarea>
                  </div>
                        
                  <div class="form-group">
                    <label for="exampleInputName1">Time</label>
                    <input type="time" name="time" value="<?php echo $fr['worker_time'] ?>" class="form-control" id="exampleInputName1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Charges</label>
                    <input type="number" name="charges" value="<?php echo $fr['worker_charge'] ?>" class="form-control" id="exampleInputName1" placeholder="Enter Charges">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="wsubmit" class="btn btn-primary">Submit</button>
                  <input type="button" value="Cancel" class="btn btn-primary" onclick="window.location='workermaster-display.php';">
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
