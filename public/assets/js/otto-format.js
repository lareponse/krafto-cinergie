document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.otto-date').forEach(container => {

        let date = container.innerText.trim();
        if (date.length > 0) {
            let format = { dateStyle: "long" } // default
            try {
                date = new Date(date)

                if (container.getAttribute('otto-format')) {
                    let try_format = decodeURIComponent(container.getAttribute('otto-format'))
                    try_format = JSON.parse(try_format);
                    format = try_format;
                    console.error("Error parsing JSON:", error);
                }

                container.innerText = new Intl.DateTimeFormat('fr-FR', format).format(date)
            }
            catch (error) {
                console.error(error.message, ':', date)
            }
        }
    })
})
