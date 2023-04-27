document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.otto-date').forEach(container => {

        let date = container.innerText.trim();
        
        if(date.length > 0){
    
            let format = {dateStyle: "long"}
    
            try{
                date = new Date(date)

                if(container.getAttribute('otto-format')){
                    let try_format = decodeURIComponent(container.getAttribute('otto-format'))
                    try_format = JSON.parse(try_format)
                    if(try_format)
                        format = try_format;
                }

                container.innerText = new Intl.DateTimeFormat('fr-FR', format).format(date)
            }
            catch(error){
                console.debug(error.message,':',date)
            }
        }
    })

    document.querySelectorAll('.otto-url').forEach(container => {
        const anchorElement = document.createElement('a')
        anchorElement.href = container.innerHTML.trim()
        anchorElement.innerHTML = anchorElement.href
        container.innerHTML = ''
        container.append(anchorElement)
    })
})
