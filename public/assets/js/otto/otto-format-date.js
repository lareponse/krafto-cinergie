class OttoFormatDate {

    static getFormat(container){
        if (container.getAttribute('otto-format')) {
            try {
                let format = decodeURIComponent(container.getAttribute('otto-format'))
                format = JSON.parse(format)
                return format
            } catch (exception) {
                console.log(exception, this.container)
            }
        }
        return { dateStyle: "long" }
    }

    static searchAndFormat(selector = '.otto-date'){
        let dateText, date, dateFormat

        document.querySelectorAll(selector).forEach(container => {
            dateText = container.innerText.trim();

            date = new Date(dateText);
            
            if (isNaN(date)) {
                console.error('Invalid dateText', container.innerText)
            }
            else{
                dateFormat = new Intl.DateTimeFormat('fr-FR', OttoFormatDate.getFormat(container))
                container.innerText = dateFormat.format(date);
            }
        });
    }
}

export default OttoFormatDate;
