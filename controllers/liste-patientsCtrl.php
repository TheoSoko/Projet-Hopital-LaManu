<?php
require 'models/Patients.php';

$patients = new Patients;
$patientsList = $patients->patientsList();


