<?php 
    require_once 'class/Schedule.php';

    if(isset($_GET['action'])){
        $Schedule = new Schedule();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    'id' => $_POST['id'],
                    'doctor_id' => $_POST['doctor_id'],
                    'days' => $_POST['days'],
                    'start' => $_POST['start'],
                    'end' => $_POST['end'],
                    'created_at' => $_POST['created_at'],
                    'updated_at' => $_POST['updated_at'],
                    
                ];

                if($Schedule->create($data)){ //si es verdadero significa ok
                    header('Location: schedules.php'); //redireccionar a users.php
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    'id' => $_POST['id'],
                    'doctor_id' => $_POST['doctor_id'],
                    'days' => $_POST['days'],
                    'start' => $_POST['start'],
                    'end' => $_POST['end'],
                    'created_at' => $_POST['created_at'],
                    'updated_at' => $_POST['updated_at'],
                ];
                if($Schedule->update($id, $data)){
                    header('Location: schedules.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $user->delete($id);
                header('Location: schedules.php'); //redireccionar a users.php
                break;
        }
    }
    
    
?>