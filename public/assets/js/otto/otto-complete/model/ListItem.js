/**
 * ListItem
 * 
 * This class defines a list item element and its associated controls.
 * It has a constructor that takes in a result object and an input name.
 * It also defines a render method that returns the list item element.
 * 
 */
class ListItem {

    constructor(label, id=null, inputName=null) {
        this.id = id;
        this.label = label;
        this.inputName = inputName;
    }
    static dom(li) {
        let span = li.querySelector("span");
        let input = li.querySelector("input");
        let id = input.value;
        let label = span.innerText;
        
        return new ListItem(label, id, input.getAttribute("name"));
    }

    dom() {
        let li = document.createElement("li")
        let span = document.createElement("span")
        let link = document.createElement("a")
        
        li.setAttribute("class", "list-group-item d-flex justify-content-between align-items-center pe-1 ps-0 py-3")
        
        span.innerText = this.label
        
        li.appendChild(span)
        if(this.id !== null){
            li.appendChild(this.hiddenInput())
            li.appendChild(this.closeControl())
        }
        
        return li;
    }

    closeControl() {
        let link = document.createElement("a");
        link.href = "#";
        link.className = "btn ms-auto p-0 ps-3 text-danger";
        link.innerHTML = "x";
        link.addEventListener("click", (e) => {
            e.preventDefault();
            ListItem.targetToLI(e.target).remove()
            // target.remove();
        });

        return link;
    }

    hiddenInput(inputName=null, id=null) {
        return Object.assign(document.createElement("input"), {
            type: "hidden",
            name: inputName || this.inputName || "children_ids[]",
            value: id || this.id
        })
    }

    static targetToLI(target){
        while(target.tagName !== 'LI') {
            target = target.parentElement
        }
        return target
    }


}

export default ListItem;