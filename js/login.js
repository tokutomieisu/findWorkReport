function pushHideButton() {
    var txtPass = document.getElementById("textPassword");
    var btnEye = document.getElementById("buttonEye");
    if (txtPass.type === "text") {
        txtPass.type = "password";
        txtPass.style.fontSize = "45px"
        btnEye.className = "fa fa-eye";
    } else {
        txtPass.type = "text";
        txtPass.style.fontSize = "28px"
        btnEye.className = "fa fa-eye-slash";
    }
}

window.addEventListener('load', pushHideButton());