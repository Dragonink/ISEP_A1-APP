function selectType(account) {
    document.getElementById("signup").setAttribute("data-account", account);
    for (const el of document.getElementsByClassName("user")) el.setAttribute("disabled", "");
    for (const el of document.getElementsByClassName("manager")) el.setAttribute("disabled", "");
    if (account === "user") for (const el of document.getElementsByClassName("user")) el.removeAttribute("disabled");
    else if (account === "manager") for (const el of document.getElementsByClassName("manager")) el.removeAttribute("disabled");
}
