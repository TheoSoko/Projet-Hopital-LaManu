<?php
require 'models/Patients.php';

if (isset ($_GET['patientSelectSubmit'])){
    $patientInstance = new Patients;
    $patientInstance->id = $_GET['patientIdInput'];
    $patient = $patientInstance->patientInfo();
}



