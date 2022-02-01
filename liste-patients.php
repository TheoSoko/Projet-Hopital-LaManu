<?php
include 'parts/header.php';
require 'controllers/liste-patientsCtrl.php';
?>

<div class="row text-center mainTitle">
    <div class="col">
        <H1 class="display-5">Liste des patients</H1>
    </div>
</div>

<div class="text-end"><a href="ajout-patient.php" class="me-4 buttonAddPatient py-3 px-3 fw-bold">Ajouter un patient</a></div>
<table class="table table-stripped">
    <thead>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
    </thead>
        <?php foreach ($patientsList as $patient){?>
            <form action="profil-Patient.php" method="GET">
                <tr>
                    <input type="hidden" name="patientIdInput" value="<?= $patient->id?>">
                    <td> <input type="submit" value="<?=$patient->lastname ?>" name="patientSelectSubmit"> </td>
                    <td><p><?= $patient->firstname;?></p></td>
                    <td><?= $patient->birthdate;?></td>
                </tr>
            </form>
        <?php }?>
    </form>

</table>



<?php include 'parts/footer.php'; ?>