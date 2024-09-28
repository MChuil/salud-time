<?php 

    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }
    
?>
<?php 
    require_once 'class/Schedule.php';
    $id = $_GET['id'];
    $schedule = new Schedule();
    $response = $schedule->getById($id);
?>
<?php require_once 'layout/header.php' ?>
<?php include 'layout/navbar.php' ?>
<?php include 'layout/sidebar.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editar horario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Horarios</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <!-- Aquí podrías añadir un título si deseas -->
                        </div>
                        <!-- Formulario para editar horario -->
                       
                            <form action="proccess_schedule.php?action=update" method="POST">
                                <input type="hidden" name="id" value="<?= $response['id'] ?>">
                                <input type="hidden" name="doctor_id" value="<?= $response['doctor_id'] ?>"> <!-- Asegúrate de que 'doctor_id' exista en $response -->

                                <div class="card-body row">
                                    <!-- nombre doctor-->
                                    <div class="form-group col-6">
                                        <label for="doctor_name">Doctor</label>
                                        <p>Dr. <?= strtoupper($response['name'] . ' ' . $response['lastname']) ?></p>
                                    </div>

                                    <!-- días marcados -->
                                    <div class="form-group col-6">
                                        <label for="days">Días Disponibles</label><br>
                                        <?php
                                            $selected_days = json_decode($response['days']);
                                            $days_of_week = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes'];

                                            foreach ($days_of_week as $day) {
                                                $checked = in_array($day, $selected_days) ? 'checked' : '';
                                                echo "<input type='checkbox' name='days[]' value='$day' $checked> " . ucfirst($day) . "<br>";
                                            }
                                        ?>
                                    </div>

                                    <!-- horario -->
                                    <div class="form-group col-6">
                                        <label for="start">Hora de Inicio</label>
                                        <input type="time" class="form-control" id="start" name="start" value="<?= $response['start'] ?>" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="end">Hora de Fin</label>
                                        <input type="time" class="form-control" id="end" name="end" value="<?= $response['end'] ?>" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'layout/copyright.php' ?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark"></aside>
<!-- ./wrapper -->
<?php require 'layout/footer.php' ?>
