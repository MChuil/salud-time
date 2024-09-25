<?php 

    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }
    
?>

<?php 
    require_once 'class/Doctor.php';
    $id = $_GET['id'];
    $doctor = new Doctor();
    $response = $doctor->getById($id);
?>
<?php require_once 'layout/header.php' ?>
<?php include 'layout/navbar.php' ?>
<?php include 'layout/sidebar.php' ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editar Doctor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Doctores</a></li>
                        <li class="breadcrumb-item active">Editar</li>
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
                        <form action="proccess_doctor.php?action=update" method="POST">
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="user_id">
                                        Dr. <?= strtoupper($response['name']  . " " . $response['lastname']) ?>
                                    </label>
                                </div>
                                <div class="form-group col-6">
                                    <label for="speciality">Especialidad</label>
                                    <input type="text" class="form-control" id="speciality" name="speciality" value="<?= $response['speciality'] ?>" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $response['phone'] ?>" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="id" value="<?= $response['id'] ?>">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'layout/copyright.php' ?>
<aside class="control-sidebar control-sidebar-dark"></aside>
<?php require 'layout/footer.php' ?>
