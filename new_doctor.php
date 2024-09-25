<?php 

    session_start();
    //VALIDAR SI EXISTE LA VARIABLE DE SESSION LOGIN Y SI ES VERDADERA
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }
    
?>
<?php require_once 'class/Doctor.php' ?>
<?php require_once 'class/User.php' ?>
<?php 
    $user = new User();
    $users = $user->listDoctors(); //lista solo doctores
    $data = [];  //nuevo array

    foreach ($users as $row) {
        $dr = new Doctor();
        $response = $dr->getDr($row['id']);  // buscamos en doctores por su id
        if(empty($response[0])){  //Si no se encontro 
            array_push($data, $row); //agregamos el doctor al nuevo array
        }
    }
?>
<?php require_once 'layout/header.php' ?>
<?php include 'layout/navbar.php' ?>
<?php include 'layout/sidebar.php' ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nuevo Doctor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Doctores</a></li>
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
                        <form action="proccess_doctor.php?action=insert" method="POST">
                            <div class="card-body row">
                                <div class="form-group col-6">
                                    <label for="user_id">Seleccione el usuario</label>
                                    <select id="user_id" name="user_id" class="form-control" required>
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($data as $item){ ?>
                                            <option value="<?= $item['id' ]?>"><?= $item['name'] . ' ' . $item['lastname']  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="speciality">Especialidad</label>
                                    <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Ingrese la especialidad" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese el teléfono" required>
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
<?php include 'layout/copyright.php' ?>
<aside class="control-sidebar control-sidebar-dark"></aside>
<?php require 'layout/footer.php' ?>
