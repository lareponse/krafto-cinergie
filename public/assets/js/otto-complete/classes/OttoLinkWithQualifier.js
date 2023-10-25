/**
 * OttoLinkWithQualifier
 * 
 * This class defines the UI elements and functionality for the OttoLinkWithQualifier use case.
 * It inherits from OttoCompleteGeneric and overrides the listen() method to add an input event listener to the search fields.
 */

import OttoCompleteHasAndBelongsToManyQualifiedUI from './OttoCompleteHasAndBelongsToManyQualifiedUI.js';
import OttoCompleteGeneric from './OttoCompleteGeneric.js';

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

export default OttoLinkWithQualifier;