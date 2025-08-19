<?php

require_once("Database.php");

class Student{

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->get_connection();
    }


    public function getAll(){

        $sql = "SELECT * FROM students ORDER BY id DESC";

        $result = $this->conn->query($sql);

        $data = array();

        if($result->num_rows>0){
            $data = $result -> fetch_all(MYSQLI_ASSOC);
        }
        
        return $data;
    }



    public function getById($id){

        $sql = "SELECT * FROM students WHERE id = ? ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i",$id);

        $stmt->execute();

        $data = $stmt -> get_result()->fetch_assoc();
    
        return  $data;




    }

    public function insert($data = array()){

        $sql = "INSERT INTO students(name, age, city, class, fname, contact, rollno) VALUES(?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sisssss",$data["name"],$data["age"],$data["city"],$data['class'],$data['fname'],$data['contact'],$data['rollno']);

        if($stmt->execute()){
            return ["success"=>"Student Data Inserted Successfully!"];
        }else{
            return ["Error"=>"Unknown Error During Data Inserting!"];
        }

    }

    public function delete($id){

        $sql = "DELETE FROM students WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt -> bind_param('i',$id);

        $stmt->execute();

        if($stmt->affected_rows>0){
           return ["success"=>"Student Data Deleted Successfully!"];
        }else{
            
            return ["error"=>"Unknown Error During Deleting!"];
        }
    }



    public function update($id, $data = array()){
        $sql = "UPDATE students SET name = ?, age =?, city= ?, class =?, fname=?, contact =?, rollno =?  WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sisssssi",$data["name"],$data["age"],$data["city"],$data['class'],$data['fname'],$data['contact'],$data['rollno'], $id);


        $stmt -> execute();

        if($stmt->affected_rows>0){
            return ['success'=>"Student Data Updated Successfully!"];
        }else{
            return ["error"=>"Student Data Not Updated!"];
        }
    }

}