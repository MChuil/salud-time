<?php 
    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }
?>

<?php require_once 'class/User.php' ?>
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
            <h1 class="m-0">DASHBOARD</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <h1>Bienvenido 
            <?= $_SESSION['nombre'] ?>
        </h1>

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
