// function to make reCAPTCHA active on form submission
grecaptcha.ready(function () {
    grecaptcha.execute('6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF', { action: 'submit' }).then(function (token) {
        document.getElementById('g-recaptcha-response').value = token;
    });
});