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
<<<<<<< HEAD
if (existingHouseholdButton) {
=======


if (existingHouseholdButton) {

>>>>>>> f9c174c501a67e882ea407381321bdc631f54490
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

/**
 * Asynchronously delete Bill without refresh
 */
$(document).ready(function() {



    $('.deleteForm').submit(function(e) {

        // console.log($(this).serialize());

        var form = $(this).parent().parent().parent(); //Need to define $(this) entire bill card before ajax request

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'delete.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);

                // Bill Is Deleted
                if (jsonData.success == "1")
                {
                    form.animate({
                        top: "-=1000"
                    }, 1000, function(){
                        form.remove();
                    });

                }
                else
                {
                    alert('Invalid Delete');
                }
            }
        });
    });
});
