/**
 * OttoLink
 * 
 * This class defines the UI elements and functionality for the OttoLink use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search field.
 * 
 */

import OttoCompleteGeneric from './OttoCompleteGeneric.js';
import OttoCompleteHasAndBelongsToManyUI from './OttoCompleteHasAndBelongsToManyUI.js';

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

export default OttoLink;