class OttoThesaurusLabel {
    constructor() {
        this.tags = document.getElementsByClassName('otto-thesaurus-label');
        this.ids = new Set();
    }

    getIds() {
        for (let tag of this.tags) {
            let id = tag.getAttribute('otto-id');
            if (id !== null) {
                this.ids.add(id);
            }
        }
        return Array.from(this.ids);
    }

    fetchLabels() {
        let ids = JSON.stringify(this.getIds());
        let url = '/api/id-label/Thesaurus/ids/' + encodeURIComponent(ids);
        console.log(url);
        fetch(url)
            .then(r => r.json())
            .then(tags => {
                tags.forEach(tag => {
                    let elts = Array.from(document.querySelectorAll(`.otto-thesaurus-label[otto-id='${tag.id}']`));
                    elts.forEach(elt => {
                        elt.innerText = tag.label;
                    });
                });
            });
    }
}

export default OttoThesaurusLabel;