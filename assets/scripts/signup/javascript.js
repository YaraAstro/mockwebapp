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
    { value: 'software engineer', text: 'Software Engineer' },
    { value: 'data analyst', text: 'Data Analyst' },
    { value: 'product manager', text: 'Product Manager' },
    { value: 'graphic designer', text: 'Graphic Designer' },
    { value: 'marketing manager', text: 'Marketing Manager' },
    { value: 'sales representative', text: 'Sales Representative' },
    { value: 'human resources manager', text: 'Human Resources Manager' },
    { value: 'customer service representative', text: 'Customer Service Representative' },
    { value: 'financial analyst', text: 'Financial Analyst' },
    { value: 'project manager', text: 'Project Manager' },
    { value: 'business analyst', text: 'Business Analyst' },
    { value: 'software developer', text: 'Software Developer' },
    { value: 'ux ui designer', text: 'UX/UI Designer' },
    { value: 'network administrator', text: 'Network Administrator' },
    { value: 'content writer', text: 'Content Writer' },
    { value: 'operations manager', text: 'Operations Manager' },
    { value: 'product designer', text: 'Product Designer' },
    { value: 'digital marketing specialist', text: 'Digital Marketing Specialist' },
    { value: 'account manager', text: 'Account Manager' },
    { value: 'business development manager', text: 'Business Development Manager' }
];





// toggle registratin type ===========================================================================

let toggleReg = document.getElementById('toggleType');
toggleReg.addEventListener('click', () => {
    let btnText = document.querySelector('#toggleType span');
    let topic = document.querySelector('h2 span');
    let staff = document.querySelectorAll('.staffContent');
    let mode = document.getElementById('regType');

    if (btnText.textContent == 'Staff') {
        btnText.textContent = 'Customer';
        topic.textContent = 'as Staff';
        mode.value = 'staff';
        toggleReg.style.backgroundColor = '#a38645';
        document.body.style.backgroundImage = "url('../assets/images/signup/milad-fakurian-ICTjWYzpoc0-unsplash.jpg')";

        staff.forEach((content) => content.disabled = false);

        alert('You are registering as a Staff Member !');

        console.log('Reg as = ', mode.value);

    } else {
        btnText.textContent = 'Staff';
        topic.textContent = '';
        mode.value = 'customer';
        toggleReg.style.backgroundColor = '#708dcd';
        document.body.style.backgroundImage = "url('../assets/images/signup/shubham-dhage-LtIf-DdfIgk-unsplash.jpg')";

        staff.forEach((content) => content.disabled = true);

        alert('You are registering as a Regular Customer !');

        console.log('Reg as = ', mode.value);
    }
})





// handle fieldset appearence ==========================================================================

let fieldSets = document.getElementsByTagName('fieldset');
const next = document.getElementById('nextBtn');
const previous = document.getElementById('prevBtn');
const submit = document.getElementById('submitBtn');

// jump to fieldset
function hopIntoField (n) {

    let regMode = document.querySelector('#toggleType span').textContent;
    console.log('reg mode : ', regMode);
    
    // get index of active fieldset
    let current = Array.from(fieldSets).findIndex(fieldSet => fieldSet.style.display === 'flex');
    let fields = Array.from(fieldSets);

    let direction = current + n;

    // handle register mode accordingly
    if (regMode === 'Staff' && ( direction === 3 || direction === 4 )) {
        n > 0 ? direction = 5 : direction = 2;
    }
    
    console.log( 'direction is : ', n, '\nindex of active fieldset is : ', direction , '\n all fields are => ', fields);
    
    fields.forEach((field) => field.style.display = 'none');
    fields[direction].style.display = 'flex';
    
    // eye on form buttons
    if ( direction === 0 ) {
        next.style.display = 'inline';
        previous.style.display = 'none';
        submit.style.display = 'none';
    } else if ( direction === (fieldSets.length - 1) ) {
        next.style.display = 'none';
        previous.style.display = 'inline';
        submit.style.display = 'inline';
    } else {
        next.style.display = 'inline';
        previous.style.display = 'inline';
        submit.style.display = 'none';
    }
    
}

next.addEventListener( 'click', () => hopIntoField(1));

previous.addEventListener( 'click', () => hopIntoField(-1));





// add options to selections ===========================================================================

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
popDropdown('staffBranch', branches);
popDropdown('staffPost', positions);

// toggle visibility
function toggleVisibility (inputField, imgPath) {
    let textField = document.getElementById(inputField);

    if (textField.type == 'password') {
        textField.type = 'text';
        imgPath.src = '../assets/images/signup/eye-solid.svg';
    } else {
        textField.type = 'password';
        imgPath.src = '../assets/images/signup/eye-slash-solid.svg';   
    }
}