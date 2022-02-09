<?php 
require 'models/Rdv.php';

$rdv = new Rdv;
$appointmentsList = $rdv->getAppointmentsList();
foreach ($appointmentsList as $appointment){
    $appointment->dateHourView = explode(' ', $appointment->dateHourView);
}


?>