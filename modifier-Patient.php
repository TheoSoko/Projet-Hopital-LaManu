<?php
include 'parts/header.php';
require 'controllers/ajout-patientCtrl.php';
?>


<div class="row text-center mainTitle mb-5">
    <div class="col">
        <H1 class="display-5">Profil du patient</H1>
    </div>
</div>
<form action="" method="post">
    <div class="row text-center d-flex justify-content-center mb-4">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Nom</p>
                <input type="text" name="lastname" id="lastname" placeholder="<?= $_POST['lastname'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['lastname'])){?> <p class="pt-2 errorMessage"><?= $errorList['lastname'] ?> </p> <?php } ?> 

            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Prénom</p>
                <input type="text" name="firstname" id="firstname" placeholder="<?= $_POST['firstname'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['firstname'])){?> <p class="pt-2 errorMessage"><?= $errorList['firstname'] ?> </p> <?php } ?> 
    </div>

    <div class="row text-center d-flex justify-content-center">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Date de naissance</p>
                <input type="text" name="birthdate" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="<?= $_POST['birthdate']?>" class= "mb-3"/>
            </div>
            <?php if (!empty($errorList['birthdate'])){?> <p class="pt-2 errorMessage"><?= $errorList['birthdate'] ?> </p> <?php } ?> 

            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Téléphone</p>
                <input type="tel" name="phone" id="phone" placeholder="<?= $_POST['phone'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['phone'])){?> <p class="pt-2 errorMessage"><?= $errorList['phone'] ?> </p> <?php } ?> 

            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">email</p>
                <input type="email" name="mail" id="mail" placeholder="<?= $_POST['mail'] ?>" class="mb-3">
            </div>
            <?php if (!empty($errorList['mail'])){?> <p class="pt-2 errorMessage"><?= $errorList['mail'] ?> </p> <?php } ?> 

            <!-- Input hidden pour passer l'id-->
            <input type="hidden" name="id" value=" <?= $_POST['id'] ?> ">
    </div> 

    <input type="submit" value="Valider les modifications" name="updatePatient">

</form>
<p class="successMessage"><?= !empty($successMessage) ? $successMessage : '' ?></p>




<?php include 'parts/footer.php'; ?>