function header(){ // mettre en paramétre si l'utilisateur s'est déjà connecté
    var html="<div class='menuLogo'><a href='accueil.html'><img src='../images/Infinite_measures.jpg' height='50px'/></a></div>"
        +"<ul class='menuUtilisateur'>"
            +"<li><!--notifications--><img src='../images/iconSansNotification.png' /></li>"
            +"<li><!-- Prénom-->Prénom</li>"
            +"<li><!-- Nom-->Nom</li>"
            +"<li class='photo'><!-- Photo--><img src='../images/iconProfil.jpg' height='50px'/></li>"
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