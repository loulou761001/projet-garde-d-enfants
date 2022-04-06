
console.log('pdf')



const options = {
    margin: 0,
    filename: 'invoice.pdf',
    image: {
        type: 'jpeg',
        quality: 500
    },
    html2canvas: {
        scale: 1,
        scrollY: 0
    },
    jsPDF: {
        unit: 'in',
        format: 'letter',
        orientation: 'portrait'
    }
}

document.querySelector('.factureBtn').addEventListener("click",function(e){
    console.log('click')
    e.preventDefault();
    const facture = document.querySelector('#facture')
    html2pdf().from(facture).set(options).save();
});


