<?php 
include 'parts/header.php';
//require 'controllers/liste-patientsCtrl.php';
require 'controllers/patient-rdvCtrl.php'
?>

<!-- Premier formulaire: s'affiche tant que le patient n'est pas sélectionné -->
<?php if (!isset($_POST['patientSelect']) && !isset($_POST['setAppointment'])) { ?>
    <form action="" method="GET" class="ms-3 mb-5">
        <p class="fs-4 mb-4"> Veuillez sélectionner le patient : </p>
        <div>
            <label for="searchPatientLastName" class="labelForm me-3"> Nom : </label>
            <input type="search" name="searchPatientLastName" id="searchPatientLastName">
        </div>
        <input type="submit" value="chercher patient" id="rdvSubmit" class="btn btn-myColor py-1 shadow" name="patientSearch">
    </form>
<?php } ?>

<!-- Deuxième formulaire: s'affiche si la recherche a été effectuée -->
<?php if (isset($_GET['patientSearch']) && isset($SearchedPatientList) && !isset($_POST['patientSelect']) && !isset($_POST['setAppointment'])){  ?>
        <div class="row mx-1">
          <?php foreach ($SearchedPatientList as $patient){ ?>
                <form action="" method="POST" class="col-3 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <p class="card-text"><?=$patient->lastname?></p>
                            <p class="card-text"><?=$patient->firstname?></p>
                            <p class="card-text">Né(e) le <?=$patient->birthdateView;?></p>
                            <input type="hidden" value="<?=$patient->id?>" name="idInput">
                            <input type="hidden" value="<?=$patient->lastname?>" name="lastNameInput">
                            <input type="hidden" value="<?=$patient->firstname?>" name="firstNameInput">
                            <input type="hidden" value="<?=$patient->birthdateView?>" name="birthdateInput">
                            <input type="submit" value="Sélectionner ce patient" class="btn btn-myColor shadow-sm" name="patientSelect">
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
<?php }else if (isset($errorMessage)){?>
        <p><?= $errorMessage ?></p>
<?php } ?>

<!-- Troisème formulaire: s'affiche si le patient a été sélectionné -->

<?php if (isset($_POST['patientSelect']) || !empty($wrongDatehour)){ ?>
        <form action="" method="POST" class="text-center">
            <label for="dateTimeAppointment" class="h3 mb-5">Veuillez entrer une une date et une heure pour le rdv : </label>
            <input type="datetime-local" name="dateTimeAppointment" required>
            <input type="hidden" value="<?=$_POST['idInput']?>" name="idInput">
            <input type="hidden" value="<?=$_POST['lastNameInput']?>" name="lastNameInput">
            <input type="hidden" value="<?=$_POST['firstNameInput']?>" name="firstNameInput">
            <input type="hidden" value="<?=$_POST['birthdateInput']?>" name="birthdateInput">
            <div class="mt-2">
                <p class="fw-bold text-danger mt-3"> <?= !empty($wrongDatehour) ? $resultMessage : ''?> </p> <!--Résultat si le créneau est déjà pris -->  
                <input type="submit" value="Confirmer le rdv" class="btn btn-myColor py-1 shadow" name="setAppointment">
            </div>
        </form>
    <div class="d-flex justify-content-center mt-4">
        <div class="card cardPatientLone pt-1 pb-2 shadow-sm">
            <div class="card-body">
                <p class="card-text"><?=$_POST['lastNameInput']?></p>
                <p class="card-text"><?=$_POST['firstNameInput']?></p>
                <p class="card-text">Né(e) le <?=$_POST['birthdateInput']?></p>
            </div>
        </div>
    </div>
<?php } ?>

<!--résultat -->
<?php if (isset($_POST['setAppointment']) && empty($wrongDatehour)){ ?>
    <div class="text-center">
        <p class="fw-bold fs-3 mt-5 text-myColor"><?= $resultMessage ?></p>
    </div>
<?php } ?>


<?php include 'parts/footer.php' ?> 