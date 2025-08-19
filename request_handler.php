<?php
require_once("Student.php");

$std = new Student();

if(isset($_POST['action'])){

    $action = $_POST['action'];

    switch($action){
        case 'getAll':
           echo json_encode($std->getAll());
           break;

        case 'getById':
            $id = $_POST['id'];
            echo json_encode($std->getById($id));
            break;
        
        case 'insert':
            $data = [
                "name"=>$_POST['name'],
                "age"=>$_POST['age'],
                "city"=>$_POST['city'],
                "class"=> $_POST["class"],
                "contact"=>$_POST["contact"],
                "rollno"=>$_POST["rollno"],
                "fname"=>$_POST["fname"],
            ];
            echo json_encode($std->insert($data));
            break;

        case 'update':
            $id = $_POST['id'];
             $data = [
                "name"=>$_POST['name'],
                "age"=>$_POST['age'],
                "city"=>$_POST['city'],
                "class"=> $_POST["class"],
                "contact"=>$_POST["contact"],
                "rollno"=>$_POST["rollno"],
                "fname"=>$_POST["fname"]
            ];
            echo json_encode($std->update($id,$data));
            break;

        case 'delete':
            $id = $_POST['id'];
            echo json_encode($std->delete($id));
            break;
            

    }
}


?>