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
    constructor(container, ui=null) {
        if(ui === null) {
            ui = new OttoCompleteHasAndBelongsToManyUI(container)
        }
        super(container, ui)
    }

}

export default OttoLink;