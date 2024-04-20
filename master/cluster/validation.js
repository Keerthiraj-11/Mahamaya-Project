document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#clusteradd');
    const cname = document.querySelector('#clusteradd input[name="cname"]');
    const cownedby = document.querySelector('#clusteradd input[name="cownedby"]');
    const cid = document.querySelector('#clusteradd input[name="cid"]');
    const saveClusterButton = document.querySelector('#clusteradd button[name="save_cluster"]');

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

    
    form.addEventListener('click', (event) => {
        event.preventDefault();// Prevent the default form submission behavior
        checkInputs(event);
    });

    const checkInputs = async (event) => {
         // Prevent form submission
        
        let hasErrors = false;
        const cnameValue = cname.value.trim();
        const cownedbyValue = cownedby.value.trim();
        const cidValue = cid.value.trim();

        const specialCharRegex = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]+/;
        const cnameRegex = /^Cluster-\d{2}$/;
        const isDuplicate = await checkDuplicateCname(cnameValue);
        
        // Name validation
        if (cnameValue === '') {
            setError(cname, 'Name cannot be empty');
            hasErrors = true;
        } else if (!cnameRegex.test(cnameValue)) {
            setError(cname, 'Name should start with "Cluster-" followed by exactly two digits');
            hasErrors = true;
        } else if (isDuplicate === true) {
            setError(cname, 'This name is already in use');
            hasErrors = true;
        } else {
            setSuccess(cname);
            console.log("Success");
        }

        // Location validation
        if (cownedbyValue === '') {
            setError(cownedby, 'Owned-By cannot be empty');
            hasErrors = true;
        } else if (specialCharRegex.test(cownedbyValue)) {
            setError(cownedby, 'Owned-By should not contain special characters');
            hasErrors = true;
        } else {
            setSuccess(cownedby);
        }

        // ID validation
        let updatedCIDValue = cidValue;
        const clusterNumber = cnameValue.match(/\d{2}/)?.[0];
        if (clusterNumber) {
            updatedCIDValue = 'C' + clusterNumber;
            if (cidValue !== updatedCIDValue) {
                cid.value = updatedCIDValue;
                hasErrors = true;
            } else {
                setSuccess(cid);
            }
        }

        if(hasErrors){
            event.preventDefault();
        } else{
            form.submit();
        }
    };

    const checkDuplicateCname = async (cnameValue) => {
        console.log('Checking for duplicate cname:', cnameValue);
        const response = await fetch('/master/cluster/nameValidation', {
            method: 'POST',
            body: JSON.stringify({ cname: cnameValue }),
            headers: {
                'Content-Type': 'application/json'
            }
        });
        console.log('Response received:', response);
        const data = await response.json();
        console.log('Data received:', data);
        return data.exists;
    };
});
