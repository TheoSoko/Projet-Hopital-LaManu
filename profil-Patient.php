<?php
include 'parts/header.php';
include 'controllers/profil-patientCtrl.php';
?>


<div class="row text-center mainTitle mb-5">
    <div class="col">
        <H1 class="display-5">Profil du patient</H1>
    </div>
</div>

    <div class="row text-center d-flex justify-content-center mb-4">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Nom</p>
                <p><?= $patient->lastname ?></p>
            </div>
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Prénom</p>
                <p><?= $patient->firstname ?></p>
            </div>
    </div>

    <div class="row text-center d-flex justify-content-center">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Date de naissance</p>
                <p><?= $patient->birthdate ?></p>
            </div>
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Téléphone</p>
                <p><?= $patient->phone ?></p>
            </div>
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">email</p>
                <p><?= $patient->mail ?></p>
            </div>
    </div>



<?php include 'parts/footer.php'; ?>