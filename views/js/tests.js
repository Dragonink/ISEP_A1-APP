function updateMargins() {
    const clientHeight = window.innerHeight;
    const mainHeight = document.getElementsByTagName("main")[0].getBoundingClientRect().height;
    const margin = ((1 - 2 * .05) * clientHeight - mainHeight) / 2;
    document.getElementsByTagName("main")[0].style.margin = margin + "px 5vw";
}

function initTests() {
    /** @type {HTMLTableSectionElement} */
    const tbody = document.getElementById("results").getElementsByTagName("tbody")[0];
    /** @type {HTMLTemplateElement} */
    const template = document.getElementById("template-result");
    for (const test of document.body.classList) {
        const clone = template.content.cloneNode(true);
        switch (test) {
            case "freq":
                clone.querySelector("th").textContent = "Fréquence cardiaque";
                break;
            case "temp":
                clone.querySelector("th").textContent = "Température";
                break;
            case "tona":
                clone.querySelector("th").textContent = "Reconnaissance de tonalités";
                break;
            case "stim":
                clone.querySelector("th").textContent = "Réaction à des stimuli visuels";
                break;
            case "colo":
                clone.querySelector("th").textContent = "Mémorisation de couleurs";
                break;
        }
        tbody.appendChild(clone);
    }
    // Continue
    nextTest();
}
function nextTest() {
    // Update description
    const test = document.body.classList.item(0);
    document.body.classList.remove(test);
    switch (test) {
        case "freq":
            document.getElementById("test-icon").src = "images/test_frequence_cardiaque.png";
            document.getElementById("test-title").innerHTML = "Fréquence cardiaque";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre fréquence cardiaque.</br>Pour ce faire, veuillez suivre les étapes suivantes : </br></br>1) Mettre le bout du doigt au niveau de la led allumée </br>2) Appuyer sur le bouton de la carte externe </br>3) Le test est terminé quand la led s’éteint </br>4) L’afficheur affiche votre fréquence cardiaque en hertz";
            break;
        case "temp":
            document.getElementById("test-icon").src = "images/test_temperature.png";
            document.getElementById("test-title").innerHTML = "Température";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à prendre votre température.</br>Pour ce faire, veuillez suivre les étapes suivantes : </br></br>1) Mettre le bout du doigt au niveau du capteur de température </br>2) Appuyer sur le bouton le plus proche </br>3) Le test est terminé quand la led s’éteint </br>4) L’afficheur annonce votre température en degrés celsius";
            break;
        case "tona":
            document.getElementById("test-icon").src = "images/test_tonalite.png";
            document.getElementById("test-title").innerHTML = "Reconnaissance de tonalités";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre capacité de reconnaissance de tonalités.\nPour ce faire, veuillez suivre les étapes suivantes : </br></br>1) Mettre le casque </br>2) Appuyer sur le bouton rouge le plus proche des potentiomètres pour écouter le son </br>3) Réappuyer sur le bouton et rejouer le son que vous avez entendu à l'aide de la voix </br>4) Le test est terminé quand la led s’éteint </br>5) L’afficheur écrit OK si le signal est assez proche et NO sinon";
            break;
        case "stim":
            document.getElementById("test-icon").src = "images/test_visuel.png";
            document.getElementById("test-title").innerHTML = "Réaction à des stimuli visuels";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre temps de réaction à un stimulus visuel.\nPour ce faire, veuillez suivre les étapes suivantes : </br></br>1) Appuyer sur le bouton rouge le plus proche des potentiomètres quand vous êtes prêt </br>2) Attendre que la led s’allume, et quand elle s'allume, appuyer le plus rapidement possible sur un bouton </br>3) L’afficheur renvoie le temps entre le moment où la led s’est allumée et le moment où vous avez appuyé sur le bouton";
            break;
        case "colo":
            document.getElementById("test-icon").src = "images/test_visuel.png";
            document.getElementById("test-title").innerHTML = "Mémorisation de couleurs";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre capacité de mémorisation de teintes colorées.\nPour ce faire, veuillez suivre les étapes suivantes : </br></br>1) Quand vous êtes prêt, appuyer sur le bouton rouge le plus proche des potentiomètres, le jeu commence après 3 clignotements blancs </br>2) Les couleurs s’affichent les unes après les autres et après il faut reproduire les couleurs en appuyant sur les boutons correspondants(le bouton pour la couleur rouge est celui le plus proche des potentiomètre, le vert est juste à côté et le bleu est à côté du vert) </br>3) Le score est affiché si vous avez fait une erreur ou si vous avez eu le score maximale de 20";
            break;
    }
    // Update table
    for (const tr of document.getElementById("results").getElementsByTagName("tbody")[0].children) {
        if (!tr.classList.contains("done")) {
            tr.classList.add("done");
            break;
        }
    }
    // Update margins
    updateMargins();
}
