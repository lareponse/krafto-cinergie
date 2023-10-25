/**
 * OttoCompleteUI
 * 
 * This class defines the basic UI elements and functionality for all three use cases.
 * It has a constructor that takes in a container element and defines a suggestions element.
 * It also defines a createListItem method that takes in a result object and an input name and returns a list item element.
 * 
 */
class OttoCompleteUI 
{
    constructor(container) {
        this.container = container;
        this.list = this.container.querySelector('.otto-list');
        this.suggestions = this.container.querySelector(".otto-suggestions");
        this.search = this.container.querySelector('.otto-search');
        this.submit = this.container.querySelector('.otto-link-submit');
    }

    createListItem({id, label}, inputName=null) {
        let li = document.createElement("li")
        li.setAttribute("class", "list-group-item d-flex justify-content-between align-items-center px-0 py-4")

        let span = document.createElement("span")
        span.innerText = label
        
        li.appendChild(span)

        if(id !== null){
            let [input, remove] = this.makeControls(id, li, inputName);
            li.appendChild(input);
            li.appendChild(remove);
        }
        return li;
    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

        let li;
        if(results.length == 0){
            this.suggestions.appendChild(this.createListItem({'id': null, 'label':'Aucun résultat'}))
        }

        results.map((result) => {
            this.suggestions.appendChild(this.clickableSuggestion(result, list))
        })

        this.suggestions.classList.remove("d-none")
    }

    makeControls(id, li, inputName=null){
        return [
            Object.assign(document.createElement("input"), {
                type: "hidden",
                name: inputName || "children_ids[]",
                value: id,
            })
            ,
            Object.assign(document.createElement("a"), {
                href: "#",
                class: "unlink",
                innerHTML: 'x',
                onclick: (e) => {
                    e.preventDefault();
                    let target = e.target.parentNode;
                    target.remove()
                },
            })
        ]
    }

    resetAndHideSuggestions(suggestions, search){
        search.value=''

        while (suggestions.firstChild) {
            suggestions.removeChild(suggestions.firstChild);
        }
        // search.classList.add('d-none')
        suggestions.classList.add('d-none')
    }
}

export default OttoCompleteUI;