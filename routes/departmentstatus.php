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

if(isset($_GET['department_status']))
{
    $params=[
        'department_status'=>$_GET['department_status'],
        'dpid'=>$_GET['userid'],
    ];

    if($department->statuschange($params))
    {
        http_response_code(200);
        echo json_encode(array("message" => "status Changed"));
    }else{
        http_response_code(400);
    
        echo json_encode(array("message" => "Unable to change"));

    }
}