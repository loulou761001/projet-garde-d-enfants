console.log('profil')

const btn = document.querySelector('#js_btn')
const popup = document.querySelector('#popup')
const close=document.querySelector('#close')
btn.addEventListener('click',function (){
    event.preventDefault();
    popup.classList.toggle('hidden')
    popup.classList.toggle('flex')
})

close.addEventListener('click',function (){
    event.preventDefault();
    popup.classList.toggle('hidden')
    popup.classList.toggle('flex')
})