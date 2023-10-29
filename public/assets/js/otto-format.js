class OttoFormat {
    constructor(container) {
        this.container = container;
        this.dateText = container.innerText.trim();
        this.date = new Date(this.dateText);
        this.format = { dateStyle: "long" };
    }

    setFormat() {
        try {
            if (this.container.getAttribute('otto-format')) {
                let try_format = decodeURIComponent(this.container.getAttribute('otto-format'))
                try_format = JSON.parse(try_format);
                this.format = try_format;
            }
        } catch (exception) {
            console.log(exception);
            throw new Error('Invalid format');
        }
    }

    formatDate() {
        if (isNaN(this.date)) {
            throw new Error('Invalid date');
        }
        this.container.innerText = new Intl.DateTimeFormat('fr-FR', this.format).format(this.date);
    }

    format() {
        this.setFormat();
        this.formatDate();
    }

    static searchAndFormat(selector){
        document.querySelectorAll(selector).forEach(container => {
            const formatter = new OttoFormat(container);
            formatter.format();
        });
    }
}

export default OttoFormat;