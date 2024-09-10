document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contactform');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const genderInputs = document.querySelectorAll('input[name="gender"]');
    const courseSelect = document.getElementById('course');
    const yearSelect = document.getElementById('year');
    const interestsCheckboxes = document.querySelectorAll('input[name="interests"]');
    const messageTextarea = document.getElementById('message');

    form.addEventListener('submit', function(event) {
        let isValid = true;
        let alertMessage = '';

        // Name validation
        if (nameInput.value.trim() === '') {
            isValid = false;
            alertMessage += 'Name is required.\n';
        }

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            isValid = false;
            alertMessage += 'Please enter a valid email address.\n';
        }

        // Gender validation
        let genderSelected = false;
        genderInputs.forEach((input) => {
            if (input.checked) {
                genderSelected = true;
            }
        });
        if (!genderSelected) {
            isValid = false;
            alertMessage += 'Please select your gender.\n';
        }

        // Course validation
        if (courseSelect.value === '') {
            isValid = false;
            alertMessage += 'Please select a course.\n';
        }

        // Year validation
        if (yearSelect.value === '') {
            isValid = false;
            alertMessage += 'Please select your year.\n';
        }

        // Interests validation
        let interestsSelected = false;
        interestsCheckboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                interestsSelected = true;
            }
        });
        if (!interestsSelected) {
            isValid = false;
            alertMessage += 'Please select at least one interest.\n';
        }

        // Message validation
        if (messageTextarea.value.trim() === '') {
            isValid = false;
            alertMessage += 'Message cannot be empty.\n';
        }

        if (!isValid) {
            alert(alertMessage);
            event.preventDefault(); // Prevent form submission if not valid
        }
    });
});
