/**
 * OttoCompleteUI
 * 
 * This class defines the basic UI elements and functionality for all three use cases.
 * It has a constructor that takes in a container element and defines a suggestions element.
 * 
 */

import ListItem from './ListItem.js';

class OttoCompleteUI 
{
    constructor(container) {
        this.container = container
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

        this.emptyContainer(suggestions)
        this.hide(suggestions)
    }

    hide(container){
        container.classList.add('d-none')
    }
    
    emptyContainer(container){
        // removes all children of the container
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }
        // remove all text and html from the container
        container.textContent = '';
        container.innerHTML = '';
    }
}

export default OttoCompleteUI;