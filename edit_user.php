<?php 
    require_once 'class/User.php';
    $id = $_GET['id'];
    $user = new User();
    $response = $user->getById($id);
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
                    <h1 class="m-0">Editar usuario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
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
                            
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="proccess_user.php?action=update" method="POST">
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre" value="<?= $response['name']?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="lastname">Apellidos</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ingrese los apellidos" value="<?= $response['lastname']?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Correo electronico</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese un correo valido" value="<?= $response['email']?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña" value="<?= $response['password']?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="type">Tipo de usuario</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Seleccionar</option>
                                        <option value="admin" <?= ($response["type"] == "admin") ? "selected" :  null ?> >Administrador</option>
                                        <option value="receptionist" <?= ($response["type"] == "receptionist") ? "selected" :  null ?>>Recepcionista</option>
                                        <option value="doctor" <?= ($response["type"] == "doctor") ? "selected" :  null ?>>Doctor</option>
                                        <option value="patient" <?= ($response["type"] == "patient") ? "selected" :  null ?>>Paciente</option>
                                    </select>
                                </div>
                                
                               
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="id" value="<?= $response['id'] ?>">
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