document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#addAddmission');
    const studentPic = document.querySelector('#addAddmission input[name="studentPic"]');
    const name = document.querySelector('#addAddmission input[name="name"]');
    const dob = document.querySelector('#addAddmission input[name="dob"]');
    const cName = document.querySelector('#addAddmission input[name="cName"]');
    const sClass = document.querySelector('#addAddmission select[name="class"]');
    const board = document.querySelector('#addAddmission input[name="board"]');
    const pClassPer = document.querySelector('#addAddmission input[name="pClassPer"]');
    const parentName = document.querySelector('#addAddmission input[name="parentName"]');
    const parentOcp = document.querySelector('#addAddmission input[name="parentOcp"]');
    const address = document.querySelector('#addAddmission input[name="address"]');
    const sPhone = document.querySelector('#addAddmission input[name="sPhone"]');
    const pPhone = document.querySelector('#addAddmission input[name="pPhone"]');
    const sEmail = document.querySelector('#addAddmission input[name="sEmail"]');
    const religion = document.querySelector('#addAddmission input[name="religion"]');
    const caste = document.querySelector('#addAddmission input[name="caste"]');
    const fLang = document.querySelector('#addAddmission select[name="fLang"]');
    const sLang = document.querySelector('#addAddmission select[name="sLang"]');
    const stream = document.querySelector('#addAddmission select[name="stream"]');
    const cMode = document.querySelector('#addAddmission select[name="cMode"]');
    const sslcMarks = document.querySelector('#addAddmission input[name="sslcMarks"]');
    const midtermMarks = document.querySelector('#addAddmission input[name="midtermMarks"]');

    // Set default value for phone input
    sPhone.value = '+91 '; // Set the initial value to '+91 '
    pPhone.value = '+91 '; // Set the initial value to '+91 '

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

    

    form.addEventListener('submit', (event) => {  
        checkInputs(event);
    });

    const checkInputs = async (event) => {
        let hasErrors = false;
        event.preventDefault();
        const studentPicValue = studentPic.value.trim();
        const nameValue = name.value.trim();
        const dobValue = dob.value.trim();
        const cNameValue = cName.value.trim();
        const sClassValue = sClass.value.trim();
        const boardValue = board.value.trim();
        const pClassPerValue = pClassPer.value.trim();
        const parentNameValue = parentName.value.trim();
        const parentOcpValue = parentOcp.value.trim();
        const addressValue = address.value.trim();
        const sPhoneValue = sPhone.value.trim();
        const pPhoneValue = pPhone.value.trim();
        const sEmailValue = sEmail.value.trim();
        const religionValue = religion.value.trim();
        const casteValue = caste.value.trim();
        const fLangValue = fLang.value.trim();
        const sLangValue = sLang.value.trim();
        const streamValue = stream.value.trim();
        const cModeValue = cMode.value.trim();
        const sslcMarksValue = sslcMarks.value.trim();
        const midtermMarksValue = midtermMarks.value.trim();
        

        // Regular expression to check for special characters
        const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/;

       
        // User Pic validation
        if (studentPicValue === '') {
            setError(studentPic, 'Please select an option');
            hasErrors = true;
        } else if (!['image/jpeg', 'image/jpg', 'image/png'].includes(studentPic.files[0].type)) {
            setError(studentPic, 'File type should be JPEG, JPG, or PNG.');
            hasErrors = true;
        } else if (studentPic.files[0].size > 5 * 1024 * 1024) {
            setError(studentPic, 'File size should not exceed 5 MB.');
            hasErrors = true;
        } else {
            convertToPNG(studentPic);
            setSuccess(studentPic);
        }

        //Name validation
        if (nameValue === '') {
            setError(name, 'Name cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(nameValue)) {
            setError(name, 'Name should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(name);
        }

        // Date of Birth validation
        if (dobValue === '') {
            setError(dob, 'DOB cannot be empty.');
            hasErrors = true;
        } else {
            setSuccess(dob);
        }

        // Collage Name validation
        if (cNameValue === '') {
            setError(cName, 'Collage Name cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(cNameValue)) {
            setError(cName, 'Name should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(cName);
        }

        // Student Class validation
        if (sClassValue === '') {
            setError(sClass, 'Present Class cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(sClassValue)) {
            setError(sClass, 'Input cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(sClass);
        }

        // Board Input validation
        if (boardValue === '') {
            setError(board, 'Board cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(boardValue)) {
            setError(board, 'Board Value cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(board);
        }

        // Percentage Input validation
        if (pClassPerValue === '') {
            setError(pClassPer, 'Enter the previous class Percentage.');
            hasErrors = true;
        } else if (specialCharRegex.test(pClassPerValue)) {
            setError(pClassPer, 'Enter only percentage Ex:- 55.01');
            hasErrors = true;
        } else {
            setSuccess(pClassPer);
        }

         // Parent Name validation
         if (parentNameValue === '') {
            setError(parentName, 'Name cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(parentNameValue)) {
            setError(parentName, 'Name cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(parentName);
        }

        // Parent Occupation validation
        if (parentOcpValue === '') {
            setError(parentOcp, 'Name cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(parentOcpValue)) {
            setError(parentOcp, 'Name cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(parentOcp);
        }

        // Parent Occupation validation
        if (addressValue === '') {
            setError(address, 'Address cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(addressValue)) {
            setError(address, 'Address cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(address);
        }

        // Student Number validation
        if (sPhoneValue === '') {
            setError(sPhone, 'Number cannot be empty.');
            hasErrors = true;
        } else if (!isValidPhoneNumber(sPhoneValue)) { // Check if phone number is valid
            setError(sPhone, 'Provide a valid phone number (e.g., +91 1234567890)');
            hasErrors = true;
        } else {
            setSuccess(sPhone);
        }

        // Student Number validation
        if (pPhoneValue === '') {
            setError(pPhone, 'Number cannot be empty.');
            hasErrors = true;
        } else if (!isValidPhoneNumber(pPhoneValue)) { // Check if phone number is valid
            setError(pPhone, 'Provide a valid phone number (e.g., +91 1234567890)');
            hasErrors = true;
        } else {
            setSuccess(pPhone);
        }


        // Email validation
        if (sEmailValue === '') {
            setError(sEmail, 'Email Address cannot be empty.');
            hasErrors = true;
        } else if (!isValidEmail(sEmailValue)) {
            setError(sEmail, 'Provide a valid email address');
            hasErrors = true;
        } else {
            setSuccess(sEmail);
        }


        // Religion validation
        if (religionValue === '') {
            setError(religion, 'Religion cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(religionValue)) {
            setError(religion, 'Religion cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(religion);
        }

        // Caste validation
        if (casteValue === '') {
            setError(caste, 'Caste cannot be empty.');
            hasErrors = true;
        } else if (specialCharRegex.test(casteValue)) {
            setError(caste, 'Caste cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(caste);
        }

        // Language 1st validation
        if (fLangValue === '') {
            setError(fLang, 'Please Enter 1st Language.');
            hasErrors = true;
        } else if (specialCharRegex.test(fLangValue)) {
            setError(fLang, 'Language cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(fLang);
        }

        // Language 2nd validation
        if (sLangValue === '') {
            setError(sLang, 'Please Enter 2nd Language.');
            hasErrors = true;
        } else if (specialCharRegex.test(sLangValue)) {
            setError(sLang, 'Language cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(sLang);
        }

        // Stream validation
        if (streamValue === '') {
            setError(stream, 'Select the Value.');
            hasErrors = true;
        } else if (specialCharRegex.test(streamValue)) {
            setError(stream, 'Value cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(stream);
        }

        // Class mode validation
        if (cModeValue === '') {
            setError(cMode, 'Select the Value.');
            hasErrors = true;
        } else if (specialCharRegex.test(cModeValue)) {
            setError(cMode, 'Value cannot contain special characters');
            hasErrors = true;
        } else {
            setSuccess(cMode);
        }

        // Upload file validation for sslcMarks
        if (sslcMarksValue === '') {
            setError(sslcMarks, 'Please select the file.');
            hasErrors = true;
        } else if (!['image/jpeg', 'image/jpg', 'image/png'].includes(sslcMarks.files[0].type)) {
            setError(sslcMarks, 'File type should be JPEG, JPG, or PNG.');
            hasErrors = true;
        } else if (sslcMarks.files[0].size > 5 * 1024 * 1024) {
            setError(sslcMarks, 'File size should not exceed 5 MB.');
            hasErrors = true;
        } else {
            convertToPNG(sslcMarks);
            setSuccess(sslcMarks);
        }

        // Upload file validation for midtermMarks
        if (midtermMarksValue === '') {
            setError(midtermMarks, 'Please select the file.');
            hasErrors = true;
        } else if (!['image/jpeg', 'image/jpg', 'image/png'].includes(midtermMarks.files[0].type)) {
            setError(midtermMarks, 'File type should be JPEG, JPG, or PNG.');
            hasErrors = true;
        } else if (midtermMarks.files[0].size > 5 * 1024 * 1024) {
            setError(midtermMarks, 'File size should not exceed 5 MB.');
            hasErrors = true;
        } else {
            convertToPNG(midtermMarks);
            setSuccess(midtermMarks);
        }



        if (hasErrors) {
            event.preventDefault(); // Don't submit the form if there are errors
        } else {
            form.submit();
        }
    };

    const isValidPhoneNumber = phoneNumber => {
        // Regular expression pattern
        const regex = /^\+91 \d{10}$/;
        // Test the input against the pattern
        return regex.test(phoneNumber);
    };

    const isValidEmail = email => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    };


    // Function to check if the uploaded file is a PNG file
    function isValidFileType(fileInput) {
        var file = fileInput.files[0];
        var fileType = file.type;
        return fileType === 'image/png';
    }

    // Function to handle file conversion from JPEG/JPG to PNG
    function convertToPNG(fileInput) {
        var file = fileInput.files[0];
        if (file.type === 'image/jpeg' || file.type === 'image/jpg') {
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = new Image();
                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0);
                    canvas.toBlob(function(blob) {
                        var newFile = new File([blob], file.name.replace(/\.(jpeg|jpg)$/, '.png'), { type: 'image/png' });
                        fileInput.files[0] = newFile;
                        console.log('File type after conversion:', newFile.type);
                    }, 'image/png');
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
});
