<?php 

$scriptList = ['assets/js/liste-rdv.js'];

if (!isset($_POST['field'])){
    require 'models/Rdv.php';
} else if (isset($_POST['field'])){
    require '../models/Rdv.php';
    $idChain = $_POST['value'];
    $rdv = new Rdv;
    $idList = explode(',', $idChain);
    foreach ($idList as $id){
        $rdv->setId($id);
        $check = $rdv->deleteAppointment();
    }
    echo $check;
}

$rdv = new Rdv;
$appointmentsList = $rdv->getAppointmentsList();
foreach ($appointmentsList as $appointment){
    $appointment->dateHourView = explode(' ', $appointment->dateHourView);
}

?>