document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#studentadd');
    const marks = document.querySelector('#studentadd select[name="studentMarksFor"]');
    const sschool = document.querySelector('#studentadd select[name="studentSchool"]');
    const sname = document.querySelector('#studentadd input[name="studentName"]');
    const sclass = document.querySelector('#studentadd select[name="studentStd"]');
    const studentboard = document.querySelector('#studentadd select[name="studentBoard"]');
    const sgender = document.querySelector('#studentadd select[name="studentGender"]');
    const sparent = document.querySelector('#studentadd input[name="studentParent"]');
    const sparentocp = document.querySelector('#studentadd input[name="studentParOcu"]');
    const scontact = document.querySelector('#studentadd input[name="studentContact"]');
    const smedium = document.querySelector('#studentadd select[name="sMedium"]');

    const ssubkan = document.querySelector('#studentadd input[name="subKan"]');
    const ssubeng = document.querySelector('#studentadd input[name="subEng"]');
    const ssubhin = document.querySelector('#studentadd input[name="subHin"]');
    const ssubmat = document.querySelector('#studentadd input[name="subMat"]');
    const ssubsci = document.querySelector('#studentadd input[name="subSci"]');
    const ssubsoc = document.querySelector('#studentadd input[name="subSoc"]');
    const sschoolid = document.querySelector('#studentadd input[name="schoolId"]');
    const savestudentButton = document.querySelector('#studentadd button[name="save_student"]');
console.log("running");
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

    
    form.addEventListener('submit', async (event) => {
        event.preventDefault();// Prevent the default form submission behavior
        checkInputs(event);
    });

    const checkInputs = async (event) => {
         // Prevent form submission
        
        let hasErrors = false;
        event.preventDefault();
        const marksValue = marks.value.trim();
        const sschoolValue = sschool.value.trim();
        const snameValue = sname.value.trim();
        const sclassValue = sclass.value.trim();
        const studentboardValue = studentboard.value.trim();
        const sgenderValue = sgender.value.trim();
        const sparentValue = sparent.value.trim();
        const sparentocpValue = sparentocp.value.trim();
        const scontactValue = scontact.value.trim();
        const ssubkanValue = ssubkan.value.trim();
        const ssubengValue = ssubeng.value.trim();
        const ssubhinValue = ssubhin.value.trim();
        const ssubmatValue = ssubmat.value.trim();
        const ssubsciValue = ssubsci.value.trim();
        const ssubsocValue = ssubsoc.value.trim();
        const sschoolidValue = sschoolid.value.trim();
        const smediumValue = smedium.value.trim();

        const specialCharRegex = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]+/;
        // Define a regex pattern to match numbers with up to 3 digits
        const threeDigitRegex = /^\d{1,3}$/;
        //const isDuplicate = await checkDuplicateName(MarksValue);
        const isDuplicate = await checkDuplicateName(marksValue, sschoolValue, snameValue, sschoolidValue);
        // Marks for Logic
        if (marksValue === '') {
            setError(marks, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(marks);
            console.log("Success");
        }


        // School validation
        if (sschoolValue === '') {
            setError(sschool, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(sschool);
        }

        // Student Name validation
        if (snameValue === '') {
            setError(sname, 'Name cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(snameValue)) {
            setError(sname, 'Name should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(sname);
            console.log("Success");
        }

        // Student Class
        if (sclassValue === '') {
            setError(sclass, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(sclass);
        }

        // Student Class
        if (studentboardValue === '') {
            setError(studentboard, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(studentboard);
        }

        // Student Gender
        if (sgenderValue === '') {
            setError(sgender, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(sgender);
        }

        // Student Medium
        if (smediumValue === '') {
            setError(smedium, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(smedium);
        }

        // Parent Name validation
        if (sparentValue === '') {
            setError(sparent, 'Name cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(sparentValue)) {
            setError(sparent, 'Value should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(sparent);
            console.log("Success");
        }

        // Parent Occupation validation
        if (sparentocpValue === '') {
            setError(sparentocp, 'Name cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(sparentocpValue)) {
            setError(sparentocp, 'Value should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(sparentocp);
            console.log("Success");
        }

        // Phone validation
       if (scontactValue === '') {
        setError(scontact, 'Phone number cannot be empty');
        hasErrors = true;
        } else if (!isValidPhoneNumber(scontactValue)) { // Check if phone number is valid
            setError(scontact, 'Provide a valid phone number (e.g., +91 1234567890)');
            hasErrors = true;
        } else {
            setSuccess(scontact);
        }

        // Subject Kannada validation
        if (ssubkanValue === '') {
            setError(ssubkan, 'Value cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should not contain special characters');
            hasErrors = true;
        } else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        } else if (parseInt(ssubkanValue) > 125) {
            setError(ssubkan, 'Value should not exceed 125');
            hasErrors = true;
        } else {
            setSuccess(ssubkan);
            console.log("Success");
        }

        // Subject English validation
        if (ssubengValue === '') {
            setError(ssubeng, 'Value cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(ssubengValue)) {
            setError(ssubeng, 'Value should not contain special characters');
            hasErrors = true;
        } else if (!threeDigitRegex.test(ssubengValue)) {
            setError(ssubeng, 'Value should be below 3 digits');
            hasErrors = true;
        } else if (parseInt(ssubengValue) > 100) {
            setError(ssubeng, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(ssubeng);
            console.log("Success");
        }

        // Subject Hindi validation
        if (ssubhinValue === '') {
            setError(ssubhin, 'Value cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(ssubhinValue)) {
            setError(ssubhin, 'Value should not contain special characters');
            hasErrors = true;
        } else if (!threeDigitRegex.test(ssubhinValue)) {
            setError(ssubhin, 'Value should be below 3 digits');
            hasErrors = true;
        } else if (parseInt(ssubhinValue) > 100) {
            setError(ssubhin, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(ssubhin);
            console.log("Success");
        }

        // Subject Maths validation
        if (ssubmatValue === '') {
            setError(ssubmat, 'Value cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(ssubmatValue)) {
            setError(ssubmat, 'Value should not contain special characters');
            hasErrors = true;
        } else if (!threeDigitRegex.test(ssubmatValue)) {
            setError(ssubmat, 'Value should be below 3 digits');
            hasErrors = true;
        } else if (parseInt(ssubmatValue) > 100) {
            setError(ssubmat, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(ssubmat);
            console.log("Success");
        }

        // Subject Maths validation
        if (ssubsciValue === '') {
            setError(ssubsci, 'Value cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(ssubsciValue)) {
            setError(ssubsci, 'Value should not contain special characters');
            hasErrors = true;
        } else if (!threeDigitRegex.test(ssubsciValue)) {
            setError(ssubsci, 'Value should be below 3 digits');
            hasErrors = true;
        } else if (parseInt(ssubsciValue) > 100) {
            setError(ssubsci, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(ssubsci);
            console.log("Success");
        }

        // Subject Maths validation
        if (ssubsocValue === '') {
            setError(ssubsoc, 'Value cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(ssubsocValue)) {
            setError(ssubsoc, 'Value should not contain special characters');
            hasErrors = true;
        } else if (!threeDigitRegex.test(ssubsocValue)) {
            setError(ssubsoc, 'Value should be below 3 digits');
            hasErrors = true;
        } else if (parseInt(ssubsocValue) > 100) {
            setError(ssubsoc, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(ssubsoc);
            console.log("Success");
        }

        /* ID validation
        let updatedCIDValue = cidValue;
        const studentNumber = MarksValue.match(/\d{2}/)?.[0];
        if (studentNumber) {
            updatedCIDValue = 'C' + studentNumber;
            if (cidValue !== updatedCIDValue) {
                cid.value = updatedCIDValue;
                hasErrors = true;
            } else {
                setSuccess(cid);
            }
        }*/

        
        if(hasErrors){
            event.preventDefault();
        } else if (!hasErrors) {
            if (isDuplicate) {
                setError(sname, 'Name already present in the school name');
                hasErrors = true;
            } else {
                setSuccess(sname);
                console.log("Complete");
                form.submit();
            }
        }
    };
    const checkDuplicateName = async (marksValue, sschoolValue, snameValue, sschoolidValue) => {
        console.log('Checking for duplicate Marks:', marksValue);
        
        const postData = {
            marks: marksValue,
            sschool: sschoolValue,
            sname: snameValue,
            sschoolid: sschoolidValue
        };
        console.log('Post Data:', postData); // Log postData object
        const response = await fetch('/master/student/nameValidation', {
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

    const isValidPhoneNumber = phoneNumber => {
        // Regular expression pattern
        const regex = /^\+91 \d{10}$/;
        // Test the input against the pattern
        return regex.test(phoneNumber);
    };
});
