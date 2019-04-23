const registerForm = document.getElementById("register");
const loginForm = document.getElementById("login");
let formValidator;

if (registerForm) {
    formValidator = new Validator("register");
    formValidator.EnableOnPageErrorDisplay();
    formValidator.EnableMsgsTogether();
    formValidator.addValidation("name", "req", "Please provide your name");
    formValidator.addValidation("email", "req", "Please provide your email address");
    formValidator.addValidation("email", "email", "Please provide a valid email address");
    formValidator.addValidation("username", "req", "Please provide a username");
    formValidator.addValidation("password", "req", "Please provide a password");
} else if (loginForm) {
    formValidator = new Validator("login");
    formValidator.EnableOnPageErrorDisplay();
    formValidator.EnableMsgsTogether();
    formValidator.addValidation("username", "req", "Please provide a username");
    formValidator.addValidation("password", "req", "Please provide a password");
}

const existingHouseholdButton = document.getElementById('existing-household');
const householdCodeForm = document.getElementById('household-code-form');
const householdButtons = document.getElementById('household-buttons');
const backAddressButton = document.querySelector('.back-address');
existingHouseholdButton.addEventListener('click', () => {
    householdCodeForm.style.display = 'block';
    householdButtons.style.display = 'none';
})
backAddressButton.addEventListener('click', () => {
    console.log('clicked');
    householdCodeForm.style.display = 'none';
    householdButtons.style.display = 'flex';
})