<?php 
session_start();
require_once 'class/Quote.php';

if (isset($_GET['action'])) {
    $quote = new Quote();

    switch ($_GET['action']) {
        case 'insert':
            // Obtener los datos del formularios
            $data = [
                'patient_id' => $_POST['patient_id'],
                'doctor_id' => $_POST['doctor_id'],
                'date' => $_POST['date'],
                'hour' => $_POST['hour'],
                'status' => $_POST['status'],
                'weight' => $_POST['weight'],
                'height' => $_POST['height'],
                'pressure' => $_POST['pressure'],
                'rhythm' => $_POST['rhythm']
            ];

            // Insertar la nueva cita en la base de datos
            if ($quote->create($data)) {
                header('Location: quote.php'); // Redirigir a la página de citas
            }
            break;

        case 'update':
            $id = $_POST['id'];
            $data = [
                'patient_id' => $_POST['patient_id'],
                'doctor_id' => $_POST['doctor_id'],
                'date' => $_POST['date'],
                'hour' => $_POST['hour'],
                'status' => $_POST['status'],
                'weight' => $_POST['weight'],
                'height' => $_POST['height'],
                'pressure' => $_POST['pressure'],
                'rhythm' => $_POST['rhythm']
            ];

            // Actualizar la cita en la base de datos
            if ($quote->update($id, $data)) {
                header('Location: quote.php'); // Redirigir a la página de citas
            }
            break;

        case 'delete':
            $id = $_GET['id'];

            // Eliminar la cita
            $quote->delete($id);
            header('Location: quote.php'); // Redirigir a la página de citas
            break;
    }
}
?>
