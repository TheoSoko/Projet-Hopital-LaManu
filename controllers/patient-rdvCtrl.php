<?php 
require 'models/Patients.php';
require 'models/Rdv.php';

if (isset($_GET['patientRdv'])){
    $lastNameRdv = htmlspecialchars(trim($_GET['searchPatientLastName']));
    $patients = new Patients;
    $patients->setLastnameSearch($lastNameRdv);

    $errorMessage = '';
    if ($patients->getSearchedPatients() != false){
        $SearchedPatientList = $patients->getSearchedPatients();
    } else{
        $errorMessage = 'Désolé, aucun patient de correspond à votre recherche';
    }
}