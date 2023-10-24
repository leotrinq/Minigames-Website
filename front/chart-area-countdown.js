// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Récupérer le fichier .csv avec fetch()
fetch("data.csv")
  .then(response => response.text())
  .then(data1 => {
    // Analyser les données CSV
    var tab = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    let lignes = data1.split('\n');
    // parcours de toutes les lignes du fichier
    for(let i = 0; i < lignes.length; i++) {
      let valeurs = lignes[i].split(',');
      let valeur = parseFloat(valeurs[2]);
      let game = valeurs[1]
      // ajout de 1 à la première case du tableau si la valeur est inférieure à 0.2
      if (game == 1 && valeur < 0.1) {
        tab[0]++;
      }
      // ajout de 1 à la deuxième case du tableau si la valeur est égale à 0.4
      else if (game == 1 && valeur < 0.3) {
        tab[1]++;
      }
      // ajout de 1 à la troisième case du tableau si la valeur est supérieure à 2
      else if (game == 1 && valeur < 0.5) {
        tab[2]++;
      }
      else if (game == 1 && valeur < 0.7) {
        tab[3]++;
      }
      else if (game == 1 && valeur < 0.9) {
        tab[4]++;
      }
      else if (game == 1 && valeur < 1.1) {
        tab[5]++;
      }
      else if (game == 1 && valeur < 1.3) {
        tab[6]++;
      }
      else if (game == 1 && valeur < 1.5) {
        tab[7]++;
      }
      else if (game == 1 && valeur < 1.7) {
        tab[8]++;
      }
      else if (game == 1 && valeur < 1.9) {
        tab[9]++;
      }
      else if (game == 1 && valeur < 2.1) {
        tab[10]++;
      }
      else if (game == 1 && valeur < 2.3) {
        tab[11]++;
      }
      else if (game == 1 && valeur < 2.5) {
        tab[12]++;
      }
      else if (game == 1 && valeur < 2.7) {
        tab[13]++;
      }
      else if (game == 1 && valeur < 2.9) {
        tab[14]++;
      }
      else if (game == 1) {
        tab[15]++;
      }
    }
    const datasets = [];

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["0", "0.2", "0.4", "0.6", "0.8", "1", "1.2", "1.4", "1.6", "1.8", "2", "2.2", "2.4", "2.6", "2.8", "3"],
    datasets: [{
      label: "Number",
      lineTension: 0.3,
      backgroundColor: "rgba(0,0,0,0.2)",
      borderColor: "rgba(0,0,0,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(0,0,0,1)",
      pointBorderColor: "rgba(0,0,0,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(0,0,0,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [tab[0], tab[1], tab[2], tab[3], tab[4], tab[5], tab[6], tab[7], tab[8], tab[9], tab[10], tab[11], tab[12], tab[13], tab[14], tab[15]],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 10
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 30,
          maxTicksLimit: 10
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

})
.catch(error => console.error(error));