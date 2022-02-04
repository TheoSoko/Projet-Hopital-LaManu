<?php 
require 'models/Patients.php';
require 'models/Rdv.php';

if (isset($_GET['patientSearch']) && !empty('searchPatientLastName')){
    $lastNameRdv = htmlspecialchars(trim($_GET['searchPatientLastName']));
    $patients = new Patients;
    $patients->setLastnameSearch($lastNameRdv);

    if ($patients->getSearchedPatients() != false){
        $SearchedPatientList = $patients->getSearchedPatients();
    } else{
        $errorMessage = 'Désolé, aucun patient de correspond à votre recherche';
    }
}

if (isset($_POST['setAppointment'])){
    $id = htmlspecialchars($_POST['idInput']);
    $dateTimeAppointment = htmlspecialchars($_POST['dateTimeAppointment']);
    $appointments = new Rdv;
    $appointments->setIdPatients($id);
    $appointments->setDateHour($dateTimeAppointment);
    $result = $appointments->addAppointments();

}