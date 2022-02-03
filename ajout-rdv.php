<?php 
include 'parts/header.php';
//require 'controllers/liste-patientsCtrl.php';
require 'controllers/patient-rdvCtrl.php'
?> 

<form action="" method="GET" class="ms-3">
    <p class="fs-4 mb-4"> Veuillez sélectionner le patient : </p>
    <div>
        <label for="searchPatient" class="labelForm me-3"> Nom : </label>
        <input type="search" name="searchPatientLastName">
    </div>
    <input type="submit" name="patientRdv" value="envoyer">
</form>

<?php if (isset($_GET['patientRdv']) && isset($SearchedPatientList)){ 
            foreach ($SearchedPatientList as $patient){ ?>
            <p><?=$patient->lastname;?></p>
            <?php } ?>
<?php }else if (isset($errorMessage)){?>
            <p><?= $errorMessage ?></p>
<?php } ?>
<?php include 'parts/footer.php' ?> 