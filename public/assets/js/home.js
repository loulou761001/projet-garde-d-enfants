const btnNounous = document.querySelector('#btnNounous')
const btnParents = document.querySelector('#btnParents')
const avisNounous= document.querySelector('.avisNounous')
const avisParents = document.querySelector('.avisParents')


btnNounous.addEventListener('click', function () {
    avisParents.style.height = '0'
    avisNounous.style.height = 'auto'
})
btnParents.addEventListener('click', function () {
    avisNounous.style.height = '0'
    avisParents.style.height = 'auto'
})