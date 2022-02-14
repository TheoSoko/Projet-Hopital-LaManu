<?php
include 'parts/header.php';
require 'controllers/ajout-patientCtrl.php';
?>


<div class="row text-center mainTitle">
    <div class="col">
        <H1 class="display-5">Modification du patient</H1>
    </div>
</div>

<!-- Message à la suite de la requête-->
<div class="text-center"> <p class="successMessage fw-bold fs-4 text-success"><?= !empty($successMessage) ? $successMessage : '' ?></p> </div>

<form action="" method="POST" class="mt-3" id="patientUpdateForm">
    <span class="d-flex justify-content-start me-4 mb-3"><input type="submit" value="Valider les modifications" class="btn btn-myColor py-4 px-4 ms-5 fw-bold fs-5 w-auto" name="updatePatient"></span>
    
    <div class="row text-center d-flex justify-content-center mb-4">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Nom</p>
                <input type="text" name="lastname" id="lastname" value="<?= $_GET['lastname'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['lastname'])){?>
                <p class="pt-2 errorMessage fw-bold"><?= $errorList['lastname'] ?></p> 
            <?php } ?> 

            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Prénom</p>
                <input type="text" name="firstname" id="firstname" value="<?= $_GET['firstname'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['firstname'])){?>
                <p class="pt-2 errorMessage fw-bold"><?= $errorList['firstname'] ?></p> 
            <?php } ?> 
    </div>

    <div class="row text-center d-flex justify-content-center">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Date de naissance</p>
                <input type="date" name="birthdate" value="<?= str_replace(' ', '', $_GET['birthdate'])?>" class= "mb-3"/>
            </div>
            <?php if (!empty($errorList['birthdate'])) {?>
                <p class="pt-2 errorMessage fw-bold"><?= $errorList['birthdate'] ?></p>
            <?php } ?> 

            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Téléphone</p>
                <input type="tel" name="phone" id="phone" value="<?= $_GET['phone'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['phone'])) {?>
                <p class="pt-2 errorMessage fw-bold"><?= $errorList['phone'] ?></p>
            <?php } ?> 

            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">email</p>
                <input type="email" name="mail" id="mail" value="<?= $_GET['mail'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['mail'])) {?>
                <p class="pt-2 errorMessage fw-bold"><?= $errorList['mail'] ?></p>
            <?php } ?> 

            <!-- Input hidden pour passer l'id-->
            <input type="hidden" name="id" value=" <?= $_GET['id'] ?> ">
    </div> 
</form>



<script src="assets/hospital.js"></script>
<?php include 'parts/footer.php'; ?>