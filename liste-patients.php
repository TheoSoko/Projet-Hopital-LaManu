<?php
include 'parts/header.php';
require 'controllers/liste-patientsCtrl.php';
?>

<div class="row text-center mainTitle">
    <div class="col">
        <H1 class="display-5">Liste des patients</H1>
    </div>
</div>

<div class="row">
    <div class="col text-start my-auto ms-5"><a href="ajout-patient.php" class="ms-5 buttonAddPatient btn-myColor py-3 px-3 fw-bold">Ajouter un patient</a></div>
    <div class="col text-center">
        <form method="GET">
            <label for="searchPatient" class="d-none fw-bold ms-3">Rechercher un patient</label>
            <input type="search" name="searchPatient" id="searchPatient" class="ms-5 mt-4" placeholder="Recherche" required> 
            <button type="submit" class="searchButton" name="searchPatientSubmit" id="searchPatientSubmit">
                <svg class="mb-1 ms-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
            </button>
            <!-- Affichage du message d'erreur-->
            <?php if (!empty($errorList['search'])){ ?>
                    <div class="text-center"><p class="fw-bold text-danger"><?= $errorList['search'] ?></p></div>
            <?php } ?>
        </form>
        <?php if (isset($searchSet)){ ?>
            <div class="pt-5"><a href="liste-patients.php" class="btn btn-myColor" id="returnToList">Retour à la liste</a></div>
        <?php } ?>
    </div>
    <div class="col my-auto text-end me-5">
        <button class="me-5 buttonDeletePatient py-3 px-3 fw-bold" id="deletePatientBtn"> Supprimer un patient </button>
        <button class="me-5 d-none mb-4 buttonConfirmDelete py-3 px-3 fw-bold" id="ConfirmDeleteBtn">Supprimer la sélection</button>
    </div>
</div>


<div class="container">
    <table class="table table-bordered table-stripped px-3 mt-5">
        <thead>
            <th class="text-center">Nom</th>
            <th class="text-center">Prénom</th>
            <th class="text-center">Date de naissance</th>
        </thead>
            <?php foreach ($patientsList as $patient){?>
                <tr id="<?=$patient->id?>">
                    <td class="text-center"><p><?= $patient->lastname;?></p></td>
                    <td class="text-center"><p><?= $patient->firstname;?></p></td>
                    <td class="text-center"><?= $patient->birthdateView;?></td>
                    <td class="text-center"> <a href="profil-Patient.php?patientId=<?=$patient->id?>" class="text-decoration-none fw-bold btn btn-myColor px-4"> Voir le patient </a> </td>
                    <td class="text-center px-1 deleteSelect d-none "><button class="deleteSelectButton fw-bold px-3 rounded" data-id="<?=$patient->id?>">X</button></td>
                </tr>
            <?php }?>
    </table>
</div>


<?php include 'parts/footer.php'; ?>