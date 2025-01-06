class OttoCache {

    constructor(key) {
        this.key = key
        this.data = new Map()
    }

    load() {
        const cacheJson = localStorage.getItem(this.key)
        if (cacheJson !== null) {
            try {
                this.data = new Map(JSON.parse(cacheJson))
            } catch (e) {
                console.error('Failed to parse cache JSON:', e)
            }
        }
    }

    save() {
        localStorage.setItem(this.key, JSON.stringify(Array.from(this.data.entries())))
    }

    has(id) {
        return this.data.has(id)
    }

    get(id) {
        return this.data.get(id)
    }

    set(id, label) {
        this.data.set(id, label)
    }



}

export default OttoCache