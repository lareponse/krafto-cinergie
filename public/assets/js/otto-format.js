document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.otto-date').forEach(container => {

        let dateText = container.innerText.trim();
        if (dateText.length > 0) {
            
            let format = { dateStyle: "long" } // default
            
            try {
                date = new Date(dateText)
                if (container.getAttribute('otto-format')) {
                    let try_format = decodeURIComponent(container.getAttribute('otto-format'))
                    
                    try_format = JSON.parse(try_format);
                    format = try_format;
                }
                container.innerText = new Intl.DateTimeFormat('fr-FR', format).format(date)
            }
            catch (exception) {
                console.error(dateText, exception, date);
            }
        }
    })
})
