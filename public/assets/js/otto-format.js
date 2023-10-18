document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.otto-date').forEach(container => {

        let dateText = container.innerText.trim();
        if (dateText.length == 0) {
            return;
        }

        let date = new Date(dateText);
        if (isNaN(date)) {
            return; // skip this one
        }

        let format = { dateStyle: "long" } // default

        try {
            if (container.getAttribute('otto-format')) {
                let try_format = decodeURIComponent(container.getAttribute('otto-format'))
                try_format = JSON.parse(try_format);
                format = try_format;
            }
            
            container.innerText = new Intl.DateTimeFormat('fr-FR', format).format(date)
        }
        catch (exception) {
            console.log(exception);
            return; // exit the program
        }
    })
})
