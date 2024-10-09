<?php 
session_start();
// VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
if(!isset($_SESSION['login'])){
    header('Location: index.php');
}

require_once 'class/User.php'; 
require_once 'layout/header.php'; 
include 'layout/navbar.php'; 
include 'layout/sidebar.php'; 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile text-center">
                            <h3 class="profile-username"><?= $_SESSION['nombre'] ?></h3>
                            <p class="text-muted"><?= $_SESSION['rol'] ?></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Correo Electrónico</b> <a class="float-right"><?= $_SESSION['correo'] ?></a>
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-block" id="change-password-btn"><b>Cambiar contraseña</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- Cambiar contraseña form -->
                <div class="col-md-4" id="change-password-form" style="display: none;">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Cambiar Contraseña</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal"action="change_password.php" method="POST" >
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-4 col-form-label">Nueva Contraseña</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Nueva Contraseña">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="repeatPassword" class="col-sm-4 col-form-label">Repetir Contraseña</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="repeatPassword" placeholder="Repetir Contraseña">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Cambiar Contraseña</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

<?php include 'layout/copyright.php'; ?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- ./wrapper -->
<?php require 'layout/footer.php'; ?>

<script>
    document.getElementById('change-password-btn').addEventListener('click', function() {
        document.getElementById('change-password-form').style.display = 'block';
    });
</script>
