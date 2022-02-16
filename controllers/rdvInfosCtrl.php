<?php 
require 'models/Rdv.php';
require 'models/Patients.php';

//Source du scrit, utilisé dans parts/footer.php
$scriptList = ['assets/js/rdvInfos.js'];

$rdv = new Rdv;
$rdv->setId($_GET['id']);
$appointmentinfos = $rdv->getAppointment();
$appointmentinfos->dateHourView = explode(' ', $appointmentinfos->dateHourView);

if (isset($_POST['confirmAppointment'])){

    //Utilisation de la classe Form pour les vérifications
    require 'class/Form.php';
    $formValid = new Form;
    $errorList = [];
    $input = ['filter' => 'datetime', 'name' => 'dateHour', 'realName' => 'une date et une heure'];

    if ($formValid->checkPost($input)){
        $dateHour = htmlspecialchars(str_replace('T', ' ', $_POST['dateHour']));
        $rdv->setDateHour($dateHour);
        $rdv->setId($_GET['id']);
        $result = $rdv->appointmentUpdate();
        if ($result){
            $successMessage = 'Le rendez-vous a bien été modifié, merci!';
        } else {
            $errorList['unknownError'] = 'Nous sommes désolés, une erreur inconnue est survenue, vous pouvez réessayer plus tard ou contacter notre service technique.';
        }
    } else {
        $errorList['dateHour'] = $formValid->getErrorMessage();
    }
}
?>