<?php
session_start();
error_reporting(E_ALL);
ini_set('display_error',1);

include_once "../config/Database.php";
include_once "../model/department.php";

//db connection
$database=new Database;
$connect=$database->connect();


$table_name="department";

//getting raw data from post
$data = json_decode(file_get_contents("php://input"));

$department=new Department($connect);
if(count($_POST))
{
    
   
      
   
    $exist_department_number = $connect->prepare("SELECT * FROM department WHERE departmentnumber=?");
    //execute the statement
    $exist_department_number->execute([$_POST['departmentnumber']]); 
    //fetch result
    $dp = $exist_department_number->fetch();
    if ($dp) {
        
        $_SESSION['numbererror']=$_POST['departmentnumber'];
        $_SESSION['olddepartmentnumber']=$_POST['departmentnumber'];
        $_SESSION['olddepartmentname']=$_POST['departmentname'];
        
        
        header('location:../administrator/departmentadd.php');
        
        
    } else {
      
        
      $params = [
        'departmentnumber' => $_POST['departmentnumber'],
          'departmentname' => $_POST['departmentname'],
         
      ];
      if($department->Adddepartment($params))
      {
       
       $_SESSION['departmentadded'] ="Department Added Successfully";
       header('location:../administrator/departmentlist.php');
       
      }
      else{
       http_response_code(400);
   
       echo json_encode(array("message" => "Unable to register the department."));

   }

   } 
}
