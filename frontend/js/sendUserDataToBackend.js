document.addEventListener("DOMContentLoaded", function () {
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
    nameInput.addEventListener("input", function () {
      clearErrorMessage("nameError");
      clearErrorMessage("generalError");
    });
  
    addressInput.addEventListener("blur", validateAddress);
    addressInput.addEventListener("input", function () {
      clearErrorMessage("addressError");
      clearErrorMessage("generalError");
    });
  
    contactInput.addEventListener("blur", validateContact);
    contactInput.addEventListener("input", function () {
      clearErrorMessage("contactError");
      clearErrorMessage("generalError");
    });
  
    emailInput.addEventListener("blur", validateEmail);
    emailInput.addEventListener("input", function () {
      clearErrorMessage("emailError");
      clearErrorMessage("generalError");
    });
  
    usernameInput.addEventListener("blur", validateUsername);
    usernameInput.addEventListener("input", function () {
      clearErrorMessage("usernameError");
      clearErrorMessage("generalError");
    });
  
    passwordInput.addEventListener("blur", validatePassword);
    passwordInput.addEventListener("input", function () {
      clearErrorMessage("passwordError");
      clearErrorMessage("generalError");
    });
  
    cPasswordInput.addEventListener("blur", validateCPassword);
    cPasswordInput.addEventListener("input", function () {
      clearErrorMessage("cPasswordError");
      clearErrorMessage("generalError");
    });
  
    // Form submission event listener
    document
      .querySelector("form")
      .addEventListener("submit", function (event) {
        event.preventDefault();
  
        // Validate the form
        if (validateForm()) {
          // If form is valid, send AJAX request
          submitForm();
        } else {
          updateErrorMessage("generalError", "Please input valid data in all fields!!!");
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
        document.querySelector("form").appendChild(errorElement);
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
  
    // Function to submit form via AJAX
    function submitForm() {
      let form = document.getElementById("registerform");
      let formData = new FormData(form);
  
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "/gadgetHubWithBackend/backend/userRegistration.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
          if (xhr.status == 200) {
            let response = xhr.responseText;
            if (response.includes("Email Already Used")) {
              alert("Email Already Used");
            } else if (response.includes("Username Already taken")) {
              alert("Username Already taken");
            } else {
              alert("Registration successful!");
              form.reset(); // Clearing all input fields
            }
          } else {
            console.error("Error: " + xhr.status);
          }
        }
      };
      xhr.onerror = function () {
        console.error("Request failed");
      };
      xhr.send(formData);
    }
  });
  