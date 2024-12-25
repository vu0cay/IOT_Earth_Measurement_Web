// import { initUnitForm } from "./unit.js"
// import { initAmenityForm } from "./amenity.js"
// document.addEventListener('DOMContentLoaded', function () {

//     console.log('DOM loaded')
//     const $ = document.querySelector.bind(document)
//     const $$ = document.querySelectorAll.bind(document)

//     const btns = $$('.featureBtn')
//     // console.log(btns)
//     btns.forEach(btn => {
//         btn.addEventListener('click', function () {
//             const theForm = this.getAttribute('data-content')
//             changeContent(theForm)
//         })
//     })

//     function initForm(feature) {
//         console.log('Init ran.')
//         switch (feature) {
//             case 'Amenity':
//                 initAmenityForm()
//                 break;
//             case 'Unit':
//                 initUnitForm()
//                 break;
//         }
//     }

//     async function changeContent(theForm) {
//         const formArea = document.getElementById('formArea')
//         fetch(`/getform/${theForm}`)
//             .then(response => {
//                 // console.log('hehe',response)
//                 return response.json()
//                 // return response.text()
//             })
//             .then(data => {
//                 // console.log(data)
//                 formArea.innerHTML = data.html
//                 initForm(theForm)
//             }).catch(e => {
//                 console.log(e)
//             })

//     }
// })

