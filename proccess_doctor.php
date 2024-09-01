<?php 
    require_once 'class/Doctor.php';

    if(isset($_GET['action'])){
        $Doctor = new Doctor();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    'id' => $_POST['id'],
                    'user_id' => $_POST['user_id'],
                    'speciality' => $_POST['speciality'],
                    'phone' => $_POST['phone'],
                    
                ];

                if($Doctor->create($data)){ //si es verdadero significa ok
                    header('Location: doctors.php'); //redireccionar a users.php
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    'id' => $_POST['id'],
                    'user_id' => $_POST['user_id'],
                    'speciality' => $_POST['speciality'],
                    'phone' => $_POST['phone'],
                ];
                if($Doctor->update($id, $data)){
                    header('Location: doctors.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $user->delete($id);
                header('Location: doctors.php'); //redireccionar a users.php
                break;
        }
    }
    
    
?>