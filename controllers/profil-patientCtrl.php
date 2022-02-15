<?php
require 'models/Patients.php';
require 'models/Rdv.php';

$isPatientFound = false;
if (isset($_GET['patientId'])) {
    $patient = new Patients;
    $patient->setId(htmlspecialchars($_GET['patientId']));
    $patientInfos = $patient->getPatientInfo();

    $appointment = new Rdv;
    $appointment->setIdPatients($_GET['patientId']);
    $patientAppointmentList = $appointment->getAppointmentListByPatient();

    foreach ($patientAppointmentList as $appointment) {
    $appointment->dateHourView = explode(' ', $appointment->dateHourView);
    }

}

