<?php 

session_start();
// VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
if(!isset($_SESSION['login'])){
    header('Location: index.php');
}

require_once 'class/Quote.php';
$quote = new Quote();
$quotes = $quote->getAll(); 
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
                    <h1 class="m-0">Citas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Citas</a>
                        </li>
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
                            <a href="new_quote.php" class="btn btn-primary btn-xs">Nueva cita</a> 
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Paciente</th>
                                        <th>Médico</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Estatus</th>
                                        <th>Peso</th>
                                        <th>Altura</th>
                                        <th>Presión</th>
                                        <th>Ritmo</th>
                                        <th>Creado</th>
                                        <th>Actualizado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($quotes as $row){ ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['patient_id'] ?></td>
                                            <td><?= $row['doctor_id'] ?></td> 
                                            <td><?= $row['date'] ?></td>
                                            <td><?= $row['hour'] ?></td>
                                            <td><?= $row['status'] ?></td>
                                            <td><?= $row['weight'] ?></td>
                                            <td><?= $row['height'] ?></td>
                                            <td><?= $row['pressure'] ?></td>
                                            <td><?= $row['rhythm'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><?= $row['updated_at'] ?></td>
                                            <td>
                                                <a href="edit_quote.php?id=<?= $row['id'] ?>" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Editar</a>
                                            </td>
                                            <td>
                                                <a href="proccess_quote.php?id=<?=$row['id'] ?>&action=delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Eliminar</a>
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
