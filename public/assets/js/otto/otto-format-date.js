class OttoFormatDate {

    static getFormat(container){
        if (container.getAttribute('otto-format')) {
            try {
                const format = decodeURIComponent(container.getAttribute('otto-format'))
                let parsedFormat = JSON.parse(format)
                return parsedFormat
            } catch (exception) {
                console.error('Error parsing JSON:', exception)
                console.log('Container:', container)
                console.log('parsedFormat:', parsedFormat)
            }
            
        }
        return { dateStyle: "long" }
    }

    static searchAndFormat(selector = '.otto-date'){
        let dateText, date, dateFormat

        document.querySelectorAll(selector).forEach(container => {
            dateText = container.innerText.trim();

            date = new Date(dateText)
            
            if (isNaN(date)) {
                console.error('Invalid dateText', container.innerText)
            }
            else{
                dateFormat = new Intl.DateTimeFormat('fr-FR', OttoFormatDate.getFormat(container))
                container.innerText = dateFormat.format(date)
            }
        });
    }
}

export default OttoFormatDate;
