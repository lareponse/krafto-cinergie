class OttoLink {
    static urls(selector) {
        const rx = /^(http:\/\/|https:\/\/)[\w\.-]+\.\w+$/i;

        document.querySelectorAll(selector).forEach(container => {
            const url = container.innerHTML.trim();
            const anchorElement = document.createElement('a');

            anchorElement.textContent = url;
            anchorElement.href = rx.test(url) ? url : 'https://' + url;

            container.innerHTML = '';
            container.append(anchorElement);
        });
    }

    static emails(selector) {
        document.querySelectorAll(selector).forEach(container => {
            const email = container.innerHTML.trim()
            const emailElement = document.createElement('a')

            emailElement.textContent = email
            emailElement.href = 'javascript:void(0);'
            emailElement.addEventListener('click', function () {
                let emailSubject = encodeURIComponent(container.getAttribute('otto-subject') || '')

                let emailContent = container.getAttribute('otto-content') || ' Content'
                emailContent = encodeURIComponent(emailContent.replace(/\n/g, '<br>'))

                window.location.href = `mailto:${email}?subject=${emailSubject}&body=${emailContent}`
            });

            container.innerHTML = ''
            container.append(emailElement)
        });
    }

    static calls(selector) {
        document.querySelectorAll(selector).forEach(container => {
            const phoneNumber = container.innerHTML.trim();
            const phoneNormalized = phoneNumber.replace(/\s/g, '');

            const callLink = document.createElement('a');

            callLink.href = 'javascript:void(0);';
            callLink.addEventListener('click', function () {
                window.location.href = 'tel:' + phoneNormalized;
            });

            callLink.textContent = phoneNumber;
            container.innerHTML = '';
            container.append(callLink);
        });
    }
}

export default OttoLink;