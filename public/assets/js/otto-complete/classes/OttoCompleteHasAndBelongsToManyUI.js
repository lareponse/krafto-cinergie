/**
 * OttoCompleteHasAndBelongsToManyUI
 * 
 * This class defines the UI elements and functionality for the OttoLink use case.
 * It inherits from OttoCompleteUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */

import OttoCompleteUI from './OttoCompleteUI.js';
import ListItem from './ListItem.js';

class OttoCompleteHasAndBelongsToManyUI extends OttoCompleteUI
{
    constructor(container) {
        super(container)
        this.list = this.container.querySelector(".otto-list");
    }

    clickableSuggestion({label, id=null}){
        let suggestion = new ListItem(label, id)
        suggestion = suggestion.dom()

        suggestion.addEventListener('click', (e) => {
            this.suggestionClicked(e)
        })

        return suggestion;
    }

    suggestionClicked(e) {
        let listItem = e.target;
        while(listItem.tagName !== 'LI' && listItem.tagName !== 'BODY') {
            listItem = listItem.parentElement
        }
        if(listItem.tagName !== 'LI'){
            console.error('no li', e.target, listItem)
            return            
        }

        let newItem = ListItem.dom(listItem)
        
        // unregister potential event listener before removing the list item
        listItem.removeEventListener('click', this.suggestionClicked)
        listItem.remove()

        this.list.appendChild(newItem.dom() )
        this.resetAndHideSuggestions(this.suggestions, this.search)
        this.submit.classList.remove('d-none')
    }
}

export default OttoCompleteHasAndBelongsToManyUI;