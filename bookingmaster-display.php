<?php
session_start();

if(!isset($_SESSION['id']))
{
  header("location:login.php");
}
require './connection.php';
if(isset($_GET['did']))
{
    $did = $_GET['did'];

    $dq = mysqli_query($con,"delete from tbl_bookingmaster where book_id='{$did}'")or die("error deleteq".mysqli_error($con));

    if($dq)
    {
        echo "<script>alert('Record deleted !');</script>";
    }
}

$sq = mysqli_query($con,"select * from tbl_bookingmaster")or die("Error Sq".mysqli_error($con));



?>
<script>
  function ConfirmDelete(){
    var a = confirm("Are you sure want to Delete !");
    if(a){
      return true;
    }else{
      return false;
    }
  }
</script>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Tables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1>BookingTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">BookingTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><a href='bookingmaster-form.php'><img src='icon/add.png'> Add records</a></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>BID</th>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Worker Name</th>
                    <th>Book date</th>
                    <th>Time</th>
                    <th>Probem</th>
                    <th>Amount</th>
                    <th>Image</th>
                    <th>status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($fr = mysqli_fetch_array($sq)){
                        $usq = mysqli_query($con,"select user_name from tbl_usermaster where user_id='{$fr['user_id']}'")or die("error in usersq".mysqli_error($con));
                        $fusq = mysqli_fetch_array($usq);
                        $wsq = mysqli_query($con,"select worker_name from tbl_workermaster where worker_id='{$fr['worker_id']}'")or die("error in workersq".mysqli_error($con));
                        $fwsq = mysqli_fetch_array($wsq);
                                              
                        
                        echo "<tr>";
                        echo "<td>{$fr['book_id']}</td>";
                        echo "<td>{$fr['date']}</td>";
                        echo "<td>{$fusq['user_name']}</td>";
                        echo "<td>{$fwsq['worker_name']}</td>";
                        echo "<td>{$fr['book_date']}</td>";
                        echo "<td>{$fr['book_time']}</td>";
                        echo "<td>{$fr['book_problemdetails']}</td>";
                        echo "<td>{$fr['book_charges']}</td>";
                        echo "<td><a href='bookingimg/{$fr['book_photo']}' target='_blank'><img style='width: 30px;' src='bookingimg/{$fr['book_photo']}'></a></td>";
                        echo "<td>{$fr['status']}</td>";
                        echo "<td><a href='bookingmaster-edit.php?eid={$fr['book_id']}'><img src='icon/edit.png'></a> | <a Onclick='return ConfirmDelete();' href='?did={$fr['book_id']}'><img src='icon/delete.png'></a></td>";
                        echo "</tr>";
                      }
                    ?>




                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
