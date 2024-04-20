document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#studentaddPuc');
    const marks = document.querySelector('#studentaddPuc input[name="studentMarksFor"]');
    const sschool = document.querySelector('#studentaddPuc input[name="studentSchool"]');
    const sname = document.querySelector('#studentaddPuc input[name="studentName"]');
    const sclass = document.querySelector('#studentaddPuc select[name="studentStd"]');
    //const studentboard = document.querySelector('#studentaddPuc select[name="studentBoard"]');
    const sgender = document.querySelector('#studentaddPuc select[name="studentGender"]');
    const sparent = document.querySelector('#studentaddPuc input[name="studentParent"]');
    const sparentocp = document.querySelector('#studentaddPuc input[name="studentParOcu"]');
    const scontact = document.querySelector('#studentaddPuc input[name="studentContact"]');
    //const smedium = document.querySelector('#studentaddPuc select[name="sMedium"]');
    const stream = document.querySelector('#studentaddPuc select[name="studentStream"]');
    const fLang = document.querySelector('#studentaddPuc select[name="fLang"]');
    const sLang = document.querySelector('#studentaddPuc select[name="sLang"]');

    const fMark = document.querySelector('#studentaddPuc input[name="fMark"]');
    const sMark = document.querySelector('#studentaddPuc input[name="sMark"]');
    const phyMark = document.querySelector('#studentaddPuc input[name="phyMark"]');
    const cheMark = document.querySelector('#studentaddPuc input[name="cheMark"]');
    const matMark = document.querySelector('#studentaddPuc input[name="matMark"]');
    const bioMark = document.querySelector('#studentaddPuc input[name="bioMark"]');
    //const sschoolid = document.querySelector('#studentaddPuc input[name="schoolId"]');
    //const savestudentButton = document.querySelector('#studentaddPuc button[name="save_student"]');


    // Get the selected option element
    const selectedOption = document.querySelector('.marksFor option:checked');
    // Get the value of the marksData attribute
    const marksDataValue = selectedOption.getAttribute('marksData');
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

    
    form.addEventListener('submit', (event) => {
        event.preventDefault();// Prevent the default form submission behavior
        checkInputs(event);
    });

    const checkInputs = (event) => {
         // Prevent form submission
        
        let hasErrors = false;
        event.preventDefault();
        //const marksValue = marks.value.trim();
        const sschoolValue = sschool.value.trim();
        const snameValue = sname.value.trim();
        const sclassValue = sclass.value.trim();
        //const studentboardValue = studentboard.value.trim();
        const sgenderValue = sgender.value.trim();
        const sparentValue = sparent.value.trim();
        const sparentocpValue = sparentocp.value.trim();
        const scontactValue = scontact.value.trim();
        const streamValue = stream.value.trim();
        const fLangValue = fLang.value.trim();
        const sLangValue = sLang.value.trim();
        const fMarkValue = fMark.value.trim();
        const sMarkValue = sMark.value.trim();
        const phyMarkValue = phyMark.value.trim();
        const cheMarkValue = cheMark.value.trim();
        const matMarkValue = matMark.value.trim();
        const bioMarkValue = bioMark.value.trim();
        //const sschoolidValue = sschoolid.value.trim();
        //const smediumValue = smedium.value.trim();

        const specialCharRegex = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]+/;
        // Define a regex pattern to match numbers with up to 3 digits
        //const threeDigitRegex = /^\d{1,3}$/;
        //const isDuplicate = await checkDuplicateName(MarksValue);
        //const isDuplicate = await checkDuplicateName(marksValue, sschoolValue, snameValue, sschoolidValue);
        // Marks for Logic
        
        marks.value = marksDataValue;

        // School validation
        if (sschoolValue === '') {
            setError(sschool, 'Please enter the collage name.');
            hasErrors = true;
        } else if (specialCharRegex.test(sschoolValue)) {
            setError(sschool, 'Name should not contain special characters');
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


        // Student Gender
        if (sgenderValue === '') {
            setError(sgender, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(sgender);
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

         // Stream
         if (streamValue === '') {
            setError(stream, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(stream);
        }

         // 1st ALnguage
         if (fLangValue === '') {
            setError(fLang, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(fLang);
        }

         // 2nd Luanguage
         if (sLangValue === '') {
            setError(sLang, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(sLang);
        }


        // 1st Lang Mark validation
        if (fMarkValue === '') {
            setError(fMark, 'Value cannot be empty');
            hasErrors = true;
        } /*else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        }*/ else if (parseInt(fMarkValue) > 100) {
            setError(fMark, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(fMark);
            console.log("Success");
        }

        // 2nd Lang Mark validation
        if (sMarkValue === '') {
            setError(sMark, 'Value cannot be empty');
            hasErrors = true;
        } /*else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        }*/ else if (parseInt(sMarkValue) > 100) {
            setError(sMark, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(sMark);
            console.log("Success");
        }

        // Physics
        if (phyMarkValue === '') {
            setError(phyMark, 'Value cannot be empty');
            hasErrors = true;
        } /*else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        }*/ else if (parseInt(phyMarkValue) > 100) {
            setError(phyMark, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(phyMark);
            console.log("Success");
        }

        // Chemistry
        if (cheMarkValue === '') {
            setError(cheMark, 'Value cannot be empty');
            hasErrors = true;
        } /*else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        }*/ else if (parseInt(cheMarkValue) > 100) {
            setError(cheMark, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(cheMark);
            console.log("Success");
        }

        // Maths
        if (matMarkValue === '') {
            setError(matMark, 'Value cannot be empty');
            hasErrors = true;
        } /*else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        }*/ else if (parseInt(matMarkValue) > 100) {
            setError(matMark, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(matMark);
            console.log("Success");
        }

        //Biology
        if (bioMarkValue === '') {
            setError(bioMark, 'Value cannot be empty');
            hasErrors = true;
        } /*else if (!threeDigitRegex.test(ssubkanValue)) {
            setError(ssubkan, 'Value should be below 3 digits');
            hasErrors = true;
        }*/ else if (parseInt(bioMarkValue) > 100) {
            setError(bioMark, 'Value should not exceed 100');
            hasErrors = true;
        } else {
            setSuccess(bioMark);
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
});

