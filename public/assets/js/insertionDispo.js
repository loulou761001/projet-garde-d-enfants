const btnSuivant = document.querySelector('.detailsSuivantBtn')
const btnSubmit = document.querySelector('.submit')
const partieDeux = document.querySelector('.detailsPartieDeux')
const inputHeures = document.querySelectorAll('input[data-jsname="inputHeures"]')
const labelHeures = document.querySelectorAll('label[data-jsname="inputHeures"]')
const inputEnfants = document.querySelectorAll('input[data-jsname="inputEnfants"]')
const erreurSuivant = document.querySelector('.erreurSuivant')
const erreurSubmit = document.querySelector('.erreurSubmit')


btnSuivant.addEventListener('click', function () {
    let heureCheck = 0
    event.preventDefault()
    inputHeures.forEach(function(heure) {
        if(heure.checked) {
            heureCheck = 1
        }
    })
    if(heureCheck === 1) {
        partieDeux.classList.remove('hidden')
        erreurSuivant.textContent = ""
        inputHeures.forEach(function(heure) {
            heure.setAttribute('onclick', 'return false');
        })
        labelHeures.forEach(function(heureLabel) {
            heureLabel.style.filter = 'grayscale(90%)'
        })
    } else {
        erreurSuivant.textContent = "Veuillez choisir une ou plusieurs heures."
    }
})
btnSubmit.addEventListener('click', function () {
    let enfantCheck = 0
    let minPlaces = 999
    let inputHeuresChecked = document.querySelectorAll('input[data-jsname="inputHeures"]:checked')
    let inputEnfantsChecked = document.querySelectorAll('input[data-jsname="inputEnfants"]:checked')
    inputHeuresChecked.forEach(function(singleHeure) {
        if(singleHeure.getAttribute('data-nbplaces') < minPlaces){
            minPlaces = singleHeure.getAttribute('data-nbplaces')
            console.log(minPlaces)
        }
    })
    inputEnfants.forEach(function(heure) {
        if(heure.checked) {
            enfantCheck = 1
        }
    })
    if(enfantCheck === 0) {
        event.preventDefault()
        erreurSubmit.textContent = "Veuillez choisir un ou plusieurs enfants à inscrire."
    } else if(inputEnfantsChecked.length > minPlaces) {
        event.preventDefault()
        erreurSubmit.textContent = "Veuillez selectionner jusqu'à "+minPlaces+" enfant(s)."
    }
    else {
        erreurSubmit.textContent = ""
    }
})