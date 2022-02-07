<?php 
require 'models/Patients.php';
require 'models/Rdv.php';

//Si le premier formulaire est validé
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

//Si le patient a été selectionné
if (isset($_POST['patientSelect'])){
    $wrongDatehour = false;
}

//Si le rdv a été confirmé (troisième formulaire)
if (isset($_POST['setAppointment'])){
    $id = htmlspecialchars($_POST['idInput']);
    $dateTimeAppointment = htmlspecialchars($_POST['dateTimeAppointment']);
    $appointments = new Rdv;
    $appointments->setIdPatients($id);
    $appointments->setDateHour($dateTimeAppointment);
    if ($appointments->checkIfAppointmentExists()){ 
        $wrongDatehour = 1;
        $resultMessage = 'Désolé, le créneau horaire est déjà utilisé pour un autre rdv.';
    } else {
        $wrongDatehour = 0;
        $resultMessage = $appointments->addAppointments() ? 'Merci à vous, le rdv a bien été enregistré!' : 'Désolé, une erreur est survenue, vous pouvez contacter le service technique.';
    }
}



/* SELECT `dateHour`, `firstname`, `birthdate` FROM 
`appointments`
JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`; */