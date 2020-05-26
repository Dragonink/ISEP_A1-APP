var color = ['red', 'yellow', 'green', 'blue', 'purple'];

function openExamen(userId, userFirst, userLast) {
    document.querySelector("div.examen form input[name='user']").value = userId;
    document.querySelector("div.examen div.personne div:first-of-type").textContent = userFirst;
    document.querySelector("div.examen div.personne div:last-of-type").textContent = userLast;
    document.getElementsByClassName("examen")[0].style.display = "block";
    document.getElementsByClassName("resultatsTests")[0].style.display = "none";
}

function annulerExamen() {
    document.getElementsByClassName("examen")[0].style.display = "none";
    document.getElementsByClassName("resultatsTests")[0].style.display = "block";
}


function dernierTest(datas,labels){
    new RGraph.Bar({
        id: 'resultatDernierTestGraph',
        data: datas,
        options: {
            xaxisLabels:labels,
            marginLeft: 25,
            colors: color,
        }
    }).draw();
}

function resultatTest(choix, data, label, key) {
    if (choix == '0') {
        new RGraph.Line({
            id: 'resultatTestGraph',
            data: data,
            options: {
                xaxisLabels:label,
                marginLeft: 25,
                colors: color,
                key: key,
            }
        }).draw();

    } else {
        new RGraph.Bar({
            id: 'resultatTestGraph',
            data: data,
            options: {
                xaxisLabels:label,
                marginLeft: 25,
                colors: color,
            }
        }).draw();
    }
}

function graphe(critere, type, datas, labels, keys) {
    if (critere == '0') {
        if (type == '0'){
            new RGraph.Pie({
                id: 'grapheResultat',
                data: datas,
                options: {
                    tooltips: '%{property:myDaynames[%{index}]}<br /><span style="font-weight: bold; font-size:26pt">%{value_formatted}</span>',
                    tooltipsFormattedUnitsPost: '%',
                    tooltipsCss: {
                        backgroundColor: 'white',
                        border: '3px solid black'
                    },
                    labels: labels,
                    shadow: false,
                    colors: color,
                    keyPositionGraphBoxed: false,
                }                
            }).draw()
        }else{
            new RGraph.Bar({
                id: 'grapheResultat',
                data: datas,
                options: {
                    xaxisLabels:labels,
                    marginLeft: 25,
                    marginInner: 10,
                    marginInnerGrouped: 1,
                }
            }).draw();
        }
    } else {
        if (type == '0'){
            new RGraph.Bar({
                id: 'grapheResultat',
                data: datas,
                options: {
                    key: keys,
                    keyTextSize: 12,
                    keyPosition: 'margin',
                    backgroundGridVlines: false,
                    backgroundGridBorder: false,
                    shadow: false,
                    xaxisLabels: labels,
                    textSize:10,
                    colorsStroke: 'rgba(0,0,0,0)',
                    marginInner: 10,
                    marginInnerGrouped: 1,
                    yaxis: false,
                    xaxisLabelsOffsety: 10,
                    colors: color,
                    xaxisLabelsAngle: 25
                }
            }).wave();
        }else{
            new RGraph.Bar({
                id: 'grapheResultat',
                data: datas,
                options: {
                    xaxisLabels:labels,
                    marginLeft: 25,
                    marginInner: 10,
                    marginInnerGrouped: 1,
                    xaxisLabelsOffsety: 10,
                    xaxisLabelsAngle: 25
                }
            }).draw();
        }
    }
}
