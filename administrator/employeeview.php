<?php

session_start();
if(!isset($_SESSION['loggedin']) || (trim($_SESSION['username']) == '')) {
  header("location: login.php");
  exit();
}

include_once "../config/Database.php";
include_once "../model/Employee.php";
$database=new Database;
$connect=$database->connect();

$employee=new Employee($connect);
//get employee

if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $employee_data=$employee->getEmployee($id);
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
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee <?php $val=(isset($id)) ? 'View' : 'View'; echo $val; ?></li>
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
                <h4>Employee View Details
                <a href="employeelist.php" class="btn btn-danger float-end" style="float:right">Back</a>
                </h4>
              </div>
              <div class="card-body">
            
            
                <input type="hidden" name="empid" value="<?php 
               
                $value = (isset($employee_data['id']) ?  $employee_data['id'] : '');
                         echo $value;?>"/>
               
               <div class="mb-3">
               <img id="uploadedImage" src="<?php if(isset($employee_data['image'])) {
                            $target_file = '../MyUploadImages/'.$employee_data['image']; 
                            echo $target_file;} ?>" alt="Uploaded Image" class="mt-2 img-thumbnail" accept=".png, .jpg, .jpeg" 
                            style="height:100px; width:100px;">
                </div>

                <div class="mb-3">
                <label>Employee Name</label>  
                <p class="form-control">
                <?php  
                
                 $value = (isset($employee_data['name']) ?  $employee_data['name'] : '');
                 echo $value;
               ?>
                </p>
                </div>
                <div class="mb-3">
                <label>User Name</label>  
                <p class="form-control">
                <?php  
                
                 $value = (isset($employee_data['username']) ?  $employee_data['username'] : '');
                 echo $value;
               ?>
                </p>
                </div>
                <div class="mb-3">
                <label>Email</label>  
                <p class="form-control">
                <?php 
                          $value = (isset($employee_data['email']) ?  $employee_data['email'] : '');
                          echo $value;
                        ?>
                </p>
                </div>
                <div class="mb-3">
                <label>DOB</label>  
                <p class="form-control">
                <?php
                          $value = (isset($employee_data) ?  $employee_data['dob'] : '');
                         echo $value;
                        ?>
                </p>
                </div>
                <div class="mb-3">
                <label>Gender</label>  
                <p class="form-control">
                <?php 
                          $value = (isset($employee_data['gender']) ?  $employee_data['gender'] : '');
                        
                        ?><?php  echo $value;?>
                </p>
                </div>
                <div class="mb-3">
                <label>Phone Number</label>  
                <p class="form-control">
                <?php 
                          $value = (isset($employee_data) ?  $employee_data['phonenumber'] : '');
                         echo $value;
                        ?>
                </p>
                </div>
                <div class="mb-3">
                <label>Department</label>  
                <p class="form-control">
                <?php 
                          $value = (isset($employee_data['departmentname']) ?  $employee_data['departmentname'] : '');
                          if($value){
                          echo $value;
                          }
                          else{
                            echo "Not Assigned";
                          }
                        ?>
                </p>
                </div>
                <div class="mb-3">
                <label>Address</label>  
                <p class="form-control">
                <?php
                          $value = (isset($employee_data['address']) ?  $employee_data['address'] : '');
                        
                        ?><?php  echo $value;?>
                </p>
                </div>
                <div class="mb-3">
                <label>Status</label>  
                <p class="form-control">
                <?php
                          $value = (isset($employee_data['status']) ?  $employee_data['status'] : '');
                        
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