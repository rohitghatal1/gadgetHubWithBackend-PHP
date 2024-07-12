document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('registerForm').addEventListener('submit', handleRegister);
    document.getElementById('loginForm').addEventListener('submit', handleLogin);
});

async function handleRegister(e){
    e.preventDefault(); //for preventing default form submission

    const formData = new FormData(this);
    const userData = {
        name: formData.get('name'),
        address: formData.get('address'),
        contact: formData.get('contact'),
        email: formData.get('email'),
        username: formData.get('username'),
        password: formData.get('password'),
        cPassword: formData.get('cPassword')
    };

    if(userData.password !== userData.cPassword){
        alert("Password do not match!!!");
        return
    }

    const response = await fetch('/gadgetHubWithBackend/backend/userRegistration.php',{
        method : 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(userData)
    });

    const result = await response.json();

    alert(result.message);
}

async function handleLogin(e){
    e.preventDefault();

    const fomrData = new fomrData(this);
    const loginCredentials = {
        username: formData.get('username'),
        password: formData.get('password')
    };

    const response = await fetch('/gadgetHubWithBackend//backend/userLogin.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(loginCredentials)
    });

    const result = await response.json();

    if(result.success){
        alert("Login successful");
    }
    else{
        alert(result.message);
    }
}