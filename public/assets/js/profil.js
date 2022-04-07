console.log('profil')

const btn = document.querySelector('#js_btn')
const popup = document.querySelector('#popup')
const close=document.querySelector('#close')
const html=document.querySelector('html')

const submit=document.querySelector('input[type=submit]')
const carnetErreur=document.querySelector('.carnetErreur')

btn.addEventListener('click',function (){
    event.preventDefault();
    popup.classList.toggle('hidden')
    popup.classList.toggle('flex')
    html.classList.toggle('relative')
    window.scrollTo(0, document.body.scrollHeight / 4);
})


close.addEventListener('click',function (){
    event.preventDefault();
    popup.classList.toggle('hidden')
    popup.classList.toggle('flex')
    html.classList.toggle('relative')
})
submit.addEventListener('click',function () {
    let carnet=document.querySelector('#carnet')
    console.log(carnet.value)
    if (carnet.value.length > 0) {
        let parts = carnet.value.split('.');
        console.log(parts)
        if (parts['1'] !== "pdf" && parts['1'] !== 'jpg' && parts['1'] !== 'jpeg' && parts['1'] !== 'png') {
            console.log('erreur')
            event.preventDefault()
            document.querySelector('.carnetErreur').textContent = 'veuillez chosir un type de fichier valide (pdf ou image)'
        }
    }
})