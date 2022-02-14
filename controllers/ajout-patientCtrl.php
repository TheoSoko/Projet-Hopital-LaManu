<?php
require 'class/Form.php';
require 'models/Patients.php';

// $firstnameArray = ['filter' => 'name', 'name' => 'firstname', 'realName' => 'un prénom'];
// $lastnameArray = ['filter' => 'name', 'name' => 'lastname', 'realName' => 'un nom de famille'];
// $birthdateArray = ['filter' => 'date', 'name' => 'birthdate', 'realName' => 'une date de naissance'];
// $inputArray = [ $lastnameArray,$firstnameArray, $birthdateArray];

$inputArray = [
    ['filter' => 'name', 'name' => 'firstname', 'realName' => 'un prénom', 'placeholder' => '', 'label' => 'Prénom', 'type' => 'text'],
    ['filter' => 'name', 'name' => 'lastname', 'realName' => 'un nom de famille', 'placeholder' => '', 'label' => 'Nom de famille', 'type' => 'text'],
    ['filter' => 'date', 'name' => 'birthdate', 'realName' => 'une date de naissance', 'placeholder' => '', 'label' => 'Date de naissance', 'type' => 'date'],
    ['filter' => 'phone', 'name' => 'phone', 'realName' => 'un numéro de téléphone', 'placeholder' => '', 'label' => 'Téléphone', 'type' => 'text'],
    ['filter' => 'email', 'name' => 'mail', 'realName' => 'une adresse de couriel', 'placeholder' => '', 'label' => 'Adresse de courriel', 'type' => 'email'],
];
//Quand l'utilisateur a appuyé sur le bouton
if (isset($_POST['addPatient']) || isset($_POST['updatePatient'])) {
    $errorList = [];
    $formVerif = new Form;

    $valueArray = [];
    foreach ($inputArray  as $input) {
        if ($formVerif->checkPost($input)) {
            $valueArray[$input['name']] = $_POST[$input['name']];
        } else {
            $errorList[$input['name']] = $formVerif->getErrorMessage();
        }
    }

//Pour les placeholders si une des valeurs n'est pas bonne.
    $placeHolderArray = [];
    foreach ($inputArray as $input){
        $placeHolderArray[$input['name']] = $_POST[$input['name']];
    }



    if (count($errorList) == 0) {
        $patient = new Patients;
        $patient->setLastname(htmlspecialchars($valueArray['lastname']));
        $patient->setFirstname(htmlspecialchars($valueArray['firstname']));
        $patient->setBirthdate(htmlspecialchars($valueArray['birthdate']));
        $patient->setPhone(htmlspecialchars($valueArray['phone']));
        $patient->setMail(htmlspecialchars($valueArray['mail']));

        //Si on veut ajouter un patient:
        if (isset($_POST['addPatient'])) {
            if (!$patient->checkPatientIfExists()) {
                $patient->addPatient();
            }else{
                $errorList['addPatient'] = 'Ce patient existe déjà';
            }

        //Si on veut modifier un patient:
        } else if (isset($_POST['updatePatient'])){
                $patient->setId((int)$_POST['id']);
                if ($patient->patientUpdate()){
                    $successMessage =  'Le patient a bien été mis à jour';
                }
        }
    }
}
