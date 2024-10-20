<?php 
    session_start();
    // VALIDAR SI EXISTE LA VARIABLE DE SESIÓN LOGIN Y SI ES VERDADERA
    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
    }

    if (!empty($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    

    // Cargar las clases de Doctor y Paciente
    require_once 'class/Doctor.php';
    require_once 'class/Patient.php';
    require_once 'class/Schedule.php';

    $patient = new Patient();
    $patients = $patient->getAll();


    $doctor = new Doctor();
    $doctors = $doctor->getAll();
    $schedule = new Schedule();
    for ($i=0; $i < count($doctors); $i++) { 
        $query = $schedule->getByDoctor($doctors[$i]['id']);
        if(count($query)>0){
            $doctors[$i]['days'] = $query['days'];
            $doctors[$i]['start'] = $query['start'];
            $doctors[$i]['end'] = $query['end'];
        }
    }


    if(!empty($_SESSION['form_data'])){
        $data = $_SESSION['form_data'];
        unset($_SESSION['form_data']);
    }
?>

<?php require_once 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nueva Cita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Citas</a></li>
                        <li class="breadcrumb-item active">Nueva</li>
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
                        <!-- Formulario para nueva cita -->
                            <form action="proccess_quote.php?action=insert" method="POST">
                                <div class="card-body row">
                                
                                    <input type="hidden" value="<?= json_encode($doctors) ?>" id="listDoctors">
                                    <!-- Selección del paciente -->
                                    <div class="form-group col-6">
                                        <label for="patient_id">Seleccione el Paciente</label>
                                        <select id="patient_id" name="patient_id" class="form-control" value="<?= (!empty($data)) ? $data['patient_id'] : null ?>" required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($patients as $item) { ?>
                                                <option value="<?= $item['id'] ?>" <?= (!empty($data) && $data['patient_id'] == $item['id']) ? "selected" : null ?>><?= $item['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Selección del doctor -->
                                    <div class="form-group col-6">
                                        <label for="doctor_id">Seleccione el Doctor</label>
                                        <select id="doctor_id" name="doctor_id" class="form-control" value="<?= (!empty($data)) ? $data['doctor_id'] : null ?>"  required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($doctors as $item) { ?>
                                                <option value="<?= $item['id'] ?>" <?= (!empty($data) && $data['doctor_id'] == $item['id']) ? "selected" : null ?>><?= $item['name'] . ' ' . $item['lastname']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Selección del horario -->
                                    <div class="form-group col-6">
                                        <label for="schedule_id">Seleccione el Dia <small id="infoDays"></small></label>
                                        <input type="date" name="day" id="day" value="<?= (!empty($data)) ? $data['date'] : date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" class="form-control" required>
                                    </div>

                                    <!-- Peso -->
                                    <div class="form-group col-6">
                                    <label for="schedule_id">Seleccione la hora</label>
                                        <!--<input type="hidden" id="tmpSchedule" value="<?= (!empty($data)) ? $data['hour'] : null ?>"> -->
                                        <select id="schedule" name="schedule" data-hour="<?= (!empty($data)) ? $data['hour'] : null ?>" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                        </select>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Verificar disponibilidad y guardar</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/copyright.php'; ?>
<aside class="control-sidebar control-sidebar-dark"></aside>
<script>
    const doctor_id = document.querySelector('#doctor_id'); //select
    const schedule = document.querySelector('#schedule'); //select
    const infoDays = document.querySelector('#infoDays'); //small
    //const tmpSchedule = document.querySelector('#tmpSchedule'); //small
    document.addEventListener('DOMContentLoaded', ()=>{
        let doctors = <?= json_encode($doctors) ?>;
        console.log(doctors);
        if(schedule.getAttribute('data-hour') != ''){ //si ya tiene una hora seleccionada
            let id = doctor_id.value;
            let query = doctors.find(r => r.id === id);
            chargeHours(query, schedule.getAttribute('data-hour'));
        }
        
        /*if(tmpSchedule.value !=''){ 
            let id = doctor_id.value;
            let query = doctors.find(r => r.id === id);
            chargeHours(query, tmpSchedule.value);
        }*/

        doctor_id.addEventListener('change', ()=>{
            let id = doctor_id.value;
            let query = doctors.find(r => r.id === id);
            const dias = JSON.parse(query.days);

            const diasString = dias.join(', ')
            infoDays.innerHTML = `(Horario del doctor: ${diasString})`;
            
            chargeHours(query);
        })
        
    })

    

    function chargeHours(query, value = null){
        schedule.innerHTML = '';            
        //select de horas
        let optionHour = document.createElement('option');
        optionHour.value = '';
        optionHour.text = 'Seleccionar';
        optionHour.disabled = true;
        optionHour.selected = true;
        schedule.appendChild(optionHour);
        if(query.start && query.end){
            let startHour = parseInt(query.start);
            let endHour = parseInt(query.end);

            for(let hour = startHour; hour <= endHour; hour++) {
                let option = document.createElement('option');
                option.value = hour;
                option.text = hour + ":00";
                if(value == hour){
                    option.selected = true;
                }
                schedule.appendChild(option);
            }
        }
    }
</script>
<?php require 'layout/footer.php'; ?>
