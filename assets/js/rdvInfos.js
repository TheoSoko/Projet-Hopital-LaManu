    //Event Listeners
    modifAppointmentBtn.addEventListener('click', changeToModif)
    returnBtn.addEventListener('click', changeToView)
    confirmAppointmentBtn.addEventListener('click', changeToView)

    //Fonction du bouton "Modifier ce rdv"
    function changeToModif(){
        modifAppointmentBtn.style = "display: none"
        confirmAppointmentBtn.style = "display: inline"
        returnBtn.style = "display: inline"
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
        confirmAppointmentBtn.style = "display: none"
        modifAppointmentBtn.style = "display: inline"

        let infoText = document.querySelectorAll(".infoText")
        for (let i = 0; i < infoText.length; i++) {
            infoText[i].style = "display: inline-block"
        }
        let infoInput = document.querySelectorAll(".infoInput")
        for (let i = 0; i < infoInput.length; i++) {
            infoInput[i].style = "display: none"
        }
    }