<?php 
    session_start();
    require_once 'class/Schedule.php';

    if(isset($_GET['action'])){
        $schedule = new Schedule();
        switch ($_GET['action']) {
            case 'insert':
                $data = [
                    'doctor_id' => $_POST['doctor_id'],
                    'days' => json_encode($_POST['days']),
                    'start' => $_POST['start'],
                    'end' => $_POST['end']
                ];

                if($schedule->create($data)){
                    header('Location: schedules.php');
                }
                break;
            case 'update':
                $id = $_POST['id'];
                $data = [
                    'doctor_id' => $_POST['doctor_id'],
                    'days' => json_encode($_POST['days']),
                    'start' => $_POST['start'],
                    'end' => $_POST['end']
                ];
                if($schedule->update($id, $data)){
                    header('Location: schedules.php');
                }
                break;
            case 'delete':
                $id = $_GET['id'];
                $schedule->delete($id);
                header('Location: schedules.php');
                break;
        }
    }
?>
