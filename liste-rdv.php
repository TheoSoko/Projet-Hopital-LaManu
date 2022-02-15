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
    <div class="row">
        <div class="col text-start ms-4 mt-3"><a href="ajout-rdv.php" class="buttonAddPatient btn-myColor py-3 px-3 fw-bold">Ajouter un rdv</a></div>
        <div class="col text-end me-4">
            <button class="mb-4 btn-secondary buttonDeleteAppointment py-3 px-3 fw-bold" id="deleteAppointmentsBtn">Supprimer un rdv</button>
            <button class="d-none mb-4 buttonConfirmDelete py-3 px-3 fw-bold" id="ConfirmDeleteBtn">Supprimer la sélection</button>
        </div>
    </div>
</div>
<div class="container">
    <div class="row d-flex justify-content-center">
        <table class="table table-bordered table-hover mt-4">
            <thead>
                <th class="text-center">Date</th>
                <th class="text-center">Heure</th>
            </thead>
            <tbody>
                <?php foreach ($appointmentsList as $appointment){ ?>
                    <tr>
                        <td class="text-center">Le <?=$appointment->dateHourView['0']?></td>
                        <td class="text-center"><?=$appointment->dateHourView['1']?></td>
                        <td class="text-center"><a href="rdvInfos.php?id=<?=$appointment->id?>" class="text-decoration-none fw-bold btn btn-myColor px-4"> Voir le rdv </a></td>
                        <td class="text-center px-1 deleteSelect d-none "><button class="deleteSelectButton btn-danger fw-bold px-3 rounded" data-id="<?=$appointment->id?>">X</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    //Au clic sur "Supprimer un rdv"
    deleteAppointmentsBtn.addEventListener("click", changeToDelete)
    function changeToDelete(){
        let deleteSelect = document.querySelectorAll(".deleteSelect")
        for (let i = 0; i < deleteSelect.length; i++){
            deleteSelect[i].classList.remove("d-none") 
        }
        deleteAppointmentsBtn.classList.add("d-none")
        ConfirmDeleteBtn.classList.remove("d-none")
    }

    let idList = []

    //Au clic sur les petits boutons avec une croix
    document.addEventListener("click", event => {
        if(event.target.matches(".deleteSelectButton")){ 
            idList.push(event.target.dataset.id)
            event.target.classList.add("active") 
            console.log(idList)
        }
    })

    //Au clic sur Supprimer la sélection"
    ConfirmDeleteBtn.addEventListener("click", sendIdList)
    function sendIdList(){
        //L'affichage revient à la normale
        let deleteSelect = document.querySelectorAll(".deleteSelect")
        for (let i = 0; i < deleteSelect.length; i++){
            deleteSelect[i].classList.add("d-none") 
        }
        deleteAppointmentsBtn.classList.remove("d-none")
        ConfirmDeleteBtn.classList.add("d-none")

        //On envoie la liste d'id
        
        let xhr = new XMLHttpRequest()
        xhr.open("POST", "controllers/liste-rdvCtrl.php", true)
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhr.send("id=truc&field=AppointmentList&value=" + idList)
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText == 1) {
                    console.log("c ok")
                } else {
                    console.log("c caca")
                }
            }
        }
    }




</script>


<?php include 'parts/footer.php'?>