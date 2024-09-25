<?php 

    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }
    
?>
<?php require_once 'class/Patient.php' ?>
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
                    <h1 class="m-0">Nuevo paciente</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
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
                        <form action="proccess_patient.php?action=insert" method="POST">
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="birthday">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="address">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Ingrese la dirección" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese el teléfono" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="sex">Sexo</label>
                                    <select name="sex" id="sex" class="form-control" required>
                                        <option value="">Seleccionar</option>
                                        <option value="male">Masculino</option>
                                        <option value="female">Femenino</option>
                                    </select>
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
