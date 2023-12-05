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
  $employee_data=$department->getDepartment($id);
}
//update employee

 // Do Database Connection in this file (create a file namely connect.php inside MyProject Folder)





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finance| Dashboard</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/dist/css/style.css">
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

  <!-- Content Wrapper. Contains page content -->
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
              <li class="breadcrumb-item active">Department<?php $val=(isset($id)) ? 'Update' : 'Add'; echo $val; ?></li>
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
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> <small> <?php $val=(isset($id)) ? 'Update' : 'Add'; echo $val; ?> Department</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php 
              if(isset($id))
              {
                ?>
              <form id="dpForm" action="../routes/updatedepartment.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="dpid" value=<?php echo $id?>/>
                <?php
              }
              else{
                ?>
                <form id="dpForm" action="../routes/adddepartment.php" enctype=multipart/form-data method="post">
                <?php
              }
              
              ?>
             
             <div class="card-body">
             <div class="form-group">
                    <label for="exampleDepartmentNumber">Department Number</label>
                    <input type="text" name="departmentnumber" class="form-control" id="exampleDepartmentNumber"
                     placeholder="Enter Department Number" value="<?php 
                    if(isset($_SESSION['olddepartmentnumber']))
                          {
                              echo $_SESSION['olddepartmentnumber'];
                              unset($_SESSION['olddepartmentnumber']);
                          }

                         $value = (isset($employee_data['departmentnumber']) ?  $employee_data['departmentnumber'] : '');
                         echo $value;
                        ?>">
                         <p class="text-danger"><?php if(isset($_SESSION['numbererror'])){
                          echo "This Department Number is Already Taken";
                          unset($_SESSION['numbererror']);
                        }
                        ?></p>
                  </div>
                  <div class="form-group">
                    <label for="exampleDepartmentName">Department Name</label>
                    <input type="text" name="departmentname" class="form-control" id="exampleDepartmentName"
                     placeholder="Enter Department Name" value="<?php 
                    if(isset($_SESSION['olddepartmentname']))
                          {
                              echo $_SESSION['olddepartmentname'];
                              unset($_SESSION['olddepartmentname']);
                              
                        }
                       
                         $value = (isset($employee_data['departmentname']) ?  $employee_data['departmentname'] : '');
                         echo $value;
                        ?>">
                       
                  </div>
             </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right"><?php $val=(isset($id)) ? 'Update' : 'Submit'; echo $val; ?></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->

    <div class="col-md-6">

      <!--/.col (right) -->
    </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

     <!--end Content Wrapper. Contains page content -->
     <?php include 'parts/footer.php'?>
     <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
     </aside>
     <!-- /.control-sidebar -->
     </div>
     <!-- ./wrapper -->

     <!-- jQuery -->
     <script src="../assets/plugins/jquery/jquery.min.js"></script>
     <!-- Bootstrap 4 -->
     <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
     <!-- jquery-validation -->
     <script src="../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
     <script src="../assets/plugins/jquery-validation/additional-methods.min.js"></script>
     <!-- AdminLTE App -->
     <script src="../assets/dist/js/adminlte.min.js"></script>
     <!-- AdminLTE for demo purposes -->

     <!-- Page specific script -->
     <script>
        $(function () {
        $.validator.setDefaults({
        submitHandler: function (form) {
        this.submit();
        }
        });
        $('#dpForm').validate({
        rules: {
          departmentnumber: {
        required: true,
       
        },
        departmentname: {
        required: true,

        },
        

        },
        messages: {
          departmentnumber: {
        required: "Please enter a department number",
       
        },
        departmentname: {
        required: "Please provide a department name",
        },
       

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        }
        });
      });
  </script>
  <script>
if(message !='')
{
  toastr.success(message);
}

</script>
 </body>
</html>
