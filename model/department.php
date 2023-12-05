<?php

error_reporting(E_ALL);
ini_set('display_error',1);


class Department
{

     //database data

     private $connection;
     private $table="department";
 
     //fillable properties from table blog
 
     public $id;
     public $departmentnumber;
     public $departmentname;
     public $department_status;
     public $created_at;
     public $updated_at;
    
    public function __construct($database)

    {
        $this->connection=$database;
    }
    public function Adddepartment($params)

    {
       
            try{
                $this->departmentnumber=$params['departmentnumber'];
                $this->departmentname=$params['departmentname'];
               
                        //insert query
                        $query = "INSERT INTO " . $this->table . "
                        SET 
                        departmentnumber = :departmentnumber,
                        departmentname = :departmentname
                        ";
                
                        $stmt = $this->connection->prepare($query);
                        $stmt->bindValue(':departmentnumber', $this->departmentnumber);
                        $stmt->bindValue(':departmentname', $this->departmentname);
                       
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

    public function getDepartment($id)
    {
        try{
            $stmt = $this->connection->prepare("SELECT * FROM department WHERE id=? LIMIT 1"); 
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

    public function getData()
    {
        try{

            $query='SELECT *  
            FROM '.$this->table.' ' ;
    
            $dpdata=$this->connection->prepare($query);
    
            $dpdata->execute();
            $row = $dpdata->fetch();
            
    
            return $row;

        }
        catch(PDOException $e)
            {
                var_dump($e->getCode());
                var_dump($e->getMessage());
                var_dump($e->errorInfo);
            }
    }

    public function countDp($status){
        try{
            $query = "SELECT COUNT(*) as countdp FROM department WHERE department_status = ? ";
            $stmt= $this->connection->prepare($query);
            $stmt->execute([$status]);
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

    public function statuschange($params)
    {
        try{
            $this->department_status=$params['department_status'];
            $this->id=$params['dpid'];

            $query = "UPDATE " . $this->table . "
            SET department_status = :department_status 
            WHERE id=:dpid";

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':department_status', $this->department_status);
            $stmt->bindValue(':dpid', $this->id);
        

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
    
    
    public function selectData(){
        try{
    
            $query='SELECT *  
            FROM '.$this->table.' WHERE department_status = "1"' ;
    
            $dpdata=$this->connection->prepare($query);
    
            $dpdata->execute();
    
            
    
            return $dpdata;
    
        }
        catch(PDOException $e)
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

    public function deletedepartment($dpid)
    {
        try{
            $query = "DELETE FROM " . $this->table . "
           
            WHERE id=:dpid";

            $stmt = $this->connection->prepare($query);
            
            $stmt->bindValue(':dpid', $dpid);

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