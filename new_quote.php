<?php 
    session_start();
    // VALIDAR SI EXISTE LA VARIABLE DE SESIÓN LOGIN Y SI ES VERDADERA
    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
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
                                        <select id="patient_id" name="patient_id" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($patients as $item) { ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Selección del doctor -->
                                    <div class="form-group col-6">
                                        <label for="doctor_id">Seleccione el Doctor</label>
                                        <select id="doctor_id" name="doctor_id" class="form-control"  required>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($doctors as $item) { ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['name'] . ' ' . $item['lastname']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Selección del horario -->
                                    <div class="form-group col-6">
                                        <label for="schedule_id">Seleccione el Dia</label>
                                        <select id="days" name="day" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                        </select>
                                    </div>

                                    <!-- Peso -->
                                    <div class="form-group col-6">
                                    <label for="schedule_id">Seleccione la hora</label>
                                        <select id="schedule" name="schedule" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                        </select>
                                    </div>

                            

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Guardar Cita</button>
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
    document.addEventListener('DOMContentLoaded', ()=>{
        let doctors = <?= json_encode($doctors) ?>;
        console.log(doctors);
        const doctor_id = document.querySelector('#doctor_id'); //select
        const days = document.querySelector('#days'); //select
        const schedule = document.querySelector('#schedule'); //select

        doctor_id.addEventListener('change', ()=>{
            let id = doctor_id.value;
            let query = doctors.find(r => r.id === id);
            days.innerHTML = '';
            let option = document.createElement('option')
            option.value ='';
            option.text= 'Seleccionar'
            option.disabled = true;
            option.selected = true;
            days.appendChild(option)
            if(query.days){
                let dias = JSON.parse(query.days)
                for (const key in dias) {
                    let option = document.createElement('option')
                    option.value = dias[key];
                    option.text = dias[key];
                    days.appendChild(option);
                }
            }
        })
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        let doctors = <?= json_encode($doctors) ?>;
        const doctor_id = document.querySelector('#doctor_id'); // select para doctor
        const days = document.querySelector('#days'); // select para dias
        const schedule = document.querySelector('#schedule'); // select para horas

        doctor_id.addEventListener('change', () => {
            let id = doctor_id.value;
            let query = doctors.find(r => r.id === id);
            
            
            days.innerHTML = '';
            schedule.innerHTML = '';
            
            
            let optionDay = document.createElement('option');
            optionDay.value = '';
            optionDay.text = 'Seleccionar';
            optionDay.disabled = true;
            optionDay.selected = true;
            days.appendChild(optionDay);
            
            
            let optionHour = document.createElement('option');
            optionHour.value = '';
            optionHour.text = 'Seleccionar';
            optionHour.disabled = true;
            optionHour.selected = true;
            schedule.appendChild(optionHour);

            
            if(query.days){
                let dias = JSON.parse(query.days);
                for (const key in dias) {
                    let option = document.createElement('option');
                    option.value = dias[key];
                    option.text = dias[key];
                    days.appendChild(option);
                }
            }

            
            if(query.start && query.end){
                let startHour = parseInt(query.start);
                let endHour = parseInt(query.end);

                for(let hour = startHour; hour <= endHour; hour++) {
                    let option = document.createElement('option');
                    option.value = hour;
                    option.text = hour + ":00";
                    schedule.appendChild(option);
                }
            }
        });
    });
</script>

<?php require 'layout/footer.php'; ?>
