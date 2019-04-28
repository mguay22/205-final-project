const registerForm = document.getElementById("register");
const loginForm = document.getElementById("login");
const addressForm = document.getElementById("new-address");
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
} else if (addressForm) {
    formValidator = new Validator("new-address");
    formValidator.EnableOnPageErrorDisplay();
    formValidator.EnableMsgsTogether();
    formValidator.addValidation("address", "req", "Please provide an address");
    formValidator.addValidation("zip-code", "req", "Please provide a zip code");
    formValidator.addValidation("city", "req", "Please provide a city");
    formValidator.addValidation("state", "req", "Please provide a state");
}

const existingHouseholdButton = document.getElementById('existing-household');
const householdCodeForm = document.getElementById('household-code-form');
const householdButtons = document.getElementById('household-buttons');
const backAddressButton = document.querySelector('.back-address');
if (existingHouseholdButton) {
    existingHouseholdButton.addEventListener('click', () => {
        householdCodeForm.style.display = 'block';
        householdButtons.style.display = 'none';
    });
}

if (backAddressButton) {
    backAddressButton.addEventListener('click', () => {
        householdCodeForm.style.display = 'none';
        householdButtons.style.display = 'flex';
    });
}