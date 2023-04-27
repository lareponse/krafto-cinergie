document.addEventListener("DOMContentLoaded", function () {

    let tags = document.getElementsByClassName('otto-tag-label');

    let ids = new Set()
    for (let tag of tags) {
        let id = tag.getAttribute('otto-id')
        if (id !== null) {
            ids.add(id)
        }
    }

    // `ids` now contains a unique collection of `otto-id` attribute values
    // console.log(ids)

    ids = Array.from(ids)
    ids = JSON.stringify(ids)
    fetch('/api/tags/ids/' + encodeURIComponent(ids) + '/labels.json')
        .then(r => r.json())
        .then(tags => {
            tags.forEach(tag => {
                let elts = Array.from(document.querySelectorAll(`.otto-tag-label[otto-id='${tag.id}']`));
                elts.forEach(elt => {
                    elt.innerText = tag.label;
                });
            });
        });
})
