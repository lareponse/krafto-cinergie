document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.otto-link input.otto-search').forEach(function (search) {
        // console.log(search)
        search.addEventListener('input', (e) => {
            const searchTerm = e.target.value
            const className = e.target.getAttribute('otto-entity')
            console.log(className)
            
            const url = '/api/id-label/' + encodeURI(className) + '/term/' + searchTerm

            console.log(url)

            fetch(url)
                .then(response => response.json())
                .then(results => {
                    // make suggestion list
                    let suggestionList = e.target.parentNode.querySelector('.otto-suggestions');
                    suggestionList.innerHTML = ''
                    results.map(suggestion => {
                        suggestionList.append(makeSuggestion(suggestion))
                    })

                })
        })
    })
})

const makeSuggestion = (result) => {
    let { id, label } = result
    let item = document.createElement('li')
    item.className = 'list-group-item d-flex justify-content-between align-items-center'
    item.innerHTML = label

    item.addEventListener('click', (e) => {
        let container = e.target.parentNode.parentNode;
        let selectedList = container.querySelector('.otto-list')
        let listItem = makeListItem(id, label, selectedList.getAttribute('otto-ids'))

        selectedList.appendChild(listItem)
        selectedList.classList.add('mt-3')
        container.querySelector('.otto-suggestions').innerHTML = ''
        container.querySelector('.otto-search').value = ''
    })

    return item
}

const removeFromExisting = (target) => {
    do {
        target = target.parentNode
    } while (target.tagName != 'LI')
    target.remove()
}

// Declare the makeListItem function only once
const makeListItem = (id, label, inputName) => {
    // Create the text node for the label
    label = document.createTextNode(label)

    // Create the <input> element
    const input = Object.assign(document.createElement('input'), {
        type: 'hidden',
        name: inputName,
        value: id
    });

    // Create the <a> element
    const a = Object.assign(document.createElement('a'), {
        href: '#',
        class: 'unlink',
        innerHTML: deleteIcon,
        onclick: (e) => {
            e.preventDefault();
            removeFromExisting(e.target);
        },
    });


    // Create the <li> element
    const li = document.createElement('li')
    li.setAttribute('class', 'list-group-item current-items d-flex justify-content-between align-items-center')
    li.appendChild(label);
    li.appendChild(input);
    li.appendChild(a);

    return li
}