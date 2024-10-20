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
                'date' => $_POST['day'],
                'hour' => $_POST['schedule'],
                'scheduled' => 'scheduled'
            ];

            //variables de session del fomulario
            $_SESSION['form_data'] = $data;

            // Validar si la cita ya existe
            $existingQuote = $quote->getByDoctorAndDateTime($data['doctor_id'], $data['date'], $data['hour']);
            if ($existingQuote) {
                $_SESSION['error_message'] = 'El doctor ya tiene una cita programada a esa hora.';
                header('Location: new_quote.php');
                exit();
            }

            // Insertar la nueva cita en la base de datos si no hay conflicto
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
