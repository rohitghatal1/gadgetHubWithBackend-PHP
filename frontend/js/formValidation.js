document.addEventListener("DOMContentLoaded", function () {
    let form = document.getElementById("registerform");
    let nameInput = document.getElementById("name");
    let addressInput = document.getElementById("address");
    let contactInput = document.getElementById("contact");
    let emailInput = document.getElementById("email");
    let usernameInput = document.getElementById("username");
    let passwordInput = document.getElementById("password");
    let cPasswordInput = document.getElementById("cPassword");

    // Define regex
    let nameRegex = /^[a-zA-Z\s]+$/;
    let contactRegex = /^\d{10}$/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%&*?])[a-zA-Z\d!@#$%^&*?]{8,}$/;

    // Event listeners for input fields
    nameInput.addEventListener("blur", validateName);
    addressInput.addEventListener("blur", validateAddress);
    contactInput.addEventListener("blur", validateContact);
    emailInput.addEventListener("blur", validateEmail);
    usernameInput.addEventListener("blur", validateUsername);
    passwordInput.addEventListener("blur", validatePassword);
    cPasswordInput.addEventListener("blur", validateCPassword);

    // Form submission event
    form.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    // Validation functions
    function validateForm() {
        return (
            validateName() &&
            validateAddress() &&
            validateContact() &&
            validateEmail() &&
            validateUsername() &&
            validatePassword() &&
            validateCPassword()
        );
    }

    function validateName() {
        let name = nameInput.value.trim();
        if (!nameRegex.test(name)) {
            updateErrorMessage("nameError", "Full name should only contain letters and spaces!!!");
            return false;
        }
        clearErrorMessage("nameError");
        return true;
    }

    function validateAddress() {
        let address = addressInput.value.trim();
        if (address === "") {
            updateErrorMessage("addressError", "Address cannot be empty!!!");
            return false;
        }
        clearErrorMessage("addressError");
        return true;
    }

    function validateContact() {
        let contact = contactInput.value.trim();
        if (!contactRegex.test(contact)) {
            updateErrorMessage("contactError", "Contact number should be a 10-digit number!!!");
            return false;
        }
        clearErrorMessage("contactError");
        return true;
    }

    function validateEmail() {
        let email = emailInput.value.trim();
        if (!emailRegex.test(email)) {
            updateErrorMessage("emailError", "Please enter a valid email address!!!");
            return false;
        }
        clearErrorMessage("emailError");
        return true;
    }

    function validateUsername() {
        let username = usernameInput.value.trim();
        if (username === "") {
            updateErrorMessage("usernameError", "Username cannot be empty!!!");
            return false;
        }
        clearErrorMessage("usernameError");
        return true;
    }

    function validatePassword() {
        let password = passwordInput.value;
        if (!passwordRegex.test(password)) {
            updateErrorMessage(
                "passwordError",
                "Password should contain at least one uppercase letter, one special character, and one number!!!"
            );
            return false;
        }
        clearErrorMessage("passwordError");
        return true;
    }

    function validateCPassword() {
        let password = passwordInput.value;
        let cPassword = cPasswordInput.value;
        if (password !== cPassword) {
            updateErrorMessage("cPasswordError", "Passwords do not match!!!");
            return false;
        }
        clearErrorMessage("cPasswordError");
        return true;
    }

    // Function to update error message
    function updateErrorMessage(elementId, message) {
        let errorElement = document.getElementById(elementId);
        if (!errorElement) {
            errorElement = document.createElement("div");
            errorElement.id = elementId;
            errorElement.classList.add("error-message");
            form.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }

    // Function to clear error message
    function clearErrorMessage(elementId) {
        let errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = "";
        }
    }
});
