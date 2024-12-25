// sub functions for handling details in a form ----------------------------------
export function prepareData(listOfLis) {
    let arr = []
    Array.from(listOfLis).forEach(liTag => {
        const liText = liTag.textContent || liTag.innerText
        arr.push(liText)
    })
    return arr
}

export function hide(element) {
    if (element.classList.contains('hidden')) return
    element.classList.add('hidden')
}

export function show(element) {
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden')
    }
}


//functions to init an element with selector and search--------------------------------------
export function initComboSearch(optionPaneId, selectInputId, optionForSearchPaneId) {
    const selectInput = document.getElementById(selectInputId)
    const optionList = document.querySelectorAll(`#${optionPaneId} li`)
    const optionForSearch = document.getElementById(optionForSearchPaneId)

    if (selectInput && optionForSearch) {
        document.addEventListener('click', function (event) {
            if (!selectInput.contains(event.target) && !optionForSearch.contains(event.target)) {
                optionForSearch.classList.add('hidden');
            }
        });

        selectInput.addEventListener('focus', function () {
            const hasInnerLi = optionForSearch.querySelector('li')
            if (hasInnerLi) {
                console.log('yes')
                // console.log(optionForSearch.innerHTML)
                show(optionForSearch)
                return
            }

            let styleClasses = ['rounded-xl', 'border-1', 'mt-1', 'hover:bg-gray-200', 'p-3', 'cursor-pointer']
            console.log('search input is empty')
            const inputValue = selectInput.value.toLowerCase()
            catArray.forEach(cat => {
                if (cat.toLowerCase().indexOf(inputValue) > -1) {
                    console.log('found')
                    show(optionForSearch)
                    const li = document.createElement('li')
                    li.textContent = cat

                    styleClasses.forEach(sl => {
                        li.classList.add(sl)
                    })

                    li.addEventListener('click', function () {
                        selectInput.value = cat
                        optionForSearch.classList.add('hidden')
                    })
                    optionForSearch.appendChild(li)
                }
            })
        })

    }

    // prepare data for the search
    const catArray = prepareData(optionList)

    selectInput.addEventListener('input', function () {
        optionForSearch.innerHTML = ''
        const v = document.querySelector('p')
        if (v) v.remove()
        if (selectInput.value == '') {
            hide(optionForSearch)
        }
        let found = false
        let styleClasses = ['rounded-xl', 'border-1', 'mt-1', 'hover:bg-gray-200', 'p-3', 'cursor-pointer']

        const inputValue = selectInput.value.toLowerCase()
        catArray.forEach(cat => {
            if (cat.toLowerCase().indexOf(inputValue) > -1) {
                console.log('found')
                found = true
                show(optionForSearch)
                const li = document.createElement('li')
                li.textContent = cat
                styleClasses.forEach(sl => {
                    li.classList.add(sl)
                })
                li.addEventListener('click', function () {
                    selectInput.value = cat
                    optionForSearch.classList.add('hidden')
                })
                optionForSearch.appendChild(li)
            }
        })
        if (!found) optionForSearch.innerHTML += "<p class='text-sm text-gray-500'>Không tìm thấy!</p>"

    })
}

//functions to init each form after it is chosen--------------------------------------------
function initAmenityForm() {
    console.log('AMENITY FORM LOADED')
    initComboSearch('options', 'selectInput', 'optionsForSearch')
    initComboSearch('accessOptionPane', 'accessInput', 'accessOptionsForSearch')
}

function initUnitForm() {
    console.log('UNIT FORM LOADED')
    initComboSearch('unitOptionPane', 'unitCatInput', 'unitOptionsForSearch')
    initComboSearch('accessOptionPane', 'accessInput', 'accessOptionsForSearch')
}

function initAddressForm(){
    console.log('ADDRESS FORM LOADED')
}


//functions to run the form's script after chosing a form-------------------------------------
export function initForm(featureType) {
    switch (featureType) {
        case 'Address':
            initAddressForm()
            break
        case 'Amenity':
            initAmenityForm()
            break
        case 'Unit':
            initUnitForm()
            break
    }
}

