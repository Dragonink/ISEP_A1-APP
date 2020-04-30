function updateMargins() {
    const clientHeight = window.innerHeight;
    const mainHeight = document.querySelector("main").getBoundingClientRect().height;
    const margin = ((1 - 2 * .05) * clientHeight - mainHeight) / 2;
    document.querySelector("main").style.margin = margin + "px 5vw";
}
function updateDescription(test) {
    switch (test) {
        case "freq":
            document.querySelector("#test-icon").src = "images/test_frequence_cardiaque.png";
            document.querySelector("#test-title").innerHTML = "Fréquence cardiaque";
            document.querySelector("#test-desc").innerHTML = "Ce test consiste à déterminer votre fréquence cardiaque.<br/>Pour ce faire, veuillez suivre les étapes suivantes :<ol><li>Mettre le bout du doigt au niveau de la led allumée</li><li>Appuyer sur le bouton de la carte externe</li><li>Le test est terminé quand la led s’éteint</li><li>L’afficheur affiche votre fréquence cardiaque en hertz</li></ol>";
            break;
        case "temp":
            document.querySelector("#test-icon").src = "images/test_temperature.png";
            document.querySelector("#test-title").innerHTML = "Température";
            document.querySelector("#test-desc").innerHTML = "Ce test consiste à prendre votre température.<br/>Pour ce faire, veuillez suivre les étapes suivantes :<ol><li>Mettre le bout du doigt au niveau du capteur de température</li><li>Appuyer sur le bouton le plus proche</li><li>Le test est terminé quand la led s’éteint</li><li>L’afficheur annonce votre température en degrés celsius</li></ol>";
            break;
        case "tona":
            document.querySelector("#test-icon").src = "images/test_tonalite.png";
            document.querySelector("#test-title").innerHTML = "Reconnaissance de tonalités";
            document.querySelector("#test-desc").innerHTML = "Ce test consiste à déterminer votre capacité de reconnaissance de tonalités.<br/>Pour ce faire, veuillez suivre les étapes suivantes :<ol><li>Mettre le casque</li><li>Appuyer sur le bouton rouge le plus proche des potentiomètres pour écouter le son</li><li>Appuyer à nouveau sur le bouton et rejouer le son que vous avez entendu à l'aide de la voix</li><li>Le test est terminé quand la led s’éteint</li><li>L’afficheur écrit le pourcentage de ressemblance</li></ol>";
            break;
        case "stim":
            document.querySelector("#test-icon").src = "images/test_visuel.png";
            document.querySelector("#test-title").innerHTML = "Réaction à des stimuli visuels";
            document.querySelector("#test-desc").innerHTML = "Ce test consiste à déterminer votre temps de réaction à un stimulus visuel.<br/>Pour ce faire, veuillez suivre les étapes suivantes :<ol></li>Appuyer sur le bouton rouge le plus proche des potentiomètres quand vous êtes prêt</li><li>Attendre que la led s’allume, et quand elle s'allume, appuyer le plus rapidement possible sur un bouton</li><li>L’afficheur renvoie le temps entre le moment où la led s’est allumée et le moment où vous avez appuyé sur le bouton</li></ol>";
            break;
        case "colo":
            document.querySelector("#test-icon").src = "images/test_visuel.png";
            document.querySelector("#test-title").innerHTML = "Mémorisation de couleurs";
            document.querySelector("#test-desc").innerHTML = "Ce test consiste à déterminer votre capacité de mémorisation de teintes colorées.<br/>Pour ce faire, veuillez suivre les étapes suivantes :<ol><li>Quand vous êtes prêt, appuyer sur le bouton rouge le plus proche des potentiomètres, le jeu commence après 3 clignotements blancs</li><li>Les couleurs s’affichent les unes après les autres et après il faut reproduire les couleurs en appuyant sur les boutons correspondants (le bouton pour la couleur rouge est celui le plus proche des potentiomètre, le vert est juste à côté et le bleu est à côté du vert)</li><li>Le score est affiché si vous avez fait une erreur ou si vous avez eu le score maximale de 20</li></ol>";
            break;
    }
}

let testLength = 0;
function nextTest() {
    // Update description
    const test = document.body.classList.item(0);
    document.body.classList.remove(test);
    updateDescription(test);
    // Update table
    if (document.body.classList.length + 1 < testLength) for (const tr of document.querySelector("#results").querySelector("tbody").children) {
        if (!tr.classList.contains("done")) {
            tr.querySelector("td").innerHTML = manualValues[test];
            tr.classList.add("done");
            break;
        }
    }
    // Update margins
    updateMargins();
}
function initTests() {
    // Create tests list
    if (document.body.classList.length === 0) document.body.classList.add("freq", "temp", "tona", "stim", "colo");
    testLength = document.body.classList.length;
    // Update table
    /** @type {HTMLTableSectionElement} */
    const tbody = document.querySelector("#results").querySelector("tbody");
    /** @type {HTMLTemplateElement} */
    const template = document.querySelector("#template-result");
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

/** @type {{[test: string]: null | number}} */
const manualValues = {
    freq: null,
    temp: null,
    tona: null,
    stim: null,
    colo: null
};
function enterValue() {
    manualValues[document.body.classList.item(0)] = Number(document.querySelector("form#input > input[name='value']").value);
    document.querySelector("#input").reset();
    nextTest();
}
