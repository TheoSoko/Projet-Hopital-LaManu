<?php
$scriptList = ['assets/js/liste-patients.js'];

if (isset($_POST['idList'])){
    require '../models/Patients.php';
} else {
    require 'models/Patients.php';
}

$patients = new Patients;
//Si il n'y a pas de recherche
if (!isset($_GET['searchPatientSubmit'])){
    $patientsList = $patients->patientsList();
} else { 
    //Si une recherche a été lancée
    //Vérifications avec la classe form
    require 'class/Form.php';
    $formValid = new Form;
    $errorList = [];
    $input = ['filter' => 'nameSearch', 'name' => 'searchPatient', 'realName' => 'un nom ou un prénom'];
    //Si la valeur du champ passe les vérifications
    if ($formValid->checkGet($input)){
        $patientSearch = $_GET['searchPatient'];
        $patients->setNameSearch(htmlspecialchars($patientSearch));
        $patientsList = $patients->getSearchedPatients();
    } else {
        //Sinon on affiche quand même tous les rdv et on définit le message d'erreur
        $patientsList = $patients->patientsList();
        $errorList['search'] = $formValid->getErrorMessage();
    }
}





/*
if (isset($_POST['idList'])){
    $idChain = $_POST['idList'];
    if (!empty($idChain)){
        echo (1);
        $idList = explode(',', $idChain);
        $patients->setIdList($idList);
        if ($rdv->deletePatientQuery()){
            $check = 'super';
        } else {
            $check = 'naze' ;
        }
    }
}
*/


