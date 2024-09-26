<?php 
    session_start();
    require_once 'class/User.php';

    if(isset($_GET['action'])){
        $user = new User();
        switch ($_GET['action']) {
            case 'auth':
                $email = $_POST['email'];
                $password = $_POST['password'];
                if(empty($email) || empty($password)){
                    $_SESSION['error'] = "empty";
                    header('Location: index.php');
                    return;
                }
                $user = new User();
                $response =  $user->login($email, $password);
                if($response){
                    $_SESSION['nombre'] = $response['name'] . " " . $response['lastname'];
                    $_SESSION['correo'] = $response['email'];
                    $_SESSION['rol'] = $response['type'];
                    $_SESSION['login'] = true;
                    header('Location: dashboard.php');
                }else{
                    $_SESSION['error'] = "notfound";
                    header('Location: index.php');
                }
                break;
            case 'insert':
                $data = [
                    'name' => $_POST['name'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
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