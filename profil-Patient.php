<?php
include 'parts/header.php';
include 'controllers/profil-patientCtrl.php';
?>

<?php if ($patientInfos) { ?>
    <div class="row text-center mainTitle mb-4">
        <div class="col">
            <H1 class="display-5">Profil du patient</H1>
        </div>
    </div>
    

    <!-- Lien vers modification du patient avec paramètres!-->
    <span class="d-flex justify-content-end me-4 mb-3"> <a href="modifier-Patient.php?lastname=<?=$patient->getLastName()?>&firstname=<?=$patient->getFirstName()?>&birthdate=<?=$patient->getBirthDate()?>
    &birthdateview=<?=$patient->getBirthDateView()?>&phone=<?=$patient->getPhone()?>&mail=<?=$patient->getMail()?>&id=<?=$patient->getId()?>" class="btn btn-myColor py-4 px-4 me-5 fw-bold fs-5">Modifier ce patient</a></span>

    <div class="row text-center d-flex justify-content-center mb-5">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Nom</p>
                <p><?= $patient->getLastName() ?></p>
            </div>
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Prénom</p>
                <p><?= $patient->getFirstName() ?></p>
            </div>
    </div>

    <div class="row text-center d-flex justify-content-center mb-5">
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Date de naissance</p>
                <p><?= $patient->getBirthdateView() ?></p>
            </div>
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">Téléphone</p>
                <p><?= preg_replace('/([0-9]{2})/', '$1 ', $patient->getPhone()) ?></p>
            </div>
            <div class="patientInfos mx-3">
                <p class="fw-bold mb-2">email</p>
                <p><?= $patient->getMail() ?></p>
            </div>
    </div>

    <?php if (!empty($patientAppointmentList)){ ?>
        <div class="text-center pt-4 mb-4"><h2>Rendez-vous du patient</h2></div>
        <?php foreach ($patientAppointmentList as $appointment){ ?>
            <div class="d-flex justify-content-center">
                <div class="card shadow mt-3 cardInfosRdvPatient">
                    <div class="card-header"> <h1 class="card-title h4 pt-2 infoText"> Rendez-vous </h1> </div>
                    <div class="card-body ps-4 pt-3"> 
                        <p> <span class="fw-bold"> Date : </span> <?= $appointment->dateHourView['0'] ?> </p>
                        <p> <span class="fw-bold"> Heure : </span><?= $appointment->dateHourView['1'] ?> </p>
                    </div>
                </div>
            </div>
        <?php }} ?>












<?php } else { ?>
    <div class="row text-center mainTitle mb-5">
        <div class="col">
            <H1 class="display-5">Patient non trouvé</H1>
                <p class="text-danger">Merci de contacter le service technique si le problème persiste</p>
                <a href="liste-patients.php" class="btn btn-primary">Retour</a>
        </div>
    </div>
<?php } ?>


<?php include 'parts/footer.php'; ?>