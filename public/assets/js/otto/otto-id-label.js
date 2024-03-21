import OttoCache from './otto-cache.js';

class OttoIdLabel {
    
    constructor(selector='.otto-id-label') {
        this.selector = selector;
        this.cache = null;
    }

    localStorageKey() {
        const encodedSelector = encodeURIComponent(this.selector);
        return `otto:id-label:${encodedSelector}`;
    }
        
    tags(selector=null){
        return document.querySelectorAll(selector || this.selector)
    }

    async replace(selector=null, fetchMissing=true) {
        let tags = this.tags(selector)

        if (this.cache === null){
            this.cache = new OttoCache(this.localStorageKey())
            this.cache.load()
        }

        let cacheMiss = {};
        for (const tag of tags) {
            const urn = tag.getAttribute('otto-urn');
            if (this.cache.has(urn) === true) {
                // console.log('replacing urn', urn, 'with', this.cache.get(urn))
                tag.innerText = this.cache.get(urn);
                tag.setAttribute('otto-urn', null)
            }
            else {
                // console.log(urn, tag)
                // console.log('missing urn', urn)
                let [entity, id] = urn.split(':')
                cacheMiss[entity] = cacheMiss[entity] || new Set();
                cacheMiss[entity].add(id);
            }
        }

        // console.log('cache miss', cacheMiss)


        if(fetchMissing === true && Object.entries(cacheMiss).length > 0){
            await this.refresh(cacheMiss)
            this.replace(this.selector + '[otto-urn]:not([otto-urn=""])', false)
        }
    }

    url(entity, ids){
        return `/api/id-label/${encodeURIComponent(entity)}/ids/${encodeURIComponent(JSON.stringify(ids))}`
    }
    
    
    async refresh(cacheMiss) {
        for (const entity in cacheMiss) {
            const url = this.url(entity, Array.from(cacheMiss[entity]))
            // console.log('refresh url', url)
            const response = await fetch(url)
            const data = await response.json()
            // console.log('refresh data', data)
            data.forEach(item => {
                let urn = entity + ':' + item.id
                this.cache.set(urn, item.label)
            })
        }

        this.cache.save()
    }
}

export default OttoIdLabel;