<?php
require 'models/Patients.php';

if (isset ($_GET['patientSelectSubmit'])){
    $patientInstance = new Patients;
    $id = $_GET['patientIdInput'];
    $patientInstance->id = $_GET['patientIdInput'];
    $patient = $patientInstance->patientInfo();
}



