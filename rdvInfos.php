<?php 
include 'parts/header.php';
include 'controllers/rdvInfosCtrl.php';
?>

<form action="" method="POST">

<!-- BOUTON MODIFICATION -->
<div class="d-flex justify-content-end me-5 mb-3"><span class="btn btn-myColor py-3 px-4 me-5 mt-3 fw-bold fs-5 shadow-sm" id="modifAppointment">Modifier ce rdv</span></div>
<div class="row">
    <!-- BOUTON REVENIR -->
    <div class="col justify-content-start mb-3" id="ReturnBtnDiv"><span class="btn btn-myColor py-3 px-4 mt-3 fw-bold fs-5 shadow-sm" id="returnBtn">Revenir en arrière</span></div>
    <!-- BOUTON CONFIRMATION (INPUT SUBMIT) -->
    <div class="col justify-content-end me-5 mb-3 col" id="confirmAppointmentDiv"><span class="btn btn-myColor bg-primary py-3 px-4 me-5 mt-3 fw-bold fs-5 shadow-sm"
     id="confirmAppointment"><input type="submit" value="Confirmer le rdv" name="confirmAppointment" class="removeStyle p-0 m-0 bg-primary fw-bold text-white"></span></div>
</div>

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
                        <label for="lastName" class="fw-bold me-2 infoInput"> Nom de famille : </label> <input type="text" class="infoInput" name="lastName" value="<?= $appointmentinfos->lastname?>">
                    </p>
                    <p>
                        <label for="firstName" class="fw-bold me-2 infoInput"> Prénom : </label> <input type="text" class="infoInput"  name="firstName" value="<?= $appointmentinfos->firstname?>">
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Né(e) le : </span> <span class="infoText"><?= $appointmentinfos->birthdateView ?></span>
                        <label for="birthdate" class="fw-bold me-2 infoInput">Date de naissance : </label> <input type="date" class="infoInput" name="birthdate" value="<?= $appointmentinfos->birthdate?>">
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Téléphone : </span> <span class="infoText"><a href="phoneto:<?=$appointmentinfos->phone?>"><?=$appointmentinfos->phone?></a> </span>
                    </p>
                    <p> 
                        <span class="fw-bold infoText"> Email : </span> <span class="infoText"> <a href="mailto:<?= $appointmentinfos->mail ?>"><?=$appointmentinfos->mail?></a> </span>
                    </p>                
            </div>
        </div>

    </div>
</div>

</form>


<script>
    //Event Listeners
    modifAppointment.addEventListener('click', changeToModif)
    returnBtn.addEventListener('click', changeToView)
    confirmAppointment.addEventListener('click', changeToView)

    //Fonction du bouton "Modifier ce rdv"
    function changeToModif(){
        this.style = "display: none"
        confirmAppointmentDiv.classList.add("d-flex")
        ReturnBtnDiv.classList.add("d-flex")
        let infoText = document.querySelectorAll(".infoText")
        for (let i = 0; i < infoText.length; i++) {
            infoText[i].style = "display: none"
        }
        let infoInput = document.querySelectorAll(".infoInput")
        for (let i = 0; i < infoInput.length; i++) {
            infoInput[i].style = "display: inline-block"
        }
    }

    //Fonction des boutons "Retour" et "Confirmer le rdv"
    function changeToView(){
        returnBtn.style = "display: none"
        confirmAppointment.style = "display: none"
        let infoText = document.querySelectorAll(".infoText")
        for (let i = 0; i < infoText.length; i++) {
            infoText[i].style = "display: inline-block"
        }
        let infoInput = document.querySelectorAll(".infoInput")
        for (let i = 0; i < infoInput.length; i++) {
            infoInput[i].style = "display: none"
        }
    }
</script>


<?php include 'parts/footer.php' ?>