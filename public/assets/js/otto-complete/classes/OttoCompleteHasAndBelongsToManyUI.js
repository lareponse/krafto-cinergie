/**
 * OttoCompleteHasAndBelongsToManyUI
 * 
 * This class defines the UI elements and functionality for the OttoLink use case.
 * It inherits from OttoCompleteUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */

import OttoCompleteUI from './OttoCompleteUI.js';

class OttoCompleteHasAndBelongsToManyUI extends OttoCompleteUI
{
    constructor(container) {
        super(container)
        this.list = this.container.querySelector(".otto-list");
    }

    clickableSuggestion(result){
        let suggestion = this.createListItem(result)
        suggestion.addEventListener('click', (e) => {
            this.suggestionClicked(e)
        })

        return suggestion;
    }

    suggestionClicked(e) {
        e.target.classList.add('text-primary')
        e.target.classList.remove('list-group-item')
        this.list.appendChild(e.target)
        this.resetAndHideSuggestions(this.suggestions, this.search)
        this.submit.classList.remove('d-none')
    }
}

export default OttoCompleteHasAndBelongsToManyUI;