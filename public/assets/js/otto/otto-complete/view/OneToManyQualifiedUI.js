/**
 * OneToManyUI
 * 
 * This class defines the UI elements and functionality for the OneToManyQualified use case.
 * It inherits from AbstractUI and overrides the clickableSuggestion method to add a click event listener to the list item element.
 * 
 */

import AbstractUI from './AbstractUI.js';
import ListItem from '../model/ListItem.js';

class OneToManyQualifiedUI extends AbstractUI
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

    listen(){
        let timeoutId;
        this.qualifiedSearch.addEventListener("input", function(e) {this.onSearch(e, timeoutId,  'qualified')}.bind(this));
        this.qualifierSearch.addEventListener("input", function(e) {this.onSearch(e, timeoutId,  'qualifier')}.bind(this));
    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

 
        if(results.length == 0){
            let elt = new ListItem('Aucun résultat')
            this.suggestions.appendChild(elt.dom())
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

        let clickedElement = ListItem.targetToLI(e.target);
        
        if (selectedList === 'qualified') {
            let qualifiedListItem = ListItem.dom(clickedElement)
            this.qualified.appendChild(qualifiedListItem.dom());
            this.resetAndHideSuggestions(this.qualifiedSuggestions, this.qualifiedSearch);
            this.qualifiedSearch.classList.add('d-none');
        } 
        else {
            
            this.resetAndHideSuggestions(this.qualifierSuggestions, this.qualifierSearch);
            if(this.qualified.children.length !== 1){
                console.log('nothing to qualify, please select a qualified first')
                return;
            }

            newElement = this.qualifiedListItem(clickedElement)

            this.list.appendChild(newElement)
            this.list.classList.remove('d-none')
            this.emptyContainer(this.qualified)
            this.qualifiedSearch.classList.remove('d-none')

        }
    }

    qualifiedListItem(clickedElement)
    {
        let ret

        let qualified_label = this.qualified.querySelector('span').innerText
        let qualifier_label = clickedElement.querySelector('span').innerText
        
        let newItem = new ListItem(qualified_label + ' [' + qualifier_label + ']')

        let qualified_id = this.qualified.querySelector('input').value
        let qualifier_id = clickedElement.querySelector('input').value;

        // select the hidden input with the name qualified_id
        ret = newItem.dom()

        // add hidden inputs
        ret.appendChild(newItem.hiddenInput('qualifiers[' + qualified_id + ']', qualifier_id))

        // add close control
        ret.appendChild(newItem.closeControl())

        return ret
    }
}

export default OneToManyQualifiedUI;