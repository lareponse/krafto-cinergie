/**
 * OneToManyUI
 * 
 * This class defines the UI elements and functionality for the OneToMany use case.
 * It inherits from AbstractUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */

import AbstractUI from './AbstractUI.js';
import ListItem from '../model/ListItem.js';

class OneToManyUI extends AbstractUI
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

export default OneToManyUI;