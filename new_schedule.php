<?php 

    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }
    
    require_once 'class/Doctor.php';
    $doctor = new Doctor();
    $doctors = $doctor->getAll();
?>

<?php require_once 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nuevo Horario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Horarios</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
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
                        <!-- Formulario para nuevo horario -->
                        <form action="proccess_schedule.php?action=insert" method="POST">
                            <div class="card-body row">
                                <!-- Selección del doctor -->
                                <div class="form-group col-6">
                                    <label for="doctor_id">Seleccione el Doctor</label>
                                    <select id="doctor_id" name="doctor_id" class="form-control" required>
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($doctors as $item) { ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['name'] . ' ' . $item['lastname'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- Selección de días -->
                                <div class="form-group col-6">
                                    <label for="days">Días Disponibles</label><br>
                                    <input type="checkbox" name="days[]" value="lunes"> Lunes<br>
                                    <input type="checkbox" name="days[]" value="martes"> Martes<br>
                                    <input type="checkbox" name="days[]" value="miércoles"> Miércoles<br>
                                    <input type="checkbox" name="days[]" value="jueves"> Jueves<br>
                                    <input type="checkbox" name="days[]" value="viernes"> Viernes<br>
                                </div>

                                <!-- Horario fijo de inicio y fin -->
                                <div class="form-group col-6">
                                    <label for="start">Hora de Inicio</label>
                                    <input type="time" class="form-control" id="start" name="start" value="08:00">
                                </div>
                                <div class="form-group col-6">
                                    <label for="end">Hora de Fin</label>
                                    <input type="time" class="form-control" id="end" name="end" value="14:00">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
