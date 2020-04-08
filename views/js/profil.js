var color = ['red', 'yellow', 'green', 'blue', 'purple'];

function dernierTest() {
    let ctx = document.getElementById('resultatDernierTestGraph').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5'],
            datasets: [{
                label: 'Résultat lors du dernier test',
                backgroundColor: color,
                data: [20, 50, 75, 80, 10]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

function resultatTest(select) {
    var select = document.getElementById("choix").value;
    let ctx = document.getElementById('resultatTestGraph').getContext('2d');
    var color = ['red', 'yellow', 'green', 'blue', 'purple'];
    var dateRealisation = [new Date(2020, 11, 01), new Date(2020, 11, 02), new Date(2020, 11, 03), new Date(2020, 11, 04), new Date(2020, 11, 07)];
    if (select == '0') {
        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dateRealisation,
                datasets: [{
                    label: 'Test 1',
                    data: [20, 50, 75, 80, 10],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color[0],
                }, {
                    label: 'Test 2',
                    data: [30, 60, 65, 90, 0],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color[1],
                }, {
                    label: 'Test 3',
                    data: [30, 60, 65, 90, 0],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color[2],
                }, {
                    label: 'Test 4',
                    data: [30, 60, 65, 90, 0],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color[3],
                }, {
                    label: 'Test 5',
                    data: [30, 60, 65, 90, 0],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color[4],
                }],
            },
        });
    } else {
        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dateRealisation,
                datasets: [{
                    label: 'Test ' + select,
                    data: [20, 50, 75, 80, 10],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color[select - 1],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
}
