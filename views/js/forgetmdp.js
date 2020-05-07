function selectType() {
    for (const el of document.getElementsByClassName("connexion")) el.setAttribute("disabled", "");
    for (const el of document.getElementsByClassName("forget")) el.removeAttribute("disabled");
}
function hideForget() {
    for (const el of document.getElementsByClassName("forget")) el.setAttribute("disabled", "");
}
