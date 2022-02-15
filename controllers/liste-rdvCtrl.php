<?php 
if (!isset($_POST['field'])){
    require 'models/Rdv.php';
} else if (isset($_POST['field'])){
    require '../models/Rdv.php';
    $listeId = $_POST['value'];
    $rdv = new Rdv;
    $rdv->setId(intval($listeId));
    echo $listeId;
}

$rdv = new Rdv;
$appointmentsList = $rdv->getAppointmentsList();
foreach ($appointmentsList as $appointment){
    $appointment->dateHourView = explode(' ', $appointment->dateHourView);
}



?>