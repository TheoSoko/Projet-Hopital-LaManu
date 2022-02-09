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
<div class="container">
    <table class="table table-stripped px-3 mt-4">
        <thead>
            <th class="text-center">Nom</th>
            <th class="text-center">Prénom</th>
            <th class="text-center">Date de naissance</th>
        </thead>
            <?php foreach ($patientsList as $patient){?>
                <tr>
                    <td class="text-center"><p><?= $patient->lastname;?></p></td>
                    <td class="text-center"><p><?= $patient->firstname;?></p></td>
                    <td class="text-center"><?= $patient->birthdateView;?></td>
                    <td class="text-center"> <a href="profil-Patient.php?patientId=<?=$patient->id?>" class="text-decoration-none fw-bold btn btn-myColor px-4"> Voir le patient </a> </td>
                </tr>
            <?php }?>
    </table>
</div>


<?php include 'parts/footer.php'; ?>