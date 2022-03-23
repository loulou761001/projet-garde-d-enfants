console.log('Inscription JS')

const btn1=document.querySelector('#jsButton1')
const btn2=document.querySelector('#jsButton2')
const form1=document.querySelector('.form1')
const form2=document.querySelector('.form2')
const form3=document.querySelector('.form3')

btn1.addEventListener('click',function (){
    event.preventDefault();
    form1.classList.toggle('hidden')
    btn1.classList.toggle('hidden')
    form2.classList.toggle('hidden')
})

btn2.addEventListener('click',function (){
    event.preventDefault();
    console.log('click')
    form2.classList.toggle('hidden')
    btn2.classList.toggle('hidden')
    form3.classList.toggle('hidden')
})



