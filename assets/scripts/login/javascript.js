
// change password visibility
document.getElementById("eyeBtn").addEventListener("click", () => {

    let passwordInput = document.getElementById('userPassword');
    let eye = document.querySelector("#eyeBtn img");

    if (passwordInput.type == "password") {
        passwordInput.type = "text";
        eye.src = "../assets/images/login/eye-solid.svg";
    } else {
        passwordInput.type = "password";
        eye.src = "../assets/images/login/eye-slash-solid.svg";
    }
})