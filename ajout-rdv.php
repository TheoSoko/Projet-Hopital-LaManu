<?php 
include 'parts/header.php';
//require 'controllers/liste-patientsCtrl.php';
require 'controllers/ajout-rdvCtrl.php'
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

<!-- Messages d'erreurs -->
<?php if (isset($errorList) && !isset($_POST['setAppointment'])){ ?>
        <?php foreach($errorList as $error ){?>
    <p class="fw-bold fs-5 ps-3 mt-5 text-danger"> <?= $error ?> </p>
<?php }} ?>  


<!-- Deuxième formulaire: s'affiche si la recherche a été effectuée -->
<?php if (isset($_GET['patientSearch']) && isset($SearchedPatientList) && !isset($_POST['patientSelect']) && !isset($_POST['setAppointment'])){  ?>
        <div class="row mx-1">
          <?php foreach ($SearchedPatientList as $patient){ ?>
                <form action="" method="POST" class="col-12 col-md-3 mb-4">
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
<?php } ?>

<!-- Troisème formulaire: s'affiche si le patient a été sélectionné -->

<?php if (isset($_POST['patientSelect']) || !empty($errorList)){ ?>
        <form action="" method="POST" class="text-center">
            <label for="dateTimeAppointment"><span class="h3 mb-5">Veuillez entrer une une date et une heure pour le rdv : </span> <br> <small class="<?= isset($classErrorMessage) ? $classErrorMessage : ""?>">(Les valeurs de minute ne peuvent être que 00, 15, 30, 45)</small> </label>
            <input type="datetime-local" name="datehour" step="900" required>
            <input type="hidden" value="<?=$_POST['idInput']?>" name="idInput">
            <input type="hidden" value="<?=$_POST['lastNameInput']?>" name="lastNameInput">
            <input type="hidden" value="<?=$_POST['firstNameInput']?>" name="firstNameInput">
            <input type="hidden" value="<?=$_POST['birthdateInput']?>" name="birthdateInput">
            <div class="mt-2">
            <?php if (!empty($errorList)) {?>
                <div>
                    <?php foreach($errorList as $error){?>
                        <p class="fw-bold text-danger mt-3"> <?= $error ?></p> <!--Résultat si le créneau est déjà pris -->  
                    <?php }?>
                </div>
            <?php } ?>
            <input type="submit" value="Confirmer le rdv" class="btn btn-myColor py-1 shadow" name="setAppointment">
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
<?php if (isset($_POST['setAppointment'])){ ?>
    <div class="text-center">
        <?php if (isset($successMessage)) {?>
            <p class="fw-bold fs-4 mt-5 pt-3 text-success"><?= $successMessage ?></p>
        <?php } ?>
    </div>
<?php } ?>


<?php include 'parts/footer.php' ?> 