class OttoFormatDate {
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

    static searchAndFormat(selector = '.otto-date'){
        document.querySelectorAll(selector).forEach(container => {
            const formatter = new OttoFormatDate(container);
            formatter.setFormat();
            formatter.formatDate();
        });
    }
}

export default OttoFormatDate;
