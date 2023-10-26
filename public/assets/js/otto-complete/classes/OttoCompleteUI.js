/**
 * OttoCompleteUI
 * 
 * This class defines the basic UI elements and functionality for all three use cases.
 * It has a constructor that takes in a container element and defines a suggestions element.
 * It also defines a createListItem method that takes in a result object and an input name and returns a list item element.
 * 
 */

import ListItem from './ListItem.js';

class OttoCompleteUI 
{
    constructor(container) {
        this.container = container;
        this.list = this.container.querySelector('.otto-list');
        this.suggestions = this.container.querySelector(".otto-suggestions");
        this.search = this.container.querySelector('.otto-search');
        this.submit = this.container.querySelector('.otto-link-submit');
    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

        if(results.length == 0){
            let notFound = new ListItem('Aucun résultat')   
            this.suggestions.appendChild(notFound.dom())
        }

        results.map((result) => {
            this.suggestions.appendChild(this.clickableSuggestion(result, list))
        })

        this.suggestions.classList.remove("d-none")
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