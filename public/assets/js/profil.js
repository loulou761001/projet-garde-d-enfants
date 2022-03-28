console.log('profil')

const btn = document.querySelector('#js_btn')
const popup = document.querySelector('#popup')
const close=document.querySelector('#close')
const html=document.querySelector('html')

btn.addEventListener('click',function (){
    event.preventDefault();
    popup.classList.toggle('hidden')
    popup.classList.toggle('flex')
    html.classList.toggle('relative')
})

close.addEventListener('click',function (){
    event.preventDefault();
    popup.classList.toggle('hidden')
    popup.classList.toggle('flex')
    html.classList.toggle('relative')
})