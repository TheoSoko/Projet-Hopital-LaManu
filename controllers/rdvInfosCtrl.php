<?php 
require 'models/Rdv.php';

$rdv = new Rdv;
$rdv->setDateHour($_GET['dateHour']);
$appointmentinfos = $rdv->getAppointment();
$appointmentinfos->dateHourView = explode(' ', $appointmentinfos->dateHourView);

if (isset($_POST['confirmAppointment'])){
    
}
?>