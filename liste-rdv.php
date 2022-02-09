<?php 
include 'parts/header.php';
include 'controllers/liste-rdvCtrl.php';
?>

<div class="row text-center mainTitle">
    <div class="col">
        <H1 class="display-5 mb-1">Liste des rendez-vous</H1>
    </div>
</div>
<div class="container">
    <div class="text-end"><a href="ajout-rdv.php" class="me-4 buttonAddPatient btn-myColor py-3 px-3 fw-bold">Ajouter un rdv</a></div>

        <table class="table table-bordered table-hover mt-5">
            <thead>
                <th class="text-center">Date</th>
                <th class="text-center">Heure</th>
            </thead>
            <tbody>
                <?php foreach ($appointmentsList as $appointment){ ?>
                    <tr>
                        <td class="text-center">Le <?=$appointment->dateHourView['0']?></td>
                        <td class="text-center"><?=$appointment->dateHourView['1']?></td>
                        <td class="text-center"><a href="rdvInfos.php?dateHour=<?=$appointment->dateHour?>" class="text-decoration-none fw-bold btn btn-myColor px-4"> Voir le rdv </a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>




<?php include 'parts/footer.php'?>