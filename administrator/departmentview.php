<?php

session_start();
if(!isset($_SESSION['loggedin']) || (trim($_SESSION['username']) == '')) {
  header("location: login.php");
  exit();
}

include_once "../config/Database.php";
include_once "../model/department.php";
$database=new Database;
$connect=$database->connect();

$department=new Department($connect);
//get employee

if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $department_data=$department->getDepartment($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finance| Dashboard</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">

  
   
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
         <!-- /.navbar -->
        <?php include 'parts/navbar.php';?>
        <!-- /.endnavbar -->

 
         <!-- /.sidemenu -->
        
        <?php include 'parts/sidemenu.php';?>
    
         <!-- /.endsidemenu -->


    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Department</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Department <?php $val=(isset($id)) ? 'View' : 'View'; echo $val; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
      <div class="row">
           <div class="col-md-12">
           <div class="card">
              <div class="card-header">
                <h4>Department View Details
                <a href="departmentlist.php" class="btn btn-danger float-end" style="float:right">Back</a>
                </h4>
              </div>

              <div class="card-body">
            
            
            <input type="hidden" name="dpid" value="<?php 
           
            $value = (isset($department_data['id']) ?  $department_data['id'] : '');
                     echo $value;?>"/>
           
          

            <div class="mb-3">
            <label>Department Number</label>  
            <p class="form-control">
            <?php  
            
             $value = (isset($department_data['departmentnumber']) ?  $department_data['departmentnumber'] : '');
             echo $value;
           ?>
            </p>
            </div>
            <div class="mb-3">
            <label>Department Name</label>  
            <p class="form-control">
            <?php  
            
             $value = (isset($department_data['departmentname']) ?  $department_data['departmentname'] : '');
             echo $value;
           ?>
            </p>
            </div>
          
            <div class="mb-3">
            <label>Status</label>  
            <p class="form-control">
            <?php
                      $value = (isset($department_data['department_status']) ?  $department_data['department_status'] : '');
                    
                    ?><?php  echo $value;?>
            </p>
            </div>
          </div>
        </div>
       </div>
  </div>
</div>
</section>
</div>


<?php include 'parts/footer.php'?>
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>

<!--footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
</body>
</html>