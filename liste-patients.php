<?php
include 'parts/header.php';
require 'controllers/liste-patientsCtrl.php';
?>

<div class="row text-center mainTitle">
    <div class="col">
        <H1 class="display-5">Liste des patients</H1>
    </div>
</div>

<div class="text-end"><a href="ajout-patient.php" class="me-4 buttonAddPatient btn-myColor py-3 px-3 fw-bold">Ajouter un patient</a></div>
<table class="table table-stripped mx-3 mt-4">
    <thead>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
    </thead>
        <?php foreach ($patientsList as $patient){?>
            <tr>
                <td><p><?= $patient->lastname;?></p></td>
                <td><p><?= $patient->firstname;?></p></td>
                <td><?= $patient->birthdateView;?></td>
                <td> <a href="profil-Patient.php?patientId=<?=$patient->id?>" class="text-decoration-none fw-bold btn btn-myColor px-4"> Voir le patient </a> </td>
            </tr>
        <?php }?>
    </form>

</table>



<?php include 'parts/footer.php'; ?>