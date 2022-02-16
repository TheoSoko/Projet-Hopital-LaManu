    
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

    //idList sert à récupérer les id des rdv
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
                    //Si tout est ok, je cache les lignes du tableau correspondant au rdv supprimé, avant le rechargement de la page. (Grâce aux id des <tr>)
                    for (i = 0; i < idList.length; i++){
                       document.getElementById(idList[i]).classList.add("d-none")
                   }
                } else {
                    console.log("c caca")
                }
            }
        }
    }