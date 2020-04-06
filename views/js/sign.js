function signinCheck() {
    if (!/\S+@\S+\.\S+|[1-2]\d{2}(?:0[1-9]|1[0-2])\d{2}\d{3}\d{3}/i.test(document.getElementById("account").value)) {
        alert("Identifiant invalide.");
        return false;
    } else return true;
}

function disableSignupFields() {

}
function signupCheck() {

}
