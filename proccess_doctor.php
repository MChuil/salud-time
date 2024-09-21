<?php 
    session_start();
    require_once 'class/Doctor.php';

    if(isset($_GET['action'])){
        $doctor = new Doctor();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    'user_id' => $_POST['user_id'],
                    'speciality' => $_POST['speciality'],
                    'phone' => $_POST['phone']
                ];

                if($doctor->create($data)){
                    header('Location: doctors.php');
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    'user_id' => $_POST['user_id'],
                    'speciality' => $_POST['speciality'],
                    'phone' => $_POST['phone']
                ];
                if($doctor->update($id, $data)){
                    header('Location: doctors.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $doctor->delete($id);
                header('Location: doctors.php');
                break;
        }
    }
?>
