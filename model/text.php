<?php

include_once "../config/Database.php";
include_once "../model/Employee.php";
$database=new Database;
$connect=$database->connect();

$employee=new Employee($connect);
//get employee

if(isset($params['email']))
{
  $email = $params['email'];
  $employee_data = $employee->getEmployeemsg($email);
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

    <section class="content">
      <div class="container-fluid">
      <div class="row">
           <div class="col-md-12">
           <input type="hidden" name="empid" value="<?php 
               
               $value = (isset($employee_data['id']) ?  $employee_data['id'] : '');
                        echo $value;?>"/>
              
             
               <div class="mb-3">
             
               <p class="">
                Hi!!
               
               <?php  
                
                $gender = (isset($employee_data['gender']) ?  $employee_data['gender'] : '');
              if($gender == "male"){
                echo "Mr.";
              }
              else{
                echo "Mrs.";
              }
            
                $value = (isset($employee_data['name']) ?  $employee_data['name'] : '');
                echo $value;
              ?>
               </p>
              <p>
               <?php 
                         $value = (isset($employee_data['departmentname']) ?  $employee_data['departmentname'] : '');
                         if($value){
                         echo "Welcome To our Department of 
                         " .$value;
                         }
                         else{
                           echo "Can You Please Select Department";
                         }
                       ?>
               </p>
               </div>
               <div class="mb-3">
                <h4>This is Your Bio Informations.<br>Kindly Verify this details, If anything wrong Please Inform Us. </h4>
                <div class = "row">
                  <div class="col-6">
                  <div class="mb-3">
               <h5>DOB:</h5>  
               <p class="form-control">
               <?php
                         $value = (isset($employee_data) ?  $employee_data['dob'] : '');
                        echo $value;
                       ?>
               </p>
               </div>
                  </div>
                  <div class="col-6">
                  <div class="mb-3">
               <h5>Gender:</h5>  
               <p class="form-control">
               <?php 
                         $value = (isset($employee_data['gender']) ?  $employee_data['gender'] : '');
                       
                       ?><?php  echo $value;?>
               </p>
               </div>
                  </div>
                  <div class="col-6">
                  <div class="mb-3">
               <h5>Phone Number:</h5>  
               <p class="form-control">
               <?php 
                         $value = (isset($employee_data) ?  $employee_data['phonenumber'] : '');
                        echo $value;
                       ?>
               </p>
               </div>
                  </div>
                  <div class="col-6">
                  <div class="mb-3">
               <h5>Address</h5>  
               <p class="form-control">
               <?php
                         $value = (isset($employee_data['address']) ?  $employee_data['address'] : '');
                       
                       ?><?php  echo $value;?>
               </p>
               </div>
                  </div>
                </div>
              
               </div>
               
              
              
              
              
               <div class="mb-3">
               
               <p class="form-control">
               <?php
                         $value = (isset($employee_data['status']) ?  $employee_data['status'] : '');
                        if($value==1){
                          echo "we're so glad to have you as part of the team here.Best wishes on your first day! ";
                        }
                        else{
                          echo "Sorry!!, You are Not Selected as on Employee";
                        }
                       ?>
                      
               </p>
               </div>
           </div>
      </div>
    </div>
    </section>
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