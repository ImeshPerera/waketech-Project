function AlertDanger(msg) {
    if (msg == null) {
        msg = "Something Went Wrong. Report To Admin";
    }
    document.getElementById("alertnobtn").classList.add("d-none");
    document.getElementById("alertnobox").classList.remove("d-none");
    document.getElementById("alertnoline").innerHTML = msg;
}

function AlertSuccess(msg) {
    if (msg == null) {
        msg = "Something Happend. Report To Admin";
    }
    document.getElementById("alertokbtn").classList.add("d-none");
    document.getElementById("alertokbox").classList.remove("d-none");
    document.getElementById("alertokline").innerText = msg;
}

function alertDangerclose() {
    var alertnobox = document.getElementById("alertnobox");
    alertnobox.classList.add("d-none");
}

function alertSuccessclose() {
    var alertokbox = document.getElementById("alertokbox");
    alertokbox.classList.add("d-none");
}

function ApplyAlertBtn(btnid, where, line, color) {
    var alertbtn = document.getElementById(btnid);
    alertbtn.classList.remove("d-none");
    alertbtn.classList.add(color);
    alertbtn.setAttribute('href', where);
    alertbtn.innerHTML = line;
}

function viewPassword() {

    var password = document.getElementById("password");
    var passwordbtn = document.getElementById("passwordbtn");

    passwordbtn.classList.toggle("bi-eye");
    passwordbtn.classList.toggle("bi-eye-slash");

    if (password.type == "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}