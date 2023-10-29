// document.addEventListener('DOMContentLoaded', () => {
//     const labeler = new OttoTagLabel();
//     labeler.init();
// });

class OttoTagLabel {
    constructor() {
        this.cache = new Map();
        this.tags = document.querySelectorAll('[otto-tag-id]');
    }

    init() {
        if(this.tags.length === 0) {
            return;
        }

        this.loadCacheFromLocalStorage();
        const missingIds = this.getMissingIds();
        if (missingIds.length === 0) {
            this.searchAndReplace();
        } else {
            this.loadAndReplace(missingIds);
        }
    }

    loadCacheFromLocalStorage() {
        const cacheJson = localStorage.getItem('otto-tag-labels');
        if (cacheJson !== null) {
            try {
                this.cache = new Map(JSON.parse(cacheJson));
            } catch (e) {
                console.error('Failed to parse cache JSON:', e);
            }
        }
    }

    getMissingIds() {
        let missingIds = new Set();
        let id;
        for (let tag of this.tags) {
            id = tag.getAttribute('otto-tag-id');
            if(id == '')
                continue;

            if (!this.cache.has(id) && !missingIds.has(id)) {
                missingIds.add(id);
                console.log('cache miss', id);
            }
        }
        return Array.from(missingIds);
    }

    loadAndReplace(missingIds) {
        const url = `/api/tags/ids/${encodeURIComponent(JSON.stringify(missingIds))}/labels.json`;
        fetch(url)
            .then(response => response.json())
            .then(loaded => {
                loaded.forEach(tag => {
                    this.cache.set(tag.id, tag.label);
                });

                localStorage.setItem('otto-tag-labels', JSON.stringify(Array.from(this.cache.entries())));

                this.searchAndReplace();
            });
    }

    searchAndReplace() {
        for (const tag of this.tags) {
            
            const id = tag.getAttribute('otto-tag-id');
            if(id == '')
                continue;

            if (this.cache.has(id)) {
                tag.innerText = this.cache.get(id);
            } else {
                console.error('missing id in cache:', id)
                console.error(tag)
            }
        }
    }
}

export default OttoTagLabel;