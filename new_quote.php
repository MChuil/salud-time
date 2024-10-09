<?php 
    session_start();
    // VALIDAR SI EXISTE LA VARIABLE DE SESIÓN LOGIN Y SI ES VERDADERA
    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
    }

    // Cargar las clases de Doctor y Paciente
    require_once 'class/Doctor.php';
    require_once 'class/Patient.php';

    $doctor = new Doctor();
    $doctors = $doctor->getAll();

    $patient = new Patient();
    $patients = $patient->getAll();

    require_once 'class/Schedule.php';
    $schedule = new Schedule();
    $schedules = $schedule->getAll();
?>

<?php require_once 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nueva Cita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Citas</a></li>
                        <li class="breadcrumb-item active">Nueva</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header"></div>
                        <!-- Formulario para nueva cita -->
                            <form action="proccess_quote.php?action=insert" method="POST">
                                <div class="card-body row">
                                    
                                    <!-- Selección del paciente -->
                                    <div class="form-group col-6">
                                        <label for="patient_id">Seleccione el Paciente</label>
                                        <select id="patient_id" name="patient_id" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($patients as $item) { ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Selección del doctor -->
                                    <div class="form-group col-6">
                                        <label for="doctor_id">Seleccione el Doctor</label>
                                        <select id="doctor_id" name="doctor_id" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($doctors as $item) { ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Selección del horario -->
                                    <div class="form-group col-6">
                                        <label for="schedule_id">Seleccione el Horario</label>
                                        <select id="schedule_id" name="schedule_id" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($schedules as $item) {
                                                $days = json_decode($item['days'], true); 
                                                $daysText = implode(', ', $days); 
                                            ?>
                                                <option value="<?= $item['id'] ?>">
                                                    <?= $daysText . ' ' . $item['start'] . ' - ' . $item['end'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Peso -->
                                    <div class="form-group col-6">
                                        <label for="weight">Peso (kg)</label>
                                        <input type="number" step="0.01" id="weight" name="weight" class="form-control" required>
                                    </div>

                                    <!-- Altura -->
                                    <div class="form-group col-6">
                                        <label for="height">Altura (cm)</label>
                                        <input type="number" step="0.01" id="height" name="height" class="form-control" required>
                                    </div>

                                    <!-- Presión -->
                                    <div class="form-group col-6">
                                        <label for="pressure">Presión (mm Hg)</label>
                                        <input type="text" id="pressure" name="pressure" class="form-control" required>
                                    </div>

                                    <!-- Ritmo cardíaco -->
                                    <div class="form-group col-6">
                                        <label for="rhythm">Ritmo cardíaco (bpm)</label>
                                        <input type="text" id="rhythm" name="rhythm" class="form-control" required>
                                    </div>

                                    <!-- Estatus -->
                                    <div class="form-group col-6">
                                        <label for="status">Estatus</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="Completada">Completada</option>
                                            <option value="Cancelada">Cancelada</option>
                                        </select>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Guardar Cita</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/copyright.php'; ?>
<aside class="control-sidebar control-sidebar-dark"></aside>
<?php require 'layout/footer.php'; ?>
