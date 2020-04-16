//* SIGN IN
function signinCheck() {
    if (!checkEmail(document.getElementById("account").value) && !checkNSS(document.getElementById("account").value)) {
        alert("Identifiant invalide.");
        return false;
    } else return true;
}

//* SIGN UP
function selectType(account) {
    document.getElementById("signup").setAttribute("data-account", account);
    for (const el of document.getElementsByClassName("user")) el.setAttribute("disabled", "");
    for (const el of document.getElementsByClassName("manager")) el.setAttribute("disabled", "");
    if (account === "user") for (const el of document.getElementsByClassName("user")) el.removeAttribute("disabled");
    else if (account === "manager") for (const el of document.getElementsByClassName("manager")) el.removeAttribute("disabled");
}
function signupCheck() {
    if (document.getElementById("signup").getAttribute("data-account") === "user" && !checkNSS(document.getElementById("nss").value)) {
        alert("Numéro de Sécurité Sociale invalide.");
        return false;
    } else return true;
}
