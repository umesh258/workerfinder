<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';


    $eid=$_GET['eid'];
    $sq = mysqli_query($con,"select * from tbl_admin where admin_id='{$eid}'")or die("Error seleceq".mysqli_error($con));
    $fr = mysqli_fetch_array($sq);
    
    
    if(isset($_POST['asubmit']))
    {
        $id = $_POST['id'];
        $name = mysqli_real_escape_string($con,$_POST['name']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $pass = mysqli_real_escape_string($con,$_POST['password']);
        $photo = $_FILES['photo']['name'];

        $psq = mysqli_query($con,"select admin_photo from tbl_admin where admin_id='{$id}'") or die(mysqli_error($con));
        $pfr = mysqli_fetch_array($psq);
         $filepath = "adminimg/".$pfr['admin_photo'];
        unlink($filepath);
        

        $uq = mysqli_query($con,"update tbl_admin set admin_name='{$name}',admin_email='{$email}',admin_password='{$pass}',admin_photo='{$photo}' where admin_id='{$id}'")or die("Error in updateq".mysqli_error($con));
        // How To File Replace In Our Flder.
        
          //unlink($filepath);
          echo $filepath;
        if($uq)
        {
          
          move_uploaded_file($_FILES['photo']['tmp_name'],"adminimg/".$photo);
            echo "<script>alert('Record Edited !');window.location='admin-display.php';</script>";
        }
    }

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Edit Form</title>

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
            <h1>Admin Edit Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Edit Form</li>
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
                <h3 class="card-title">Admin Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method = "post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName1"></label>
                    <input type="hidden" name="id" value="<?php echo $fr['admin_id']?>" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" value="<?php echo $fr['admin_name']?>" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="<?php echo $fr['admin_email']?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" value="<?php echo $fr['admin_password']?>" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
                      <div >
                        <span ><img style='width: 100px;' src='adminimg/<?php  echo $fr['admin_photo'] ?>'></span>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="asubmit" class="btn btn-primary">Save</button>
                  <input type= "button" value="cancel" onclick = "window.location ='admin-display.php';" class="btn btn-primary" >
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
