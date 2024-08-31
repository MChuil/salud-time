<?php 
    require_once 'class/User.php';

    if(isset($_GET['action'])){
        $user = new User();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'type' => $_POST['type']
                ];

                if($user->create($data)){ //si es verdadero significa ok
                    header('Location: users.php'); //redireccionar a users.php
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'type' => $_POST['type']
                ];
                if($user->update($id, $data)){
                    header('Location: users.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $user->delete($id);
                header('Location: users.php'); //redireccionar a users.php
                break;
        }
    }
    
    
?>