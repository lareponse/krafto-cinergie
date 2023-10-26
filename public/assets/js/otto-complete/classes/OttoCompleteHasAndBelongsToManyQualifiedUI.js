/**
 * OttoCompleteHasAndBelongsToManyQualifiedUI
 * 
 * This class defines the UI elements and functionality for the OttoLinkWithQualifier use case.
 * It inherits from OttoCompleteUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */

import OttoCompleteUI from './OttoCompleteUI.js';
import ListItem from './ListItem.js';

class OttoCompleteHasAndBelongsToManyQualifiedUI extends OttoCompleteUI
{
    constructor(container) {
        super(container)

        this.qualified = this.container.querySelector(".otto-link-qualified .otto-result");
        this.qualifiedSearch = this.container.querySelector(".otto-link-qualified .otto-search");
        this.qualifiedSuggestions = this.container.querySelector(".otto-link-qualified .otto-suggestions");

        this.qualifier = this.container.querySelector(".otto-link-qualifier .otto-result");
        this.qualifierSearch = this.container.querySelector(".otto-link-qualifier .otto-search");
        this.qualifierSuggestions = this.container.querySelector(".otto-link-qualifier .otto-suggestions");

    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

 
        if(results.length == 0){
            this.suggestions.appendChild(this.createListItem({'id': null, 'label':'Aucun résultat'}))
        }

        results.map((result) => {
            let targetList = list === 'qualified' ? this.qualifiedSuggestions : this.qualifierSuggestions
            targetList.appendChild(this.clickableSuggestion(result, list))
            targetList.classList.remove("d-none")
        })

    }

    clickableSuggestion(result, selectedList) {
        let inputName = selectedList === 'qualified' ? 'qualified_id' : 'qualifier_id';

        let suggestion = new ListItem(result.label, result.id, inputName)
        suggestion = suggestion.dom()
        suggestion.addEventListener('click', (e) => this.suggestionClicked(e, selectedList));

        return suggestion;
    }

    suggestionClicked(e, selectedList) {
        let listItem = e.target;
        while(listItem.tagName !== 'LI') {
            listItem = listItem.parentElement
        }

        listItem.classList.add('text-primary');

        if (selectedList === 'qualified') {
            this.qualified.appendChild(listItem);
            this.resetAndHideSuggestions(this.qualifiedSuggestions, this.qualifiedSearch);
            this.qualifiedSearch.classList.add('d-none');
        } else {
            this.resetAndHideSuggestions(this.qualifierSuggestions, this.qualifierSearch);
            
            
            let qualifiedItem = this.qualified.firstChild
            console.log(qualifiedItem)

            // add the qualifier label to the qualified label, between brackets
            let qualifierLabel = e.target.innerText;
            let qualifiedLabel = this.qualified.firstChild.innerText;
            let qualifiedLabelWithQualifier = qualifiedLabel + ' (' + qualifierLabel + ')';
            console.log(qualifiedLabel, qualifierLabel, qualifiedLabelWithQualifier)
            this.list.appendChild(this.qualified.querySelector('li'))
            this.list.classList.remove('d-none')
            console.log(this.qualified);
            // this.qualifier.appendChild(e.target);
        }
    }

}

export default OttoCompleteHasAndBelongsToManyQualifiedUI;