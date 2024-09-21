<?php 
    session_start();
    require_once 'class/Patient.php'; 

    if(isset($_GET['action'])){
        $patient = new Patient();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    
                    'birthday' => $_POST['birthday'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'sex' => $_POST['sex']
                ];

                if($patient->create($data)){
                    header('Location: patients.php');
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    
                    'birthday' => $_POST['birthday'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone'],
                    'sex' => $_POST['sex']
                ];
                if($patient->update($id, $data)){
                    header('Location: patients.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $patient->delete($id);
                header('Location: patients.php');
                break;
        }
    }
?>
