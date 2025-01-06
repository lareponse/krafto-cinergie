/**
 * OneToMany
 * 
 * This class defines the UI elements and functionality for the OneToMany use case.
 * It inherits from AbstractRelation and overrides the listen() method to add an input event listener to the search field.
 * 
 */

import AbstractRelation from './model/AbstractRelation.js';
import OneToManyUI from './view/OneToManyUI.js';

class OneToMany extends AbstractRelation
{
    constructor(container, ui=null) {
        if(ui === null) {
            ui = new OneToManyUI(container)
        }
        super(container, ui)
    }

}

export default OneToMany;