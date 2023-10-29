/**
 * OttoLinkWithQualifier
 * 
 * This class defines the UI elements and functionality for the OttoLinkWithQualifier use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search fields.
 */

import OttoCompleteHasAndBelongsToManyQualifiedUI from './OttoCompleteHasAndBelongsToManyQualifiedUI.js';
import OttoCompleteGeneric from './OttoCompleteGeneric.js';

class OttoLinkWithQualifier extends OttoCompleteGeneric {
    constructor(container, ui = null) {
        super(container, ui || new OttoCompleteHasAndBelongsToManyQualifiedUI(container))
    }

    listen() {

        // console.log(this.ui.qualifiedSearch, this.ui.qualifierSearch)
        this.ui.qualifiedSearch.addEventListener("input", function (e) {
            this.onSearch(e, 'qualified')
        }.bind(this));

        this.ui.qualifierSearch.addEventListener("input", function (e) {
            this.onSearch(e, 'qualifier')
        }.bind(this));
    }

}

export default OttoLinkWithQualifier