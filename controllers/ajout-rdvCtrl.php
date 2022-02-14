<?php 
require 'models/Patients.php';
require 'models/Rdv.php';
include 'class/Form.php';


//Si le premier formulaire est validé
if (isset($_GET['patientSearch']) && !empty('searchPatientLastName')){

    $errorList = [];
    $input = ['filter' => 'nameSearch', 'name' => 'searchPatientLastName', 'realName' => 'un nom'];
    $formValid = new Form;
    if ($formValid->checkGet($input)) {
        $lastNameRdv = htmlspecialchars(trim($_GET['searchPatientLastName']));
        $patients = new Patients;
        $patients->setLastnameSearch($lastNameRdv);
        if ($patients->getSearchedPatients() != false){
            $SearchedPatientList = $patients->getSearchedPatients();
        } else{
            $errorList['patientExists'] = 'Désolé, aucun patient de correspond à votre recherche';
        }
    } else {
        $errorList['lastname'] = $formValid->getErrorMessage();
    }

}


//Si le rdv a été confirmé (troisième formulaire)
if (isset($_POST['setAppointment'])){
    $errorList = [];
    $input = ['filter' => 'datetime', 'name' => 'datehour', 'realName' => 'une date et une heure'];
    $formValid = new Form;
    if ($formValid->checkPost($input)) {
        $datehour = str_replace('T', ' ', htmlspecialchars($_POST['datehour']));
        $appointments = new Rdv;
        $appointments->setDateHour($datehour);
        $checkAppointmentifExists = $appointments->checkIfAppointmentExists();
    } else {
        $errorList['datehour'] = $formValid->getErrorMessage();
    }


    if (count($errorList) == 0 && !$checkAppointmentifExists) {
        $appointments->setIdPatients(htmlspecialchars($_POST['idInput']));
        $appointments->addAppointment();
        $successMessage = "Le rendez-vous a bien été ajouté.";
    } else if ($checkAppointmentifExists) {
        $errorList['timeSlot'] = 'Désolé, ce créneau est déjà pris pour un autre rdv.';        
    } 
}

 


/* SELECT `dateHour`, `firstname`, `lastname`, `birthdate` FROM 
`appointments`
JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`
ORDER BY `appointments`.`id` ASC; */