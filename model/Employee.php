<?php

error_reporting(E_ALL);
ini_set('display_error',1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


    

require '../vendor/autoload.php';

class Employee
{

     //database data

     private $connection;
     private $table="employees";
 
     //fillable properties from table blog
 
     public $id;
     public $image;
     public $name;
     public $username;
     public $email;
     public $phonenumber;
     public $dob;
     public $departmentid;
     public $gender;
     public $address;
     public $password;
     public $status;
     public $created_at;
     public $updated_at;
    
    public function __construct($database)

    {
        $this->connection=$database;
    }
public function msg($params){  
        $gender = $params['gender']; 
        $name = $params['name'];     
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->Port = 2525;
      
       
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'f36959a4f6d8ae';
        $mail->Password = 'cb361a0e540cd9';
        $mail->setFrom($params['email'], 'Employee');
        $mail->addAddress('from@example.com', 'Finance');
        $mail->Subject = 'Employee Regester';
        ob_start();
        include('text.php');
        $mail->Body = ob_get_contents();
        ob_end_clean();  
        $mail->AltBody = 'This is a plain-text message body';
        $mail->addAttachment('../doc/task.csv');
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }

       

}
    public function Addemployee($params)

    {
       
            try{
                $this->image=$params['image'];
                $this->name=$params['name'];
                $this->username=$params['username'];
                $this->email=$params['email'];
                $this->phonenumber=$params['phonenumber'];
                $this->dob=$params['dob'];
                $this->departmentid=$params['departmentid'];
                $this->gender=$params['gender'];
                $this->address=$params['address'];
                $this->password=$params['password'];
                
                $target_file = '../MyUploadImages/'.$params['image']; 
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
                $valid_extension = array("png","jpeg","jpg"); 
                if(in_array($file_extension, $valid_extension)) {

                    // Upload file
                    if(move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        $target_file)
                    ) {
                        //insert query
                        $query = "INSERT INTO " . $this->table . "
                        SET 
                        image = :image,
                        name = :name,
                        username=:username,
                        email = :email,
                        dob = :dob,
                        departmentid = :departmentid,
                        gender=:gender,
                        address=:address,
                        phonenumber=:phonenumber,
                        password = :password";
                
                        $stmt = $this->connection->prepare($query);
                        $stmt->bindValue(':image', $this->image);
                        $stmt->bindValue(':name', $this->name);
                        $stmt->bindValue(':username', $this->username);
                        $stmt->bindValue(':dob', $this->dob);
                        $stmt->bindValue(':email', $this->email);
                        $stmt->bindValue(':phonenumber', $this->phonenumber);
                        $stmt->bindValue(':departmentid', $this->departmentid);
                        $stmt->bindValue(':gender', $this->gender);
                        $stmt->bindValue(':address', $this->address);
                        $stmt->bindValue(':password', $this->password);

                      
                      
                    }
                } 
                
               

              if($stmt->execute())
              {
                  return true;
              }
              return false;

              
                   

            } catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }


    public function readData()
    {
        try{

            $query='SELECT *  
            FROM '.$this->table.' ORDER BY created_at DESC' ;
    
            $empdata=$this->connection->prepare($query);
    
            $empdata->execute();
    
            
    
            return $empdata;

        }
        catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }

    public function getData()
    {
        try{

            $query='SELECT *  
            FROM '.$this->table.' ORDER BY created_at DESC' ;
    
            $empdata=$this->connection->prepare($query);
    
            $empdata->execute();
            $row = $empdata->fetch();
            
    
            return $row;

        }
        catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }
    public function countData($id){
        try{
            $query = "SELECT COUNT(*) as countemp FROM employees WHERE departmentid = ? ";
            $stmt= $this->connection->prepare($query);
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row;
        }
        catch(PDOException $e)
        {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }
    }
    public function countEmp($id){
        try{
            $query = "SELECT COUNT(*) as countactemp FROM employees WHERE status = ? ";
            $stmt= $this->connection->prepare($query);
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row;
        }
        catch(PDOException $e)
        {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }
    }
    public function countgenderMale($gender){
        try{
            $query = "SELECT COUNT(*) as countgendermale FROM employees WHERE gender = ? and status = 1";
            $stmt= $this->connection->prepare($query);
            $stmt->execute([$gender]);
            $row = $stmt->fetch();
            return $row;
        }
        catch(PDOException $e)
        {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }
    }
    public function countgenderFemale($gender){
        try{
            $query = "SELECT COUNT(*) as countgenderfemale FROM employees WHERE gender = ? and status = 1";
            $stmt= $this->connection->prepare($query);
            $stmt->execute([$gender]);
            $row = $stmt->fetch();
            return $row;
        }
        catch(PDOException $e)
        {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }
    }
public function viewData($id){
    try{
        $query = "SELECT * FROM rmployees WHERE id=? LIMIT 1";
        $stmt= $this->connection->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row;
    }
    catch(PDOException $e)
    {
        var_dump($e->getCode());
        var_dump($e->getMessage());
        var_dump($e->errorInfo);
    }
}
public function selectData(){
    try{

        $query='SELECT *  
        FROM '.$this->table.' WHERE status = "1"' ;

        $empdata=$this->connection->prepare($query);

        $empdata->execute();

        

        return $empdata;

    }
    catch(PDOException $e)
        {
            var_dump($e->getCode());
            var_dump($e->getMessage());
            var_dump($e->errorInfo);
        }
}

    public function getEmployee($id)
    {
        try{
            $stmt = $this->connection->prepare("SELECT * FROM employees LEFT JOIN department ON
            employees.departmentid = department.id
            WHERE  employees.id=? LIMIT 1"); 
            $stmt->execute([$id]); 
            $row = $stmt->fetch();
            
    
            return $row;
            
    
         

        }
        catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }

    }

    public function getEmployeemsg($email)
    {
        try{
            $stmt = $this->connection->prepare("SELECT * FROM employees LEFT JOIN department ON
            employees.departmentid = department.id
            WHERE  employees.email=? LIMIT 1"); 
            $stmt->execute([$email]); 
            $row = $stmt->fetch();
            
    
            return $row;
            
    
         

        }
        catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }

    }
    public function activeemployee($id)
    {
        try{
            
           
            $stmt = $this->connection->prepare("SELECT * FROM employees WHERE id=?"); 
            
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            return $row;
          

        }catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }

    public function Updateemployee($params,$id)

    {
            try{
                $this->image=$params['image'];
                $this->name=$params['name'];
                $this->username=$params['username'];
                $this->email=$params['email'];
                $this->phonenumber=$params['phonenumber'];
                $this->dob=$params['dob'];
                $this->departmentid=$params['departmentid'];
                $this->gender=$params['gender'];
                $this->address=$params['address'];
                $this->password=$params['password'];
         
                $target_file = '../MyUploadImages/'.$params['image']; 
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
                $valid_extension = array("png","jpeg","jpg"); 
                if(in_array($file_extension, $valid_extension)) {

                    // Upload file
                    if(move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        $target_file)
                    ) {
                      
                      
                    }
                } 
                
                 //insert query
                 $query = "UPDATE " . $this->table . "
                 SET 
                 image = :image,
                 name = :name,
                 username=:username,
                 email = :email,
                 dob = :dob,
                 departmentid = :departmentid,
                 gender=:gender,
                 address=:address,
                 phonenumber=:phonenumber,
                 password = :password
                 WHERE id=:empid";
         
                 $stmt = $this->connection->prepare($query);
                 $stmt->bindValue(':image', $this->image);
                 $stmt->bindValue(':name', $this->name);
                 $stmt->bindValue(':username', $this->username);
                 $stmt->bindValue(':dob', $this->dob);
                 $stmt->bindValue(':email', $this->email);
                 $stmt->bindValue(':phonenumber', $this->phonenumber);
                 $stmt->bindValue(':departmentid', $this->departmentid);
                 $stmt->bindValue(':gender', $this->gender);
                 $stmt->bindValue(':address', $this->address);
                 $stmt->bindValue(':password', $this->password);
                 $stmt->bindValue(':empid', $id);

              if($stmt->execute())
              {
                  return true;
              }
              return false;

              
                   

            } catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }

    public function statuschange($params)
    {
        try{
            $this->status=$params['status'];
            $this->id=$params['empid'];

            $query = "UPDATE " . $this->table . "
            SET status = :status 
            WHERE id=:empid";

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':status', $this->status);
            $stmt->bindValue(':empid', $this->id);
        

            if($stmt->execute())
              {
                  return true;
              }
              return false;

        }catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }
    
    public function deleteemployee($empid)
    {
        try{
            $query = "DELETE FROM " . $this->table . "
           
            WHERE id=:empid";

            $stmt = $this->connection->prepare($query);
            
            $stmt->bindValue(':empid', $empid);

            if($stmt->execute())
              {
                  return true;
              }
              return false;

        }catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }

}