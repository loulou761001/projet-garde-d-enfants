console.log('Inscription JS')

const btn1=document.querySelector('#jsButton1')
const btn2=document.querySelector('#jsButton2')
const btnDernier=document.querySelector('#dernierSubmit')
const form1=document.querySelector('.form1')
const form2=document.querySelector('.form2')
const form3=document.querySelector('.form3')
const ariane1=document.querySelector('.btnEtape1')
const ariane2=document.querySelector('.btnEtape2')
const ariane3=document.querySelector('.btnEtape3')
let ariane2Status = 0
let ariane3Status = 0
function activeBtnAriane(btn) {
    btn.style.backgroundColor = 'var(--vertclair)'
    btn.style.cursor = 'pointer'
}

btn1.addEventListener('click',function (){
    event.preventDefault();
    form1.classList.toggle('hidden')
    btn1.classList.toggle('hidden')
    form2.classList.toggle('hidden')
    // btn2.classList.toggle('hidden')
    ariane2Status = 1
    activeBtnAriane(ariane2)
})
ariane1.addEventListener('click',function (){
    console.log('click')
    form1.classList.remove('hidden')
    btn1.classList.remove('hidden')
    form2.classList.add('hidden')
    form3.classList.add('hidden')
})

btn2.addEventListener('click',function (){
    event.preventDefault();
    console.log('click')
    form2.classList.toggle('hidden')
    form3.classList.toggle('hidden')
    ariane3Status = 1
    activeBtnAriane(ariane3)

})
ariane2.addEventListener('click',function (){
    if (ariane2Status===1) {
        console.log('click')
        form2.classList.remove('hidden')
        btn2.classList.remove('hidden')
        form1.classList.add('hidden')
        btn1.classList.add('hidden')
        form3.classList.add('hidden')
        btnDernier.classList.add('hidden')
    }
})
ariane3.addEventListener('click',function (){
    if (ariane2Status===1) {
        console.log('click')
        form3.classList.remove('hidden')
        btnDernier.classList.remove('hidden')
        form1.classList.add('hidden')
        btn1.classList.add('hidden')
        form2.classList.add('hidden')
        btn2.classList.add('hidden')
    }
})
const errorSpans = document.querySelectorAll('span');
function validErreurs() {
    function contientNombres(string) {
        return /\d/.test(string);
    }
    let erreurs = {}


    //VERIF EMAIL
    const formatMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (document.querySelector('input#email').value.match(formatMail)) {
        erreurs['email'] = ''
    } else {
        erreurs['email'] = 'Veuillez rentrer une adresse email valide.'
    }

    //VERIF MDP
    if (document.querySelector('input#password').value.length>=50) {
        erreurs['motDePasse'] = 'Veuillez moins de 50 caractères.'
    } else if (document.querySelector('input#password').value.length<8) {
        erreurs['motDePasse'] = 'Veuillez rentrer au moins 8 caractères.'
    } else if (!contientNombres(document.querySelector('input#password').value)) {
        erreurs['motDePasse'] = 'Votre mot de passe doit contenir au moins 1 chiffre.'
    } else {
        erreurs['motDePasse'] = ''
    }

    //VERIF MDP DOUBLE
    if (document.querySelector('input#password').value !== document.querySelector('input#password2').value) {
        erreurs['motDePasse'] = 'Veuillez rentrer 2 mots de passe identiques.'
    }

    //VERIF NOM ET PRENOM
    if (document.querySelector('input#nom').value.length>=50) {
        erreurs['nom'] = 'Veuillez moins de 50 caractères.'
    } else if (document.querySelector('input#nom').value.length<3) {
        erreurs['nom'] = 'Veuillez rentrer au moins 2 caractères.'
    } else if (/[^a-zA-Z]/.test(document.querySelector('input#nom').value)) {
        erreurs['nom'] = 'Votre nom ne peut contenir que des lettres.'
    } else {
        erreurs['nom'] = ''
    }
    if (document.querySelector('input#prenom').value.length>=50) {
        erreurs['prenom'] = 'Veuillez moins de 50 caractères.'
    } else if (document.querySelector('input#prenom').value.length<3) {
        erreurs['prenom'] = 'Veuillez rentrer au moins 2 caractères.'
    } else if (/[^a-zA-Z]/.test(document.querySelector('input#prenom').value)) {
        erreurs['prenom'] = 'Votre nom ne peut contenir que des lettres.'
    } else {
        erreurs['prenom'] = ''
    }

    //VERIF TEL
    if (!/^(06|07)[0-9]{8}/gi.test(document.querySelector('input#phone').value.replace(/ /g,''))) {
        erreurs['tel'] = 'Veuillez entrer un numéro de téléphone valide.'
    } else {
        erreurs['tel'] = ''
    }
    //VERIF ADRESSE
    if (document.querySelector('input#numAdresse').value.length===0) {
        erreurs['numAdresse'] = 'Veuillez remplir ce champ.'
    } else {
        erreurs['numAdresse'] = ''
    }
    if (document.querySelector('input#adresse').value.length===0) {
        erreurs['adresse'] = 'Veuillez remplir ce champ.'
    } else {
        erreurs['adresse'] = ''
    }
    if (document.querySelector('input#ville').value.length===0) {
         erreurs['ville'] = 'Veuillez remplir ce champ.'
    } else {
        erreurs['ville'] = ''
    }
    if (document.querySelector('input#codePostal').value.length===0) {
        erreurs['codePostal'] = 'Veuillez remplir ce champ.'
    } else if(!/\d{5}/g.test(document.querySelector('input#codePostal').value) || document.querySelector('input#codePostal').value.length>5) {
        erreurs['codePostal'] = 'Veuillez rentrer un code postal valide.'
    } else {
        erreurs['codePostal'] = ''
    }
    return erreurs
}


btnDernier.addEventListener('click',function (){
    let aErreurs = 0

    validErreurs()
    let erreursArray = Object.entries(validErreurs())
    console.log(erreursArray)
    erreursArray.forEach(function(erreur) {
        console.log(erreur)
        errorSpans.forEach(function(errorSpan) {
            if(errorSpan.getAttribute('data-champ') === erreur[0]) {
                errorSpan.textContent = erreur[1]
                if (erreur[1].length >1) {
                    aErreurs = 1;
                    event.preventDefault();
                }
            }
        })
    });
})
