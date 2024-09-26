<?php 

    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }


    require_once 'class/Schedule.php';
    $schedule = new Schedule();
    $schedules = $schedule->getAll();
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
                    <h1 class="m-0">Horarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Horarios</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <a href="new_schedule.php" class="btn btn-primary btn-xs">Nuevo horario</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Doctor</th>
                                        <th>Días</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <th>Creado</th>
                                        <th>Actualizado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($schedules as $row){ ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['name'] . " " . $row['lastname']?></td>
                                            <td>
                                                <?php
                                                    $days = json_decode($row['days']);
                                                    foreach($days as $key=>$value){
                                                        echo ucfirst($value) . ", ";
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $row['start'] ?></td>
                                            <td><?= $row['end'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><?= $row['updated_at'] ?></td>
                                            <td>
                                                <a href="edit_schedule.php?id=<?= $row['id'] ?>" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Editar</a>
                                            </td>
                                            <td>
                                                <a href="proccess_schedule.php?id=<?=$row['id'] ?>&action=delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'layout/copyright.php' ?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php require 'layout/footer.php' ?>
