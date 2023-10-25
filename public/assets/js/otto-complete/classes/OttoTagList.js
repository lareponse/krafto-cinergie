/**
 * OttoTagList
 * 
 * This class defines the UI elements and functionality for the OttoTagList use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search field.
 * 
 */

import OttoCompleteGeneric from './OttoCompleteGeneric.js';
import OttoCompleteHasAndBelongsToManyUI from './OttoCompleteHasAndBelongsToManyUI.js';

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

export default OttoTagList;