<?php 
include 'parts/header.php';
include 'controllers/rdvInfosCtrl.php';
?>

<form action="" method="POST">

<!-- BOUTON MODIFICATION -->
<div class="d-flex justify-content-end me-5 mb-3"><span class="btn btn-myColor py-3 px-4 me-5 mt-3 fw-bold fs-5 shadow-sm" id="modifAppointmentBtn">Modifier ce rdv</span></div>
<div class="row">
    <!-- BOUTON REVENIR -->
    <div class="col d-flex justify-content-start mb-3" id="ReturnDiv"><span class="btn btn-myColor py-3 px-4 mt-3 fw-bold fs-5 shadow-sm" id="returnBtn">Revenir en arrière</span></div>
    <!-- BOUTON CONFIRMATION (INPUT SUBMIT) -->
    <div class="col d-flex justify-content-end me-5 mb-3 col" id="confirmAppointmentDiv"><span class="btn btn-myColor bg-primary py-3 px-4 me-5 mt-3 fw-bold fs-5 shadow-sm"
    id="confirmAppointmentBtn"><input type="submit" value="Confirmer le rdv" name="confirmAppointment" class="removeStyle p-0 m-0 bg-primary fw-bold text-white"></span></div>
</div>

<?php if (isset($successMessage)){ ?>
    <div class="text-center">
        <p class="mb-4 text-success fs-4 infoText"><?= $successMessage ?></p>
    </div>
<?php } else if (!empty($errorList)){ foreach($errorList as $error){?>
    <div class="text-center">
        <p class="mb-4 text-danger fw-bold fs-4 infoText"><?= $error ?></p>
    </div>
<?php }} ?>


<div class="container">
    <div class="d-flex justify-content-center">

        <div class="card shadow mt-3 cardInfosRdv">
            <div class="card-header"> <h1 class="card-title h2 pt-2 infoText"> Rendez-vous </h1> <h1 class="card-title h2 pt-2 infoInput"> Modification du rendez-vous </h1></div>
            <div class="card-body ps-4 pt-3">

                <!-- LES CLASSES "infoText" DISPARAISSENT AU CLIC DU BOUTON "Modifier", LES CLASSES "infoInput" APPARRAISSENT ALORS (IL S'AGIT DES INPUTS ET DES LABELS). -->
                    <p class="infoText pt-2"> 
                        <span class="fw-bold infoText"> Date : </span> <span class="infoText"><?= $appointmentinfos->dateHourView['0'] ?></span>
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Heure : </span> <span class="infoText"><?= $appointmentinfos->dateHourView['1'] ?></span>
                    </p>
                    <p>
                        <label for="dateHour" class="fw-bold me-2 infoInput">Date et heure : </label> <input type="datetime-local" name="dateHour" class="infoInput" value="<?= $appointmentinfos->dateHour?>">
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Patient : </span> <span class="infoText"><?= $appointmentinfos->name ?></span>
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Né(e) le : </span> <span class="infoText"><?= $appointmentinfos->birthdateView ?></span>
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Téléphone : </span> <span class="infoText"><a href="phoneto:<?=$appointmentinfos->phone?>"><?=preg_replace('/([0-9]{2})/', '$1 ', $appointmentinfos->phone )?></a> </span>
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Email : </span> <span class="infoText"> <a href="mailto:<?= $appointmentinfos->mail ?>"><?=$appointmentinfos->mail?></a> </span>
                    </p> 
            </div>
        </div>

    </div>
</div>

</form>




<?php include 'parts/footer.php' ?>