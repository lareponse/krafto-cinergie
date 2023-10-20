class OttoCompleteUI 
{
    constructor(container) {
        this.container = container;
        this.suggestions = this.container.querySelector(".otto-suggestions");
    }

    createListItem({id, label}, inputName=null) {
        let li = document.createElement("li");
        li.setAttribute("class", "list-group-item current-items d-flex justify-content-between align-items-center");
        li.innerHTML = label;

        if(id !== null){
            let [post, remove] = this.makeControls(id, li, inputName);
            li.appendChild(post);
            li.appendChild(remove);
        }
        return li;
    }

    suggest(results, list=null) {
        this.suggestions.innerHTML = "";

 
        if(results.length == 0){
            this.suggestions.appendChild(this.createListItem({'id': null, 'label':'Aucun résultat'}))
        }

        results.map((result) => {
            this.suggestions.appendChild(this.clickableSuggestion(result, list))
        })

        this.suggestions.classList.remove("d-none")
    }

    reset(){
        this.suggestions.innerHTML = ''
        this.container.querySelector('.otto-search').value = ''
    }

    makeControls(id, li, inputName=null){
        return [
            Object.assign(document.createElement("input"), {
                type: "hidden",
                name: inputName || "children_ids[]",
                value: id,
            })
            ,
            Object.assign(document.createElement("a"), {
                href: "#",
                class: "unlink",
                innerHTML: 'x',
                onclick: (e) => {
                    e.preventDefault();
                    
                    let target = e.target.parentNode;
                    
                    do {
                        target = target.parentNode
                    } while (target.tagName != 'LI')
                    
                    target.remove()
                },
            })
        ]
    }

}

class OttoCompleteHasAndBelongsToManyUI extends OttoCompleteUI
{
    constructor(container) {
        super(container)
        this.list = this.container.querySelector(".otto-list");
    }



    clickableSuggestion(result){
        let suggestion = this.createListItem(result)
        suggestion.addEventListener('click', (e) => {
            e.target.classList.add('text-primary')
            this.list.appendChild(e.target)
            this.reset()
        })

        return suggestion;
    }
}

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

    clickableSuggestion(result, selectedList){
        let inputName = selectedList === 'qualified'? 'qualified_id' : 'qualifier_id';

        let suggestion = this.createListItem(result, inputName)
        suggestion.addEventListener('click', (e) => {
            
            e.target.classList.add('text-primary')
            if(selectedList === 'qualified')[
                this.selectQualified(e.target)
            ]
            else {
                this.selectQualifier(e.target)
            }
        })

        return suggestion;
    }
    
    selectQualified(element){
        this.qualified.appendChild(element)
        this.qualifiedSearch.value=''
        this.qualifiedSearch.classList.add('d-none')
        this.qualifiedSuggestions.innerHTML = ''
        this.qualifiedSuggestions.classList.add('d-none')

    }

    selectQualifier(element){
        this.qualifier.appendChild(element)        
        this.qualifierSearch.value=''
        this.qualifierSearch.classList.add('d-none')

        this.qualifierSuggestions.innerHTML = ''
        this.qualifierSuggestions.classList.add('d-none')
    }

}

class OttoCompleteAbstract 
{
    
    constructor(container, existing, ui) {

        this.container = container;
        this.ui = ui;

        if(existing)
            existing.forEach((result) => {
                this.ui.list.append(this.ui.createListItem(result))
            });

        this.listen();
    }

    handle(url, list=null){
        console.log(url, list)
        fetch(url).then((response) => response.json()).then((results) => {
            this.ui.suggest(results, list);
        });
    }
}


class OttoTagList extends OttoCompleteAbstract 
{

    constructor(container, existing, ui=null) {
        if(ui === null) {
            ui = new OttoCompleteHasAndBelongsToManyUI(container)
        }
        super(container, existing, ui)
    }


    listen(){
        let timeoutId;
        this.ui.container.querySelectorAll(".otto-search").forEach((search) => {
            search.addEventListener("input", (e) => {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {


                    if(e.target.value.length < 3) 
                        return

                    const searchContextValue = e.target.parentNode.getAttribute("data-filter-parent")
                    this.handle("/api/tag/parent/" + encodeURI(searchContextValue) + "/term/" + encodeURI(e.target.value))


                }, 400);
            });
        });
    }
}

class OttoLink extends OttoCompleteAbstract
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

class OttoLinkWithQualifier extends OttoCompleteAbstract
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
        
        // this.ui.container.querySelector(".otto-link-qualifier").forEach((search) => {
        //     search.addEventListener("input", (e) => {
        //         clearTimeout(timeoutId);
        //         timeoutId = setTimeout(() => {


        //             // if(e.target.value.length < 3) 
        //             //     return

        //             const searchContextValue = e.target.parentNode.getAttribute("data-filter-parent")
        //             let url = "/api/tag/parent/" + encodeURI(searchContextValue) + "/term/" + encodeURI(e.target.value)
        //             console.log('qualifier', url)

        //             // this.handle(url)


        //         }, 0);
        //     });
        // });
    } 
}