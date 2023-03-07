/* globals Chart:false, feather:false */


(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })




      $jsonArray = array();



  var mysql = require('mysql');

  var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "skipass"
  });

  con.connect(function(err) {
    if (err) throw err;
  //Select all customers and return the result object:
  con.query("SELECT * FROM performance", function (err, result, fields) {
    if (err) throw err;
    console.log(result);
  });
  if ($result->num_rows > 0) {
      //Converting the results into an associative array
      while($row = $result->fetch_assoc()) {
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $row['player'];
        $jsonArrayItem['value'] = $row['wickets'];
        //append the above created object into the main array.
        array_push($jsonArray, $jsonArrayItem);
      }
    }









  // Graphs
  const ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
      'Sunday',
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday'
      ],
      datasets: [{
        data: [
        15339,
        21345,
        18483,
        24003,
        23489,
        24092,
        12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})()






