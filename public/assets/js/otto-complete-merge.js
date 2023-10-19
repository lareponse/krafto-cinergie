class OttoCompleteAbstract {
    
    constructor(container, existing) {
        this.container = container;
        this.existing = existing;
        this.makeList();
        this.listen();
    }

    showSuggestions(results) {
        const suggestionList = this.container.querySelector(".otto-suggestions");
        suggestionList.innerHTML = "";

        if(results.length == 0){
            let item = document.createElement('li')
            item.className = 'list-group-item d-flex justify-content-between align-items-center'
            item.innerHTML = 'No results found'

            suggestionList.appendChild(item);
        }
        else{
            results.map((res) => {
                suggestionList.append(this.makeSuggestion(res));
            });
        }
        suggestionList.classList.remove("d-none");
    }

    makeSuggestion({ id, label }) {
        let item = document.createElement('li')
        
        item.className = 'list-group-item d-flex justify-content-between align-items-center'
        item.innerHTML = label

        item.addEventListener('click', (e) => {
            let container = e.target.parentNode.parentNode;
            let selectedList = container.querySelector('.otto-list')
            let listItem = this.makeListItem(id, label, selectedList.getAttribute('otto-ids'))

            selectedList.appendChild(listItem)
            selectedList.classList.add('mt-3')
            container.querySelector('.otto-suggestions').innerHTML = ''
            container.querySelector('.otto-search').value = ''
        })

        return item
    }

    removeFromExisting(target) {
        do {
            target = target.parentNode
        } while (target.tagName != 'LI')
        target.remove()
    }

    makeList() {
        let list = this.container.querySelector(".otto-list");
        this.existing.forEach((item) => {
            console.log(item);
            list.append(this.makeListItem(item.id, item.label, ""));
        });
    }

    makeListItem(id, label, className) {
        // Create the text node for the label
        label = document.createTextNode(label);

        // Create the <input> element
        const input = Object.assign(document.createElement("input"), {
            type: "hidden",
            name: "children_ids[]",
            value: id,
        });

        // Create the <a> element
        const a = Object.assign(document.createElement("a"), {
            href: "#",
            class: "unlink",
            innerHTML: deleteIcon,
            onclick: (e) => {
                e.preventDefault();
                this.removeFromExisting(e.target);
            },
        });

        // Create the <li> element
        const li = document.createElement("li");
        li.setAttribute(
            "class",
            "list-group-item current-items d-flex justify-content-between align-items-center " +
                className
        );
        li.appendChild(label);
        li.appendChild(input);
        li.appendChild(a);

        return li;
    }

    handle(url){
        console.log(url)
        fetch(url).then((response) => response.json()).then((results) => {
            this.showSuggestions(results);
        });
    }
}


class OttoTagList extends OttoCompleteAbstract {

    listen(){
        this.container.querySelectorAll(".otto-search").forEach((search) => {
            search.addEventListener("input", (e) => {
                if(e.target.value.length < 3) 
                    return

                const searchContextValue = e.target.parentNode.getAttribute("data-filter-parent")
                this.handle("/api/tag/parent/" + encodeURI(searchContextValue) + "/term/" + e.target.value)
            });
        });
    }
}


class OttoLink extends OttoCompleteAbstract{
    listen() {
        this.container.querySelectorAll(".otto-search").forEach((search) => {
            search.addEventListener('input', (e) => {
                if(e.target.value.length < 3) 
                    return

                const searchContextValue = e.target.getAttribute('otto-entity')

                
                this.handle('/api/id-label/' + encodeURI(searchContextValue) + '/term/' + e.target.value)

            })
        })
    }
}


