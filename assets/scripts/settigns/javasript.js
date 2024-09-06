// select option data

const districts = [
    { value: 'colombo', text: 'Colombo' },
    { value: 'gampaha', text: 'Gampaha' },
    { value: 'kalutara', text: 'Kalutara' },
    { value: 'kandy', text: 'Kandy' },
    { value: 'matale', text: 'Matale' },
    { value: 'nuwara-eliya', text: 'Nuwara Eliya' },
    { value: 'galle', text: 'Galle' },
    { value: 'hambantota', text: 'Hambantota' },
    { value: 'jaffna', text: 'Jaffna' },
    { value: 'kilinochchi', text: 'Kilinochchi' },
    { value: 'mannar', text: 'Mannar' },
    { value: 'vavuniya', text: 'Vavuniya' },
    { value: 'mullaitivu', text: 'Mullaitivu' },
    { value: 'batticaloa', text: 'Batticaloa' },
    { value: 'ampara', text: 'Ampara' },
    { value: 'trincomalee', text: 'Trincomalee' },
    { value: 'kurunegala', text: 'Kurunegala' },
    { value: 'puttalam', text: 'Puttalam' },
    { value: 'anuradhapura', text: 'Anuradhapura' },
    { value: 'polonnaruwa', text: 'Polonnaruwa' },
    { value: 'badulla', text: 'Badulla' },
    { value: 'monaragala', text: 'Monaragala' },
    { value: 'ratnapura', text: 'Ratnapura' },
    { value: 'kegalle', text: 'Kegalle' }
];

const branches = [
    { value: 'colombo', text: 'Colombo' },
    { value: 'kandy', text: 'Kandy' },
    { value: 'galle', text: 'Galle' },
    { value: 'jaffna', text: 'Jaffna' },
    { value: 'negombo', text: 'Negombo' },
    { value: 'batticaloa', text: 'Batticaloa' },
    { value: 'trincomalee', text: 'Trincomalee' },
    { value: 'anuradhapura', text: 'Anuradhapura' },
    { value: 'kurunegala', text: 'Kurunegala' },
    { value: 'matara', text: 'Matara' },
    { value: 'ratnapura', text: 'Ratnapura' },
    { value: 'badulla', text: 'Badulla' },
    { value: 'puttalam', text: 'Puttalam' },
    { value: 'vavuniya', text: 'Vavuniya' },
    { value: 'maharagama', text: 'Maharagama' }
];

const positions = [
    { value: 'software_engineer', text: 'Software Engineer' },
    { value: 'data_analyst', text: 'Data Analyst' },
    { value: 'product_manager', text: 'Product Manager' },
    { value: 'graphic_designer', text: 'Graphic Designer' },
    { value: 'marketing_manager', text: 'Marketing Manager' },
    { value: 'sales_representative', text: 'Sales Representative' },
    { value: 'human_resources_manager', text: 'Human Resources Manager' },
    { value: 'customer_service_representative', text: 'Customer Service Representative' },
    { value: 'financial_analyst', text: 'Financial Analyst' },
    { value: 'project_manager', text: 'Project Manager' },
    { value: 'business_analyst', text: 'Business Analyst' },
    { value: 'software_developer', text: 'Software Developer' },
    { value: 'ux_ui_designer', text: 'UX/UI Designer' },
    { value: 'network_administrator', text: 'Network Administrator' },
    { value: 'content_writer', text: 'Content Writer' },
    { value: 'operations_manager', text: 'Operations Manager' },
    { value: 'product_designer', text: 'Product Designer' },
    { value: 'digital_marketing_specialist', text: 'Digital Marketing Specialist' },
    { value: 'account_manager', text: 'Account Manager' },
    { value: 'business_development_manager', text: 'Business Development Manager' }
];



// ===========================================================================================================================
// add data to drop down menu
function popDropdown(container, optionList) {
    let dropBox = document.getElementById(container);

    optionList.forEach(element => {
        let option = document.createElement('option');
        option.value = element.value;
        option.textContent = element.text;
        dropBox.appendChild(option);
    });
}

popDropdown('userDistrict', districts);
// popDropdown('userBranch', branches);
// popDropdown('userPost', positions);



// ===========================================================================================================================
// change password visibility
function changeVisibility (eyeBtn, inputField) {
    let passwordField = document.getElementById(inputField);

    if ( passwordField.type == 'password' ) {
        passwordField.type = 'text';
        eyeBtn.src = '../assets/images/settings/eye-solid.svg';
    } else {
        passwordField.type = 'password';
        eyeBtn.src = '../assets/images/settings/eye-slash-solid.svg';
    }
}



// ===========================================================================================================================
// show full name
let first_name = document.getElementById('firstName');
let last_name = document.getElementById('lastName');
let full_name = document.getElementById('fullName');

first_name.addEventListener('input', () => {
    full_name.textContent = first_name.value + " " + last_name.value ;
});

last_name.addEventListener('input', () => {
    full_name.textContent = first_name.value + " " + last_name.value ;
});



// ===========================================================================================================================
// calculate age
let dob = document.getElementById('bDay');
dob.addEventListener('input', () => {
    let showAge = document.getElementById('showAge');

    if (dob.value) {

        let today = new Date();
        let birth = new Date(dob.value);
    
        let age = today.getFullYear() - birth.getFullYear();
        let monthGap = today.getMonth() - birth.getMonth();
    
        if ( monthGap < 0 || ( monthGap === 0 && today.getDate() < birth.getDate() ) ) {
            age--;
        }
    
        showAge.textContent = age ;
    } else {

        showAge.textContent = '--';

    }

}); 



// ===========================================================================================================================
// validate new password
let newPwd = document.getElementById('createPwd');
newPwd.addEventListener('input', () => {

    let checkCapital = document.getElementById('capital-error');
    let checkSpChar = document.getElementById('spchar-error');
    let checkNums = document.getElementById('number-error');
    let checkCount = document.getElementById('char-count');
    let submit = document.getElementById('resetPwdBtn');

    !/[A-Z]/.test(newPwd.value) ? checkCapital.style.color = 'rosybrown' : checkCapital.style.color = 'olivedrab' ;
    !/[! @ # $ % ^ & * () , ? " : {} | <>]/.test(newPwd.value) ? checkSpChar.style.color = 'rosybrown' : checkSpChar.style.color = 'olivedrab' ;
    !/[0-9]/.test(newPwd.value) ? checkNums.style.color = 'rosybrown' : checkNums.style.color = 'olivedrab' ;
    newPwd.value.length >= 8 ? checkCount.style.color = 'olivedrab' : checkCount.style.color = 'rosybrown' ;

    if ( !/[A-Z]/.test(newPwd.value) || !/[! @ # $ % ^ & * () , ? " : {} | <>]/.test(newPwd.value) || !/[0-9]/.test(newPwd.value) || newPwd.value.length <= 8 ) {
        submit.disabled = true;
    } else {
        submit.disabled = false;
    }

});

// confirm new password
let confirmNew = document.getElementById('confirmPwd');
confirmNew.addEventListener('input', () => {
    let newPwd = document.getElementById('createPwd');
    let errorMsg = document.getElementById('error-msg');
    let submit = document.getElementById('resetPwdBtn');

    confirmNew.value != newPwd.value ? errorMsg.textContent = 'Passwords doesn\'t match!' : errorMsg.textContent = '' ;
    confirmNew.value === newPwd.value ? submit.disabled = false : submit.disabled = true ;

});



// ===========================================================================================================================
// image upload
let getImg = document.getElementById('userImg');
getImg.addEventListener('change', (event) => {
    let pic = event.target.files[0];
    if (pic) {
        let showImg = document.getElementById('showPic');
        let newSrc = URL.createObjectURL(pic);

        showImg.src = newSrc;
        showImg.onload = () => URL.revokeObjectURL(newSrc)
    }
});