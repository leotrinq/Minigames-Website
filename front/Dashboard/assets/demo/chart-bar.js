// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Load ranking data from CSV file
fetch('data.csv')
  .then(response => response.text())
  .then(text => {
    // Parse CSV data
    const rows = text.split('\n');
    const games = [];
    const playerRanks = {};

    // Extract games and player ranks from CSV data
    rows.forEach((row, rowIndex) => {
      const values = row.split(',');
      if (rowIndex === 0) {
        // First row contains games
        values.slice(0).forEach((game, index) => {
          if (index % 3 === 0) { // Only display every third game
            games.push(game);
          }
        });
      } else {
        // Other rows contain player ranks
        const playerName = values[0];
        values.slice(1).forEach((rank, index) => {
          const gameIndex = Math.floor(index / 3); // Get game index for this rank
          if (!playerRanks[playerName]) {
            playerRanks[playerName] = {};
          }
          playerRanks[playerName][games[gameIndex]] = parseInt(rank, 10);
        });
      }
    });

    // Create data labels and datasets for chart
    const labels = games;
    const datasets = [];
    const datasets2 = [];

    const playerName = Object.keys(playerRanks)[0];
    const playerName2 = Object.keys(playerRanks)[1];
    const playerName3 = Object.keys(playerRanks)[2];
    const color_cd = `rgba(${215},${125},${128},1)`;
    const color_timer = `rgba(${113},${211},${167},1)`;
    const color_QTE = `rgba(${172},${158},${201},1)`;
    const backgroundColor = [color_cd,color_timer,color_QTE]
    const borderColor = `rgba(${51},${51},${51},1)`;
    const data = [games.map(game => playerRanks[playerName][game]),games.map(game => playerRanks[playerName2][game]),games.map(game => playerRanks[playerName3][game])];
    datasets.push({
      label: "Rank",
      backgroundColor,
      borderColor,
      borderWidth: 1,
      data,
    });
  

    // Create chart
    const ctx = document.getElementById("myBarChart");
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Countdown", "Timer", "QTE"],
        datasets,
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'game',
            },
            gridLines: {
              display: false,
            },
            ticks: {
              maxTicksLimit: 3,
            },
          }],
          yAxes: [{
            ticks: {
              min: 1,
              max: 250,
              maxTicksLimit: 10,
            },
            gridLines: {
              display: true,
            },
          }],
        },
        legend: {
          display: false,
        },
      },
    });
  })
  .catch(error => console.error(error));
