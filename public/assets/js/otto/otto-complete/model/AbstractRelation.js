/**
 * AbstractRelation
 * 
 * This class defines the basic structure and functionality of the other three classes.
 * It has a constructor that takes in a container element and a UI object.
 * It also defines a handle method that takes in a URL and a list type, fetches data from the server,
 * and calls the suggest method of the UI object with the fetched results.
 * 
 */
class AbstractRelation 
{
    constructor(container, ui) {
        this.container = container
        this.ui = ui
        this.results = []
        this.listen()
    }

    listen() {
        let timeoutId;
        this.ui.container.querySelectorAll(".otto-search").forEach((search) => {
            search.addEventListener("input", function(e) {this.onSearch(e,  timeoutId)}.bind(this));
            search.addEventListener('keydown', function (event) {
              // For modern browsers, check using event.key
              if (event.key === 'Enter') {
                event.preventDefault();
              }
            });
        })
    }

    onSearch(e, listName=null) {
        const len = e.target.value.length;

        if(len == 0){
            console.log('empty search, remove all')
            this.ui.resetAndHideSuggestions()
        }

        // if(!this.validSearch(e)) // ticket 64
        //     return

        let endpoint = e.target.getAttribute('otto-endpoint')
        
        let url = endpoint + encodeURI(e.target.value)

        this.handle(url, listName)
    }

    validSearch(e){
        return e.target.value.length >= 3
    }

    handle(url, listName=null){
        console.log(url, listName)
        fetch(url)
        .then((response) => response.json())
        .then((results) => {
            console.log(results)
            this.results = results
            this.ui.suggest(results, listName);
        })
    }



    
}

export default AbstractRelation;