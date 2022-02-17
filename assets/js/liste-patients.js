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


        // Formulaire virtuel sans html 
        const formData = new FormData();
        formData.append("idList", idList);

        // Ajax
        fetch("./controllers/liste-patientsCtrl.php", {  method: 'POST', body: formData })
        .then(response => response.text()) // si je recois du json je met .json() a la place
        .then(response => console.log(response))

        if (response = 1){
            for (i = 0; i < idList.length; i++){
                document.getElementById(idList[i]).classList.add("d-none")
            }
        }
    }