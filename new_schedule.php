<?php require_once 'class/Schedule.php' ?>
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
                    <h1 class="m-0">Nuevo horario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Horarios</a></li>
                        <li class="breadcrumb-item active">Nuevo</li>
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
                            
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="proccess_schedule.php?action=insert" method="POST">
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="doctor_id">ID del Doctor</label>
                                    <input type="number" class="form-control" id="doctor_id" name="doctor_id" placeholder="Ingrese el ID del doctor" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="days">Días</label>
                                    <input type="text" class="form-control" id="days" name="days" placeholder="Ingrese los días disponibles" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="start">Hora de Inicio</label>
                                    <input type="time" class="form-control" id="start" name="start" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="end">Hora de Fin</label>
                                    <input type="time" class="form-control" id="end" name="end" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
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
