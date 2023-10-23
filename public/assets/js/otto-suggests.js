/**
 * This file defines four controller classes: 
 *      - OttoCompleteGeneric, 
 *      - OttoTagList, 
 *      - OttoLink,
 *      - OttoLinkWithQualifier
 * 
 * and 3 UI classes:
 *      - OttoCompleteUI,
 *      - OttoCompleteHasAndBelongsToManyUI,
 *      - OttoCompleteHasAndBelongsToManyQualifiedUI
 * 
 * 
 * OttoCompleteGeneric 
 *      Is an abstract class that defines the basic structure and functionality of the other three classes. 
 *      It has a constructor that takes in a container element, an array of existing results, and a UI object. 
 *      It also defines a handle method that takes in a URL and a list type, fetches data from the server,
 *      and calls the suggest method of the UI object with the fetched results.
 * 
 * OttoTagList, OttoLink, and OttoLinkWithQualifier are concrete classes that inherit from OttoCompleteGeneric. 
 *      They each have their own UI object that defines the specific UI elements and functionality for their respective use cases:
 * 
 * OttoTagList 
 *      Used for autocompleting tags in a list. It listens for input events on search fields and fetches tag data from the server 
 *      based on the search context and search term. It then displays the fetched results in a list and allows the user to select them.
 * 
 * OttoLink
 *      Used for autocompleting links to other entities. It listens for input events on search fields and fetches entity data from the server
 *      based on the search context and search term. It then displays the fetched results in a list and allows the user to select them.
 * 
 * OttoLinkWithQualifier 
 *      Used for autocompleting links to other entities with a qualifier. 
 *      It has two search fields, one for the main search term and one for the qualifier. 
 *      It listens for input events on both search fields and fetches entity data from the server 
 *      based on the search context and search term. 
 * 
 * It then displays the fetched results in a list and allows the user to select them, 
 * with the selected result being added to the appropriate list based on the search field used.
 * 
 */


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
        this.suggestions = this.container.querySelector(".otto-suggestions");
    }

    createListItem({id, label}, inputName=null) {
        let li = document.createElement("li");
        li.setAttribute("class", "list-group-item current-items d-flex justify-content-between align-items-center");
        li.innerHTML = label;

        if(id !== null){
            let [post, remove] = this.makeControls(id, li, inputName);
            li.appendChild(post);
            li.appendChild(remove);
        }
        return li;
    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

 
        if(results.length == 0){
            this.suggestions.appendChild(this.createListItem({'id': null, 'label':'Aucun résultat'}))
        }

        results.map((result) => {
            this.suggestions.appendChild(this.clickableSuggestion(result, list))
        })

        this.suggestions.classList.remove("d-none")
    }

    reset(){
        this.suggestions.innerHTML = ''
        this.container.querySelector('.otto-search').value = ''
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
                    
                    do {
                        target = target.parentNode
                    } while (target.tagName != 'LI')
                    
                    target.remove()
                },
            })
        ]
    }

}

/**
 * OttoCompleteHasAndBelongsToManyUI
 * 
 * This class defines the UI elements and functionality for the OttoLink use case.
 * It inherits from OttoCompleteUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */
class OttoCompleteHasAndBelongsToManyUI extends OttoCompleteUI
{
    constructor(container) {
        super(container)
        this.list = this.container.querySelector(".otto-list");
    }

    clickableSuggestion(result){
        let suggestion = this.createListItem(result)
        suggestion.addEventListener('click', (e) => {
            this.suggestionClicked(e);
        })

        return suggestion;
    }

    suggestionClicked(e) {
        e.target.classList.add('text-primary')
        this.list.appendChild(e.target)
        this.reset()
    }
}

/**
 * OttoCompleteHasAndBelongsToManyQualifiedUI
 * 
 * This class defines the UI elements and functionality for the OttoLinkWithQualifier use case.
 * It inherits from OttoCompleteUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */
class OttoCompleteHasAndBelongsToManyQualifiedUI extends OttoCompleteUI
{
    constructor(container) {
        super(container)

        this.qualified = this.container.querySelector(".otto-link-qualified .otto-result");
        this.qualifiedSearch = this.container.querySelector(".otto-link-qualified .otto-search");
        this.qualifiedSuggestions = this.container.querySelector(".otto-link-qualified .otto-suggestions");

        this.qualifier = this.container.querySelector(".otto-link-qualifier .otto-result");
        this.qualifierSearch = this.container.querySelector(".otto-link-qualifier .otto-search");
        this.qualifierSuggestions = this.container.querySelector(".otto-link-qualifier .otto-suggestions");

    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

 
        if(results.length == 0){
            this.suggestions.appendChild(this.createListItem({'id': null, 'label':'Aucun résultat'}))
        }

        results.map((result) => {
            let targetList = list === 'qualified' ? this.qualifiedSuggestions : this.qualifierSuggestions
            targetList.appendChild(this.clickableSuggestion(result, list))
            targetList.classList.remove("d-none")
        })

    }

    clickableSuggestion(result, selectedList) {
        let inputName = selectedList === 'qualified' ? 'qualified_id' : 'qualifier_id';
        let suggestion = this.createListItem(result, inputName);
        suggestion.addEventListener('click', (e) => this.suggestionClicked(e, selectedList));

        return suggestion;
    }

    suggestionClicked(e, selectedList) {
        e.target.classList.add('text-primary');
        if (selectedList === 'qualified') {
            this.qualified.appendChild(e.target);
            this.resetAndHideSuggestions(this.qualifiedSuggestions, this.qualifiedSearch);
        } else {
            this.qualifier.appendChild(e.target);
            this.resetAndHideSuggestions(this.qualifierSuggestions, this.qualifierSearch);
        }
    }

    resetAndHideSuggestions(suggestions, search){
        search.value=''

        while (suggestions.firstChild) {
            suggestions.removeChild(suggestions.firstChild);
        }
        search.classList.add('d-none')
        suggestions.classList.add('d-none')
    }

}


/**
 * OttoCompleteGeneric
 * 
 * This class defines the basic structure and functionality of the other three classes.
 * It has a constructor that takes in a container element, an array of existing results, and a UI object.
 * It also defines a handle method that takes in a URL and a list type, fetches data from the server,
 * and calls the suggest method of the UI object with the fetched results.
 * 
 */
class OttoCompleteGeneric 
{
    
    constructor(container, existing, ui) {

        this.container = container;
        this.ui = ui;

        if(existing)
            existing.forEach((result) => {
                this.ui.list.append(this.ui.createListItem(result))
            });

        this.listen();
    }

    handle(url, list=null){
        console.log(url, list)
        fetch(url).then((response) => response.json()).then((results) => {
            this.ui.suggest(results, list);
        });
    }
}

/**
 * OttoTagList
 * 
 * This class defines the UI elements and functionality for the OttoTagList use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search field.
 * 
 */
class OttoTagList extends OttoCompleteGeneric 
{
    constructor(container, existing, ui=null) {
        if(ui === null) {
            ui = new OttoCompleteHasAndBelongsToManyUI(container)
        }

        super(container, existing, ui)
    }


    listen() {
        this.ui.container.querySelectorAll(".otto-search").forEach((search) => {
            search.addEventListener("input", this.handleInput.bind(this));
        });
    }

    handleInput(e) {
        clearTimeout(this.timeoutId);
        this.timeoutId = setTimeout(() => {
            if (e.target.value.length < 3) {
                return;
            }

            const searchContextValue = e.target.parentNode.getAttribute("data-filter-parent");
            this.handle("/api/tag/parent/" + encodeURI(searchContextValue) + "/term/" + encodeURI(e.target.value));
        }, 400);
    }
}

/**
 * OttoLink
 * 
 * This class defines the UI elements and functionality for the OttoLink use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search field.
 * 
 */
class OttoLink extends OttoCompleteGeneric
{

    constructor(container, existing, ui=null) {
        if(ui === null) {
            ui = new OttoCompleteHasAndBelongsToManyUI(container)
        }
        super(container, existing, ui)
    }

    listen() {
        let timeoutId;
        this.ui.container.querySelectorAll(".otto-search").forEach((search) => {
            search.addEventListener('input', (e) => {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    if(e.target.value.length < 3) 
                        return

                    const searchContextValue = e.target.getAttribute('otto-entity')

                    this.handle('/api/id-label/' + encodeURI(searchContextValue) + '/term/' + encodeURI(e.target.value))
                }, 400);
            })
        })
    }
}

/**
 * OttoLinkWithQualifier
 * 
 * This class defines the UI elements and functionality for the OttoLinkWithQualifier use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search fields.
 */

class OttoLinkWithQualifier extends OttoCompleteGeneric
{

    constructor(container, existing, ui=null) {
        if(ui === null) {
            ui = new OttoCompleteHasAndBelongsToManyQualifiedUI(container)
        }
        super(container, existing, ui)
    }

    listen(){
        let timeoutId;
        
        this.ui.qualifiedSearch.addEventListener("input", (e) => {
            clearTimeout(timeoutId)
            timeoutId = setTimeout(() => {
                if(e.target.value.length < 3) 
                    return
                const searchContextValue = e.target.getAttribute('otto-entity')
                let url = '/api/id-label/' + encodeURI(searchContextValue) + '/term/' + encodeURI(e.target.value)

                this.handle(url, 'qualified')
            }, 100)
        })

        this.ui.qualifierSearch.addEventListener("input", (e) => {
            clearTimeout(timeoutId)
            timeoutId = setTimeout(() => {
                if(e.target.value.length < 3) 
                    return

                const searchContextValue = e.target.getAttribute("data-filter-parent")
                let url = "/api/tag/parent/" + encodeURI(searchContextValue) + "/term/" + encodeURI(e.target.value)

                this.handle(url, 'qualifier')

            }, 100)
        })
       
    }
}