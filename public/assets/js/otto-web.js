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

    document.querySelectorAll('.otto-url').forEach(container => {
        const anchorElement = document.createElement('a');
        const url = container.innerHTML.trim();
        console.log(url);
        // Check if the URL is valid
        if (/^(http:\/\/|https:\/\/)[\w\.-]+\.\w+$/i.test(url)) {
            anchorElement.href = url;
            anchorElement.textContent = url;
        } else {
            anchorElement.href = 'https://' + url; // Assuming it's a valid domain, add https://
            anchorElement.textContent = url;
        }
        console.log(anchorElement)
        container.innerHTML = ''; // Clear container's innerHTML
        container.append(anchorElement);
    });

    document.querySelectorAll('.otto-email').forEach(container => {
        const email = container.innerHTML.trim();
        const emailElement = document.createElement('a');

        // Encode the email address
        const encodedEmail = encodeEmail(email);

        // Get the subject and content from the parent element's otto-subject and otto-content attributes
        const subject = container.getAttribute('otto-subject') || ''; // Default subject
        const content = container.getAttribute('otto-content') || ' Content'; // Default content

        // Replace \n with <br> for HTML line breaks in the email content
        const formattedContent = content.replace(/\n/g, '<br>');

        // Set the obfuscated mailto link with subject and content
        emailElement.href = 'javascript:void(0);';
        emailElement.addEventListener('click', function () {
            const emailSubject = encodeURIComponent(subject);
            const emailContent = encodeURIComponent(formattedContent);
            window.location.href = `mailto:${decodeEmail(encodedEmail)}?subject=${emailSubject}&body=${emailContent}`;
        });

        emailElement.textContent = decodeEmail(encodedEmail);
        container.innerHTML = '';
        container.append(emailElement);
    });

    // Function to encode the email address
    function encodeEmail(email) {
        const encodedEmail = [];
        for (let i = 0; i < email.length; i++) {
            encodedEmail.push(String.fromCharCode(email.charCodeAt(i) + 1));
        }
        return encodedEmail.join('');
    }

    // Function to decode the email address
    function decodeEmail(encodedEmail) {
        const decodedEmail = [];
        for (let i = 0; i < encodedEmail.length; i++) {
            decodedEmail.push(String.fromCharCode(encodedEmail.charCodeAt(i) - 1));
        }
        return decodedEmail.join('');
    }

    document.querySelectorAll('.otto-phone').forEach(container => {
        const phoneNumber = container.innerHTML.trim();
        const phoneNumberElement = document.createElement('a');

        // Encode the phone number
        const encodedPhoneNumber = encodePhoneNumber(phoneNumber);

        // Set the obfuscated tel link
        phoneNumberElement.href = 'javascript:void(0);';
        phoneNumberElement.addEventListener('click', function () {
            window.location.href = 'tel:' + decodePhoneNumber(encodedPhoneNumber);
        });

        phoneNumberElement.textContent = decodePhoneNumber(encodedPhoneNumber);
        container.innerHTML = '';
        container.append(phoneNumberElement);
    });

    // Function to encode the phone number
    function encodePhoneNumber(phoneNumber) {
        const encodedPhoneNumber = [];
        for (let i = 0; i < phoneNumber.length; i++) {
            encodedPhoneNumber.push(String.fromCharCode(phoneNumber.charCodeAt(i) + 1));
        }
        return encodedPhoneNumber.join('');
    }

    // Function to decode the phone number
    function decodePhoneNumber(encodedPhoneNumber) {
        const decodedPhoneNumber = [];
        for (let i = 0; i < encodedPhoneNumber.length; i++) {
            decodedPhoneNumber.push(String.fromCharCode(encodedPhoneNumber.charCodeAt(i) - 1));
        }
        return decodedPhoneNumber.join('');
    }

})
