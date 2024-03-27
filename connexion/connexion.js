
const input = document.querySelector(".input__field");
const inputIcon = document.querySelector(".input__icon");

inputIcon.addEventListener("click", (e) => {
    e.preventDefault();

    const isPassword = input.getAttribute('type') === 'password';
    inputIcon.setAttribute(
        'src', 
        isPassword ?
        '../img/eye-off.svg'
          :
        '../img/eye.svg'
    );

    input.setAttribute(
        'type', 
        isPassword ? 
        'text'
          :
        'password'
    );
});

let loginForm = document.querySelector(".my-form");

loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    console.log('Email:', email.value);
    console.log('Password:', password.value);
});