document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#addUserName');
    const uName = document.querySelector('#addUserName input[name="name"]');
    const uType = document.querySelector('#addUserName select[name="userType"]');
    const uPass = document.querySelector('#addUserName input[name="userPassword"]');
    const uCPass = document.querySelector('#addUserName input[name="userConfirmPassword"]');

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
    
        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    };
    
    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
    
        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    form.addEventListener('submit', async (event) => {  
        checkInputs(event);
    });

    const checkInputs = async (event) => {
        let hasErrors = false;
        event.preventDefault();
        const uNameValue = uName.value.trim();
        const uTypeValue = uType.value.trim();
        const uPassValue = uPass.value.trim();
        const uCPassValue = uCPass.value.trim();
        
        const isDuplicate = await checkDuplicateName(uNameValue);

        // Regular expression to check for special characters
        const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        // Name validation
        if (uNameValue === '') {
            setError(uName, 'User Name cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(uNameValue)) {
            setError(uName, 'Name should not contain special characters');
            hasErrors = true;
        } else if (isDuplicate) {
            setError(uName, 'User Name already present.');
            hasErrors = true;
        } else {
            setSuccess(uName);
        }

        // User Type validation
        if (uTypeValue === '') {
            setError(uType, 'Please select an option');
            hasErrors = true;
        } else {
            setSuccess(uType);
        }

        // User Password validation
        if (uPassValue === '') {
            setError(uPass, 'Password cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(uPassValue)) {
            setError(uPass, 'Password should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(uPass);
        }

        // User Confirm Password validation
        if (uCPassValue === '') {
            setError(uCPass, 'Please confirm the password');
            hasErrors = true;
        } else if (specialCharRegex.test(uCPassValue)) {
            setError(uCPass, 'Password should not contain special characters');
            hasErrors = true;
        } else if (uCPassValue !== uPassValue) {
            setError(uCPass, 'Passwords do not match');
            hasErrors = true;
        } else {
            setSuccess(uCPass);
        }

        if (hasErrors) {
            event.preventDefault(); // Don't submit the form if there are errors
        } else {
            form.submit();
        }
    };

    const checkDuplicateName = async (uNameValue) => {
        console.log('Checking for duplicate Marks:', uNameValue);
        
        const postData = {
            uName: uNameValue
        };
        console.log('Post Data:', postData); // Log postData object
        const response = await fetch('/master/users/userNameValidation', {
            method: 'POST',
            body: JSON.stringify(postData),
            headers: {
                'Content-Type': 'application/json'
            }
        });
        
        console.log('Response received:', response);
        const data = await response.json();
        console.log('Data received:', data);
        return data.exists;
    }
});
