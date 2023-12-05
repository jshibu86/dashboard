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
$employee_data=$employee->selectData();
if($employee_data->rowCount())

{
    $employess=[];
    while($row = $employee_data->fetch(PDO::FETCH_OBJ))
    {
        $employess[$row->id]=[
            'id'=>$row->id,
            'name'=>$row->name,
            'username'=>$row->username,
            'email'=>$row->email,
            'gender'=>$row->gender,
            'phonenumber'=>$row->phonenumber,
            'status'=>$row->status

        ];
    }
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employees</title>

   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

 
 
  <link rel="stylesheet" href="../assets/dist/css/select2.min.css" />

  <link rel="stylesheet" href="../assets/dist/css/style.css">

  <script src="../assets/dist/js/jquery-3.4.1.min.js"></script>
   
  <script src="../assets/dist/js/select2.min.js"></script>
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
            <h1>Employee Select</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Select</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="">
      <style>
        .select2-container{
          width:100% !important;
        }
      </style> 
          <select
                            class="form-control activeemployees"
                            name="activeemployees"
                            id="activeemployees"
                            onchange="showUser(this.value)"
                            required
                          >
                           <option disabled selected hidden>Select employee</option>
                           <?php
                    $i=$employess['id'];
                    if(isset($employess))
                    {
                    foreach($employess as $empid => $data)
                    {
                      
                      ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['username']?>-<?php echo $data['email']?></option>
                            <?php
                    }
                  }
                    ?>
                        </select>
                        <div id="result">

                        </div> 

                        
                         
                        
	 <script>
      
      $(document).ready(function () {
       
         
        $("select.activeemployees").select2();  
        $("select.activeemployees").select2({
        theme: "classic"
       });
      });
      

      
    </script>

    
    
</div>

      </div>
    </section>
   
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
   <?php include 'parts/footer.php'?>
    <!--footer -->
 
   
  <script>
      function showUser(value){
    
    var userid = $('#activeemployees').val();
    console.log(userid);
              
                 
   
         $.ajax({
           type: "GET",
            dataType: "json",
            url: '../routes/activeemployee.php',
            data: {'userid': userid},
            success: function(data){


              alert("y");

             
                if ($.isEmptyObject(data.error)) {
                  console.log(data); 
                  $("#result").html(data); 
                  
                  
                  
                  
                }
            },
            error: function (data) {
                console.log(data.responseText);

                $('#result').html(data.responseText);
                
            }

         });


  
    
  }

  </script> 
  
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>

  </body>
</html>