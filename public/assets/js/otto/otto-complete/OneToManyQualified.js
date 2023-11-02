/**
 * OneToManyQualified
 * 
 * This class defines the UI elements and functionality for the OneToManyQualified use case.
 * It inherits from AbstractRelation and overrides the listen() method to add an input event listener to the search fields.
 */

import AbstractRelation from './model/AbstractRelation.js';
import OneToManyQualifiedUI from './view/OneToManyQualifiedUI.js';

class OneToManyQualified extends AbstractRelation {
    constructor(container, ui = null) {
        super(container, ui || new OneToManyQualifiedUI(container))
    }

    listen() {
        console.log(this.ui)
        this.ui.qualifiedSearch.addEventListener("input", function (e) {
            this.onSearch(e, 'qualified')
        }.bind(this));

        this.ui.qualifierSearch.addEventListener("input", function (e) {
            this.onSearch(e, 'qualifier')
        }.bind(this));
    }

}

export default OneToManyQualified