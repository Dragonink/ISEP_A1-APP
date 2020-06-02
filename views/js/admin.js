function PHPCall(url) {
    var request;
    if (window.XMLHttpRequest) {
        request = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        request = new ActiveXObject("Msxml2.XMLHTTP");
        if (!request) {
            request = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    if (request) {
        try {
            var tmpURL = url;
            request.open("post", tmpURL, false);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send((tmpURL != null) ? encodeURI(tmpURL) : "");
            return decodeURI(unescape(request.responseText));
        } catch (errv) {
            alert("The system is not working properly, please contact your support." + "\n(" + url + ")");
        }
    }
}

function openChapitre(number) {
    var i, chapitre, choix;
    choix = document.getElementsByClassName("choix");
    for (i = 0; i < choix.length; i++) {
        choix[i].style.display = "none";
    }
    chapitre = document.getElementsByClassName("chapitre");
    for (i = 0; i < chapitre.length; i++) {
        chapitre[i].className = chapitre[i].className.replace(" actif", "");
    }
    choix[number].style.display = "block";
    chapitre[number].className += " actif";
}
function openReponse(number) {
    document.getElementsByClassName("affichageQuestion")[number - 1].style.display = "none";
    document.getElementsByClassName("affichageQuestionReponse")[number - 1].style.display = "block";
    document.getElementsByClassName("affichageModifier")[number - 1].style.display = "none";
}

function openModification(number) {
    document.getElementsByClassName("affichageQuestion")[number - 1].style.display = "none";
    document.getElementsByClassName("affichageQuestionReponse")[number - 1].style.display = "none";
    document.getElementsByClassName("affichageModifier")[number - 1].style.display = "block";
}

function closeReponse(number) {
    document.getElementsByClassName("affichageQuestion")[number - 1].style.display = "block";
    document.getElementsByClassName("affichageQuestionReponse")[number - 1].style.display = "none";
    document.getElementsByClassName("affichageModifier")[number - 1].style.display = "none";
}

function openAddDispositif() {
    document.getElementsByClassName("buttonAddDispositif")[0].style.display = "none";
    document.getElementsByClassName("addDispositif")[0].style.display = "block";
}

function validateAddDispositif(value, recherche) {
    var code = document.getElementById('addCode').value;
    var manager = document.getElementById('addDispositif').value;
    document.getElementById("listeInfoDispositif").innerHTML = PHPCall("/adminRefresh.php?fonction=addDispositif&value=" + value + "&recherche" + recherche + "&code=" + code + "&manager=" + manager);
    closeAddDispositif();
}

function closeAddDispositif() {
    document.getElementsByClassName("buttonAddDispositif")[0].style.display = "block";
    document.getElementById("addCode").value = "";
    document.getElementsByClassName("addDispositif")[0].style.display = "none";
}

function supDispositif(id, value, recherche) {
    document.getElementById("listeInfoDispositif").innerHTML = PHPCall("/adminRefresh.php?fonction=supDispositif&value=" + value + "&recherche" + recherche + "&id=" + id);
}

function rechercheDispositif() {
    var value = document.getElementById('selectDispositif').value;
    var recherche = document.getElementById('admin-search-dispositif').value;
    document.getElementById("listeInfoDispositif").innerHTML = PHPCall("/adminRefresh.php?fonction=dispositif&value=" + value + "&recherche=" + recherche);
}


function openRequetes() {
    document.getElementsByClassName("requetes")[0].style.display = "block";
}

function supUtilisateur(id, origine) {
    document.getElementById("listeInfoUtilisateur").inerrHTML = PHPCall("/adminRefresh.php?fonction=supUtilisateur&id=" + id + "&origine=" + origine);
    document.getElementById("nbUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=nbUtilisateur");
    document.getElementById("addDispositif").inerrHTML = PHPCall("/adminRefresh.php?fonction=listeManager");
}

function rechercheUtilisateur() {
    var value = document.getElementById('selectUtilisateur').value;
    var recherche = document.getElementById('admin-search-utilisateur').value;
    document.getElementById("listeInfoUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=utilisateur&value=" + value + "&recherche=" + recherche);
}

function openRequete(number) {
    var i, demande;
    document.getElementById("requete").innerHTML = PHPCall("/adminRefresh.php?fonction=requete&value=" + number);
    demande = document.getElementsByClassName("demande");
    for (i = 0; i < demande.length; i++) {
        demande[i].className = demande[i].className.replace(" actif", "");
    }
    demande[number].className += " actif";
}

function closeRequetes() {
    document.getElementsByClassName("requetes")[0].style.display = "none";
}

function ajouterQuestion() {
    document.getElementById("questionSup").innerHTML = PHPCall("/adminRefresh.php?fonction=ajoutQuestion");
}

function supQuestion(id) {
    document.getElementsByClassName("listeQuestionsAdmin")[0].innerHTML = PHPCall("/adminRefresh.php?fonction=supQuestion&id=" + id);
}

function modifQuestion(id, number, admin) {
    var question = document.getElementsByClassName('question')[number - 1].value;
    var answer = document.getElementsByClassName('answer')[number - 1].value;
    document.getElementsByClassName("listeQuestionsAdmin")[0].innerHTML = PHPCall("/adminRefresh.php?fonction=modifQuestion&id=" + id + "&question=" + question + "&answer=" + answer + "&admin=" + admin);
}

function closeAddQuestion() {
    document.getElementById("questionSup").innerHTML = "";
}

function rejeter(page, value, recherche, id, origine) {
    if (page == 'requete') {
        document.getElementById("requete").innerHTML = PHPCall("/adminRefresh.php?fonction=rejeter&page=" + page + "&value=" + value + "&recherche=" + recherche + "&id=" + id + "&origine=" + origine);
        document.getElementById("nbRequete").innerHTML = PHPCall("/adminRefresh.php?fonction=nbRequete");
        document.getElementById("nbRequeteAdmin").innerHTML = PHPCall("/adminRefresh.php?fonction=nbRequeteAdmin");
        document.getElementById("nbRequeteManager").innerHTML = PHPCall("/adminRefresh.php?fonction=nbRequeteManager");
    } else if (page == 'utilisateur') {
        document.getElementById("listeInfoUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=rejeter&page=" + page + "&value=" + value + "&recherche=" + recherche + "&id=" + id + "&origine=" + origine);
        document.getElementById("nbUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=nbUtilisateur");
        document.getElementById("addDispositif").inerrHTML = PHPCall("/adminRefresh.php?fonction=listeManager");
    }
}

function validerRequete(value, recherche, id, origine) {
    document.getElementById("requete").innerHTML = PHPCall("/adminRefresh.php?fonction=validerRequete&value=" + value + "&id=" + id + "&origine=" + origine);
    document.getElementById("nbRequete").innerHTML = PHPCall("/adminRefresh.php?fonction=nbRequete");
    document.getElementById("nbRequeteAdmin").innerHTML = PHPCall("/adminRefresh.php?fonction=nbRequeteAdmin");
    document.getElementById("nbRequeteManager").innerHTML = PHPCall("/adminRefresh.php?fonction=nbRequeteManager");
    document.getElementById("listeInfoUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=utilisateur&value=" + value + "&recherche=" + recherche);
    document.getElementById("nbUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=nbUtilisateur");
    document.getElementById("addDispositif").inerrHTML = PHPCall("/adminRefresh.php?fonction=listeManager");
}

function bannir(value, recherche, id, origine) {
    document.getElementById("listeInfoUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=bannir&value=" + value + "&recherche=" + recherche + "&id=" + id + "&origine=" + origine);
    document.getElementById("nbUtilisateur").innerHTML = PHPCall("/adminRefresh.php?fonction=nbUtilisateur");
    document.getElementById("addDispositif").inerrHTML = PHPCall("/adminRefresh.php?fonction=listeManager");
}

function validAjoutQuestion(id) {
    var question = document.getElementById('newQuestion').value;
    var answer = document.getElementById('newAnswer').value;
    document.getElementsByClassName("listeQuestionsAdmin")[0].innerHTML = PHPCall("/adminRefresh.php?fonction=validAjoutQuestion&question=" + question + "&answer=" + answer + "&id=" + id);
}

function openPage(number, page) {
    var i, affichage, page;
    if (page == "dispositif") {
        affichage = document.getElementsByClassName("affichageResultatDispo");
        page = document.getElementsByClassName("pageDispo");
    } else if (page == "utilisateur") {
        affichage = document.getElementsByClassName("affichageResultatUtil");
        page = document.getElementsByClassName("pageUtil");
    }
    for (i = 0; i < affichage.length; i++) {
        affichage[i].style.display = "none";
    }
    for (i = 0; i < page.length; i++) {
        page[i].className = page[i].className.replace(" actif", "");
    }
    affichage[number].style.display = "block";
    page[number].className += " actif";
}

function graphe(datas, labels, hauteur) {
    new RGraph.HBar({
        id: 'graphStats',
        data: datas,
        options: {
            yaxisLabels: labels,
            marginLeft: 95,
            colors: ['#18375e']
        }
    }).draw().responsive([
        {maxWidth: null, width: hauteur}
    ]);
}

function envoieMailValidation(envoi, recev) {
    PHPCall("/adminRefresh.php?fonction=envoieMailValidation&envoi=" + envoi + "&recev=" + recev);
}

function envoieMailAnnulation(envoi, recev) {
    PHPCall("/adminRefresh.php?fonction=envoieMailAnnulation&envoi=" + envoi + "&recev=" + recev);
}
