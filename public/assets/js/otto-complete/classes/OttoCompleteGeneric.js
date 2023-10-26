/**
 * OttoCompleteGeneric
 * 
 * This class defines the basic structure and functionality of the other three classes.
 * It has a constructor that takes in a container element and a UI object.
 * It also defines a handle method that takes in a URL and a list type, fetches data from the server,
 * and calls the suggest method of the UI object with the fetched results.
 * 
 */
class OttoCompleteGeneric 
{
    constructor(container, ui) {
        this.container = container;
        this.ui = ui;
        this.listen();
    }

    handle(url, list=null){
        console.log(url, list)
        fetch(url).then((response) => response.json()).then((results) => {
            this.ui.suggest(results, list);
        });
    }
}

export default OttoCompleteGeneric;