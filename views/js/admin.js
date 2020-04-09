function openChapitre(number) {
    var i, chapitre, choix;
    choix = document.getElementsByClassName("choix");
    for (i=0; i<choix.length;i++) {
        choix[i].style.display="none";
    }
    chapitre = document.getElementsByClassName("chapitre");
    for (i = 0; i < chapitre.length; i++) {
        chapitre[i].className = chapitre[i].className.replace(" actif", "");
    }
    choix[number].style.display = "block";
    chapitre[number].className += " actif";
}
function openReponse(number) {
    document.getElementsByClassName("question")[number-1].style.display="none";
    document.getElementsByClassName("affichage")[number-1].style.display="table-row";
    document.getElementsByClassName("reponse")[number-1].style.display="table-row";
    document.getElementsByClassName("modifier")[number-1].style.display="none";
    document.getElementsByClassName("reponseModifiable")[number-1].style.display="none";
}

function openModification(number) {
    document.getElementsByClassName("question")[number-1].style.display="none";
    document.getElementsByClassName("affichage")[number-1].style.display="none";
    document.getElementsByClassName("reponse")[number-1].style.display="none";
    document.getElementsByClassName("modifier")[number-1].style.display="table-row";
    document.getElementsByClassName("reponseModifiable")[number-1].style.display="table-row";
}

function closeReponse(number) {
    document.getElementsByClassName("question")[number-1].style.display="table-row";
    document.getElementsByClassName("affichage")[number-1].style.display="none";
    document.getElementsByClassName("reponse")[number-1].style.display="none";
    document.getElementsByClassName("modifier")[number-1].style.display="none";
    document.getElementsByClassName("reponseModifiable")[number-1].style.display="none";
}

function openAddDispositif() {
    document.getElementsByClassName("buttonAddDispositif")[0].style.display="none";
    document.getElementsByClassName("addDispositif")[0].style.display="block";
}

function closeAddDispositif() {
    document.getElementsByClassName("buttonAddDispositif")[0].style.display="block";
    document.getElementById("addCode").value="";
    document.getElementById("addProprietaire").value="";
    document.getElementsByClassName("addDispositif")[0].style.display="none";
}

function openRequetes() {
    document.getElementsByClassName("requetes")[0].style.display="block";
}

function openRequete(number) {
    var i, requete, demande;
    requete = document.getElementsByClassName("requete");
    for (i=0; i<requete.length;i++) {
        requete[i].style.display="none";
    }
    demande = document.getElementsByClassName("demande");
    for (i = 0; i < demande.length; i++) {
        demande[i].className = demande[i].className.replace(" actif", "");
    }
    requete[number].style.display = "block";
    demande[number].className += " actif";
}

function closeRequetes() {
    document.getElementsByClassName("requetes")[0].style.display="none";
}

function graphe(){
    let ctx= document.getElementById('graphStats').getContext('2d'); 
    let chart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5'],
            datasets: [{
                label:'nombre de fois où le test a été réalisé',
                backgroundColor: 'rgb(24, 55, 94, 0.86)',
                borderColor: 'rgb(100, 162, 186)',
                data: [10, 100, 507, 234, 267, ]
            }]
        },
    });

    var options = {
        maintainAspectRatio: false,
        responsive : false,
        scales: {
            yAxes: [{
                stacked: true,
                gridLines: {
                    display: true,
                    color: "white"
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    };
}