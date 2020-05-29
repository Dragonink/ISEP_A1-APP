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


function dernierTest(datas,labels, max1, max2){
    new RGraph.Bar({
        id: 'resultatDernierTestGraph',
        data: datas,
        options: {
            xaxisLabels:labels,
            marginLeft: 35,
            colors: ['#18375e'],
            yaxisScale: false,
            xaxis: false,
            yaxis: false,
        }
    }).draw();
    new RGraph.Drawing.YAxis({
        id: 'resultatDernierTestGraph',
        x: 765,
        options: {
            textSize: 12,
            yaxisScaleMax: max2,
            yaxisPosition: 'right',
            yaxisScaleUnitsPre: '',
            yaxisColor: 'blue',
        }
    }).draw();
    new RGraph.Drawing.YAxis({
        id: 'resultatDernierTestGraph',
        x: 35,
        options: {
            textSize: 12,
            yaxisScaleMax: max1,
            yaxisPosition: 'left',
            yaxisScaleUnitsPre: ' ',
            yaxisColor: 'red',
        }
    }).draw();
}

function resultatTest(choix, data, label, key, unit, max1, max2) {
    if (choix == '0') {
        new RGraph.Line({
            id: 'resultatTestGraph',
            data: data,
            options: {
                tickmarksStyle: 'filledcircle',
                tickmarksSize: 5,
                xaxisLabels:label,
                marginLeft: 35,
                colors: color,
                key: key,
                yaxisScale: false,
                xaxis: false,
                yaxis: false,
            }
        }).draw();
        new RGraph.Drawing.YAxis({
            id: 'resultatTestGraph',
            x: 1265,
            options: {
                textSize: 12,
                yaxisScaleMax: max2,
                yaxisPosition: 'right',
                yaxisScaleUnitsPre: '',
                yaxisColor: 'blue',
            }
        }).draw();
        new RGraph.Drawing.YAxis({
            id: 'resultatTestGraph',
            x: 35,
            options: {
                textSize: 12,
                yaxisScaleMax: max1,
                yaxisPosition: 'left',
                yaxisScaleUnitsPre: ' ',
                yaxisColor: 'red',
            }
        }).draw();
    } else {
        new RGraph.Bar({
            id: 'resultatTestGraph',
            data: data,
            options: {
                tooltips: '%{property:myDaynames[%{index}]}<span style="font-weight: bold; font-size:26pt">%{value_formatted}</span>',
                tooltipsFormattedUnitsPost: unit,
                tooltipsCss: {
                    backgroundColor: 'white',
                    border: '1px solid black'
                },
                shadow: false,
                keyPositionGraphBoxed: false,
                xaxisLabels:label,
                marginLeft: 35,
                colors: ['#18375e'],
            }
        }).draw();
    }
}

function graphe(critere, type, datas, labels, keys, unit) {
    if (critere == '0') {
        if (type == '0'){
            new RGraph.Pie({
                id: 'grapheResultat',
                data: datas,
                options: {
                    tooltips: '%{property:myDaynames[%{index}]}<span style="font-weight: bold; font-size:26pt">%{value_formatted}</span>',
                    tooltipsCss: {
                        backgroundColor: 'white',
                        border: '1px solid black'
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
                    tooltips: '%{property:myDaynames[%{index}]}<span style="font-weight: bold; font-size:26pt">%{value_formatted}</span>',
                    tooltipsFormattedUnitsPost: unit,
                    tooltipsCss: {
                        backgroundColor: 'white',
                        border: '1px solid black'
                    },
                    shadow: false,
                    keyPositionGraphBoxed: false,
                    xaxisLabels:labels,
                    marginLeft: 35,
                    marginInner: 10,
                    marginInnerGrouped: 1,
                    colors: ['#18375e'],
                }
            }).draw();
        }
    } else {
        if (type == '0'){
            new RGraph.Bar({
                id: 'grapheResultat',
                data: datas,
                options: {
                    tooltips: '%{property:myDaynames[%{index}]}<span style="font-weight: bold; font-size:26pt">%{value_formatted}</span>',
                    tooltipsFormattedUnitsPost: unit,
                    tooltipsCss: {
                        backgroundColor: 'white',
                        border: '1px solid black'
                    },
                    shadow: false,
                    keyPositionGraphBoxed: false,
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
                    tooltips: '%{property:myDaynames[%{index}]}<span style="font-weight: bold; font-size:26pt">%{value_formatted}</span>',
                    tooltipsFormattedUnitsPost: unit,
                    tooltipsCss: {
                        backgroundColor: 'white',
                        border: '1px solid black'
                    },
                    shadow: false,
                    keyPositionGraphBoxed: false,
                    xaxisLabels:labels,
                    marginLeft: 25,
                    marginInner: 10,
                    marginInnerGrouped: 1,
                    xaxisLabelsOffsety: 10,
                    xaxisLabelsAngle: 25,
                    colors: ['#18375e'],
                }
            }).draw();
        }
    }
}
