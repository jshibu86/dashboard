<?php

session_start();
error_reporting(E_ALL);
ini_set('display_error',1);

include_once "../config/Database.php";
include_once "../model/Employee.php";

//db connection
$database=new Database;
$connect=$database->connect();


$table_name="employees";

//getting raw data from post
$data = json_decode(file_get_contents("php://input"));

$employee = new Employee($connect);
 
if($_GET['userid'])
{
  $id=$_GET['userid'];
  $params=[
    
    'empid'=>$_GET['userid']
];

}

$employee_data=$employee->activeemployee($id);
 show_data( $employee_data);
  function show_data($employee_data)
  
{
  http_response_code(200);
   
  
       
   echo "<div class='container-fluid mt-5'>
   <div class='card'>
   <div class='card-header'>
   <h3>Employee Details
   </h3>
   </div>
   <div class='card-body'>
   
       
        
        
       
        
        
        
        ";
        if($employee_data){
          
          if(isset($employee_data['image'])) {
            $target_file = '../MyUploadImages/'.$employee_data['image']; 
            echo"<div class='row mb-2'>"; 
          echo"<img src='$target_file'";
            echo "alt='Uploaded Image' class=' img-thumbnail' accept='.png, .jpg, .jpeg' style='height:100px; width:100px;'></div>";
          } 
         echo"<div class='row'>
         <div class='col-md-6'>
         <label for='name' class='h5'>Name:</label>";
          echo "<p id='name' class=''>" .$employee_data['name'] 
          . "</p>
          </div>";
          echo"<div class='col-md-6'>
          <label for='username' class='h5'>User Name:</label>";
          echo "<p id='username' class=''>".$employee_data['username'] 
          . "</p>
          </div>
          </div>";
          echo"<div class='row'>
          <div class='col-md-6'>
          <label for='email' class='h5'>Email:</label>";
          echo "<p id='email' class=''>".$employee_data['email'] . "</p>
          </div>";
          echo"<div class='col-md-6'>
          <label for='phonenumber' class='h5'>Phone Number:</label>";
          echo "<p id='phonenumber' class=''>".$employee_data['phonenumber'] . "</p>
          </div>
          </div>";
          echo"<div class='row'>
          <div class='col-md-6'>
          <label for='dob' class='h5'>DOB:</label>";
          echo "<p id='dob' class=''>".$employee_data['dob'] . "</p>
          </div>";
          echo"<div class='col-md-6'>
          <label for='gender' class='h5'>Gender:</label>";
          echo "<p id='gender' class=''>".$employee_data['gender'] . "</p>
          </div>
          </div>";
          echo"<div class='row'>
          <div class='col-md-6'>
          <label for='address' class='h5'>Address:</label>";
          echo "<p id='address' class=''>" .$employee_data['address'] . "</p>
          </div>";
          echo"<div class='col-md-6'>
          <label for='status' class='h5'>Status:</label>";
          echo "<p id='status' class=''>".$employee_data['status'] ."</p>
          </div>
          </div>";
          echo"";
          
                    
        echo "</div></div></div>";


      
    }
  
   else{
        http_response_code(400);
       
        echo json_encode(array("message" => "Unable to change"));
      echo"<tr>
        <p id=''>No Data Found</p>
       </tr>";

    }
     echo "</table>";
  }
  