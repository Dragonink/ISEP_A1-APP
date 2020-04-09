const checkEmail = email => /^\S+@\S+\.\S+$/i.test(email);
const checkNSS = nss => /^[1-2]\d{2}(?:0[1-9]|1[0-2])\d{2}\d{3}\d{3}$/i.test(nss);

function header(){ // mettre en paramétre si l'utilisateur s'est déjà connecté et si on est sur la page accueil (reprendre code accueil.html)
    var html="<div class='menuLogo'><a href='index.html'><img src='../images/Infinite_measures.jpg' height='50px'/></a></div>"
        +"<ul class='menuUtilisateur'>"
            +"<li><!--notifications--><img src='../images/iconSansNotification.png' /></li>"
            +"<li><!-- Prénom-->Prénom</li>"
            +"<li><!-- Nom-->Nom</li>"
            +"<li class='photo'><!-- Photo--><button onClick='openMenuDeroulant()'><img src='../images/iconProfil.jpg' height='50px'/></button></li>"
            +"<ul class='menuDeroulant' style='display: none;'>"
                +"<li><a href='admin.php'> Profil </a></li>"//mettre le profil de l'utilisateur
                +"<li><a href='modifAdmin.html'> Modifier profil </a></li>"//mettre le profil de l'utilisateur
                +"<li> Déconnexion </li>"
            +"</ul>";
        +"</ul>";
    document.getElementById("navHeader").innerHTML = html;
}

function footer(){
    var html="<ul class='footerpage'>"
            +"<li><a href='CGU.html'> CGU </a></li>"
            +"<li><a href='FAQ.html'> FAQ </a></li>"
            +"<li><a href='contact.html'> CONTACT </a></li>"
        +"</ul>"
        +"<div class='logofooter'><img src='../images/logo.png' height='50px' /></div>"
        +"<ul class='networks'>"
            +"<li><a href='https://www.facebook.com/'><img src='../images/facebook.png' height='50px' /></a></li>"
            +"<li><a href='https://www.instagram.com/'><img src='../images/instagram.png' height='50px' /></a></li>"
            +"<li><a href='https://www.linkedin.com/'><img src='../images/linkedin.png' height='50px' /></a></li>"
            +"<li><a href='https://www.twitter.com/'><img src='../images/twitter.png' height='50px' /></a></li>"
        +"</ul>";
    document.getElementById("navFooter").innerHTML = html;
}

function openMenuDeroulant(){
    if (document.getElementsByClassName("menuDeroulant")[0].style.display == "none"){
        document.getElementsByClassName("menuDeroulant")[0].style.display="block";
    } else {
        document.getElementsByClassName("menuDeroulant")[0].style.display="none";
    }
}
