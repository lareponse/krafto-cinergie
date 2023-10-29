class OttoWeb {
    static urlLinks(selector = null) {
        document.querySelectorAll(selector || '.otto-url').forEach(container => {
            const anchorElement = document.createElement('a');
            const url = container.innerHTML.trim();

            if (/^(http:\/\/|https:\/\/)[\w\.-]+\.\w+$/i.test(url)) {
                anchorElement.href = url;
                anchorElement.textContent = url;
            } else {
                anchorElement.href = 'https://' + url;
                anchorElement.textContent = url;
            }

            container.innerHTML = '';
            container.append(anchorElement);
        });
    }

    static emailLinks(selector = null) {
        document.querySelectorAll(selector || '.otto-email').forEach(container => {
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

    static callLinks(selector = null) {
        document.querySelectorAll(selector || '.otto-phone').forEach(container => {
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

export default OttoWeb;