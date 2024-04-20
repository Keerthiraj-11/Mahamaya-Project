document.addEventListener('DOMContentLoaded', () => {
    console.log(1);

    const form = document.querySelector('form'); // Select the form element
    const name = document.querySelector('input[name="name"]');
    const location = document.querySelector('input[name="location"]');
    const phone = document.querySelector('input[name="phone"]');
    const email = document.querySelector('input[name="email"]');
    const cluster = document.querySelector('select[name="cluster"]');
    const saveButton = document.querySelectorAll('button[name="save_school"]'); // Select all buttons with names starting with "save_"
    
    // Set default value for phone input
    phone.value = '+91 '; // Set the initial value to '+91 '

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
    
        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success')
    };
    
    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
    
        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };
    
    const isValidEmail = email => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    };

    saveButton.forEach(button => {
        button.addEventListener('click', () => { // Pass the event object to the event handler function
            // Prevent the default form submission behavior
            checkInputs();
        });
    });
    

    const checkInputs = () => {
        let hasErrors = false;
    
        const nameValue = name.value.trim();
        const locationValue = location.value.trim();
        const phoneValue = phone.value.trim();
        const emailValue = email.value.trim();
        const clusterValue = cluster.value.trim();
    
       // Regular expression to check for special characters
    const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

    // Name validation
    if (nameValue === '') {
        setError(name, 'Name cannot be empty');
        hasErrors = true;
    } else if (specialCharRegex.test(nameValue)) {
        setError(name, 'Name should not contain special characters');
        hasErrors = true;
    } else {
        setSuccess(name);
    }

    // Location validation
    if (locationValue === '') {
        setError(location, 'Location cannot be empty');
        hasErrors = true;
    } else if (specialCharRegex.test(locationValue)) {
        setError(location, 'Location should not contain special characters');
        hasErrors = true;
    } else {
        setSuccess(location);
    }
    
       // Phone validation
       if (phoneValue === '') {
            setError(phone, 'Phone number cannot be empty');
            hasErrors = true;
        } else if (!isValidPhoneNumber(phoneValue)) { // Check if phone number is valid
            setError(phone, 'Provide a valid phone number (e.g., +91 1234567890)');
            hasErrors = true;
        } else {
            setSuccess(phone);
        }
    
        // Email validation
        if (emailValue === '') {
            setError(email, 'Email cannot be empty');
            hasErrors = true;
        } else if (!isValidEmail(emailValue)) {
            setError(email, 'Provide a valid email address');
            hasErrors = true;
        } else {
            setSuccess(email);
        }
    
        // Cluster validation
        if (clusterValue === '') {
            setError(cluster, 'Please select a cluster');
            hasErrors = true;
        } else {
            setSuccess(cluster);
        }
    
        // Prevent form submission if there are errors
        if (hasErrors) {
            // If there are errors, prevent the form submission
            event.preventDefault();
        }
    };
    

    const isValidPhoneNumber = phoneNumber => {
        // Regular expression pattern
        const regex = /^\+91 \d{10}$/;
        // Test the input against the pattern
        return regex.test(phoneNumber);
    };

    
});


