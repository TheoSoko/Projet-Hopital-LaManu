<?php
require 'models/Patients.php';
$isPatientFound = false;
if (isset($_GET['patientId'])) {
    $patient = new Patients;
    $patient->setId(htmlspecialchars($_GET['patientId']));
    $isPatientFound = $patient->getPatientInfo();
}
