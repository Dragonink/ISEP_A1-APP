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
            case "temp":
                clone.querySelector("th").textContent = "Température";
                break;
            case "freq":
                clone.querySelector("th").textContent = "Fréquence cardiaque";
                break;
            case "tona":
                clone.querySelector("th").textContent = "Reconnaissance de tonalités";
                break;
            case "colo":
                clone.querySelector("th").textContent = "Mémorisation de couleurs";
                break;
            case "stim":
                clone.querySelector("th").textContent = "Réaction à des stimuli visuels";
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
        case "temp":
            document.getElementById("test-icon").src = "images/test_temperature.png";
            document.getElementById("test-title").innerHTML = "Température";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à prendre votre température.\nPour ce faire, il vous suffit de poser votre doigt sur le capteur, situé … sur votre appareil, et de rester immobile 10 secondes.";
            break;
        case "freq":
            document.getElementById("test-icon").src = "images/test_frequence_cardiaque.png";
            document.getElementById("test-title").innerHTML = "Fréquence cardiaque";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre fréquence cardiaque.\nPour ce faire, il faut mettre votre doigt entre le capteur et la LED blanche, situés tous les deux … sur votre appareil, et de rester immobile 10 secondes.";
            break;
        case "tona":
            document.getElementById("test-icon").src = "images/test_tonalite.png";
            document.getElementById("test-title").innerHTML = "Reconnaissance de tonalités";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre capacité de reconnaissance de tonalités.\nPour ce faire, vous allez mettre le casque situé à côté de vous. Puis, vous allez entendre un son. Votre objectif est de reproduire ce son, dans le micro, avec votre voix.";
            break;
        case "colo":
            document.getElementById("test-icon").src = "images/test_visuel.png";
            document.getElementById("test-title").innerHTML = "Mémorisation de couleurs";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre capacité de mémorisation de teintes colorées.\nPour ce faire, la LED colorée, située sur votre appareil, va s’allumer successivement de couleurs différentes (rouge, vert, bleu). Votre objectif est de reproduire cette suite colorée dans le bon ordre, en appuyant sur les boutons correspondants.";
            break;
        case "stim":
            document.getElementById("test-icon").src = "images/test_visuel.png";
            document.getElementById("test-title").innerHTML = "Réaction à des stimuli visuels";
            document.getElementById("test-desc").innerHTML = "Ce test consiste à déterminer votre temps de réaction à un stimulus visuel.\nPour ce faire, la LED colorée, située sur votre appareil, va s’allumer. Votre objectif est d’appuyer de plus rapidement possible sur un bouton.";
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
