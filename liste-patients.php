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
    <div class="col text-start"><a href="ajout-patient.php" class="ms-5 my-auto buttonAddPatient btn-myColor py-3 px-3 fw-bold">Ajouter un patient</a></div>
    <div class="col text-center">
        <form method="GET">
            <label for="searchPatient" class="fw-bold">Rechercher un patient</label>
            <input type="search" name="searchPatient" required>
            <!-- Affichage du message d'erreur-->
            <?php if (!empty($errorList['search'])){ ?>
                    <div class="text-center"><p class="fw-bold text-danger"><?= $errorList['search'] ?></p></div>
            <?php } ?>
            <input type="submit" value="Recherche" class="d-block mx-auto" name="searchPatientSubmit">
        </form>
    </div>
    <div class="col mb-4 text-end">
        <button class="me-5 my-auto buttonDeletePatient btn-secondary py-3 px-3 fw-bold" id="deletePatientBtn"> Supprimer un patient </button>
        <button class="me-5 d-none mb-4 buttonConfirmDelete py-3 px-3 fw-bold" id="ConfirmDeleteBtn">Supprimer la sélection</button>
    </div>
</div>


<div class="container">
    <table class="table table-bordered table-stripped px-3 mt-4">
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
                    <td class="text-center px-1 deleteSelect d-none "><button class="deleteSelectButton fw-bold px-3 rounded" data-id="<?=$patient->id?>">X</button></td>
                </tr>
            <?php }?>
    </table>
</div>














<script>
    //Au clic sur "Supprimer un patient"
    deletePatientBtn.addEventListener("click", changeToDelete)
    function changeToDelete(){
        let deleteSelect = document.querySelectorAll(".deleteSelect")
        for (let i = 0; i < deleteSelect.length; i++){
            deleteSelect[i].classList.remove("d-none") 
        }
        deletePatientBtn.classList.add("d-none")
        ConfirmDeleteBtn.classList.remove("d-none")
    }

    //idList sert à récupérer les id des patients
    let idList = []

    //AU CLIC SUR LES PETITS BOUTONS AVEC UN CROIX
    document.addEventListener("click", event => {
        if(event.target.matches(".deleteSelectButton")){ 
            //Ajout et retrait des valeurs du tableau
            let dataId = event.target.dataset.id
            if (!idList.includes(dataId)){
                idList.push(dataId)
            } else {
                let index = idList.indexOf(dataId)
                idList.splice(index, 1)
            }
            // Activation et désactivation des boutons dans l'affichage
            if (!event.target.classList.contains("deleteSelectButton-clicked")){ 
                event.target.classList.add("deleteSelectButton-clicked")
            } else {
                event.target.classList.remove("deleteSelectButton-clicked") 
            }
            
            //Vérification du tableau idList
            console.log(idList)
        }
    })

    //AU CLIC SUR "SUPPRIMER LA SELECTION"
    ConfirmDeleteBtn.addEventListener("click", sendIdList)
    function sendIdList(){
        //L'affichage revient à la normale
        let deleteSelect = document.querySelectorAll(".deleteSelect")
        for (let i = 0; i < deleteSelect.length; i++){
            deleteSelect[i].classList.add("d-none") 
        }
        deletePatientBtn.classList.remove("d-none")
        ConfirmDeleteBtn.classList.add("d-none")


        // je crée un formulaire virtuel sans html 
        const formData = new FormData();
        formData.append("idList", idList);

        // autre façon de faire de l'ajax
        fetch("./controllers/liste-patientsCtrl.php", {  method: 'POST', body: formData })
        .then(response => response.text()) // si je recois du json je met .json() a la place
        .then(response => console.log(response))

        if (response = 1){
            console.log('yes')
        }
    }


</script>


<?php include 'parts/footer.php'; ?>