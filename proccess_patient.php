<?php 
    require_once 'class/Patient.php';

    if(isset($_GET['action'])){
        $Patient = new Patient();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    'id' => $_POST['id'],
                    'user_id' => $_POST['user_id'],
                    'birthday' => $_POST['birthday'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'sex' => $_POST['sex'],
                    
                ];

                if($Patient->create($data)){ //si es verdadero significa ok
                    header('Location: patients.php'); //redireccionar a users.php
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    'id' => $_POST['id'],
                    'user_id' => $_POST['user_id'],
                    'birthday' => $_POST['birthday'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'sex' => $_POST['sex'],
                ];
                if($Patient->update($id, $data)){
                    header('Location: patients.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $user->delete($id);
                header('Location: patients.php'); //redireccionar a users.php
                break;
        }
    }
    
    
?>