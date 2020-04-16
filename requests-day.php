<?php include 'inc.header.php'; ?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Requests per Day</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <a href="requests-day.php?range=7" role="button" class="btn btn-sm btn-outline-secondary">
            <span data-feather="calendar"></span> 7 days
          </a>
          <a href="requests-day.php?range=14" role="button" class="btn btn-sm btn-outline-secondary">
            <span data-feather="calendar"></span> 14 days
          </a>
        </div>
      </div>



<?php 
// get connection details
require_once dirname(__FILE__)."/../dbconnect/readonly.php";
// connect to mysql db
try{ $db = new PDO('mysql:host='.MYSQLHOST.';dbname=spamty_api', MYSQLUSER, MYSQLPASS); }
catch(PDOException $e){ exit("Error while connecting to database."); }




// default 7 days:
$displayDates = array();
$displayDates[]= date("Ymd", time());
$displayDates[]= date("Ymd", time() - 60*60*24);
$displayDates[]= date("Ymd", time() - 60*60*24*2);
$displayDates[]= date("Ymd", time() - 60*60*24*3);
$displayDates[]= date("Ymd", time() - 60*60*24*4);
$displayDates[]= date("Ymd", time() - 60*60*24*5);
$displayDates[]= date("Ymd", time() - 60*60*24*6);
// if 14 days:
if( $_GET['range'] == 14 ){
 $displayDates[]= date("Ymd", time() - 60*60*24*7);
 $displayDates[]= date("Ymd", time() - 60*60*24*8);
 $displayDates[]= date("Ymd", time() - 60*60*24*9);
 $displayDates[]= date("Ymd", time() - 60*60*24*10);
 $displayDates[]= date("Ymd", time() - 60*60*24*11);
 $displayDates[]= date("Ymd", time() - 60*60*24*12);
 $displayDates[]= date("Ymd", time() - 60*60*24*13);
}
// The data we have:  $displayDates = 
//  Array ( [0] => 20200416 [1] => 20200415 [2] => 20200414 [3] => 20200413 [4] => 20200412 [5] => 20200411 [6] => 20200410 ) 



// graph data
$graphData = array();

foreach( $displayDates as $displayCur ){
	$dbQuery = $db->prepare("SELECT COUNT(*) FROM `tracking` WHERE `date` = '".$displayCur."' AND (`statusReturned`='1' OR `statusReturned`='200')");
	$dbQuery->execute($dbExecData);
	$dbD = $dbQuery->fetch(PDO::FETCH_BOTH);
	$graphData[$displayCur] = $dbD[0];

}
// The db data we get:  $graphData = 
//   Array ( [20200416] => 14 [20200415] => 22 [20200414] => 9 [20200413] => 24 [20200412] => 7 [20200411] => 3 [20200410] => 14 )

?>



<!-- Chart -->
<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<script>


/* globals Chart:false, feather:false */

(function () {
  'use strict'

  feather.replace()

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
	<?php foreach( $displayDates as $displayCur ){
		echo "'".$displayCur."',";
	} ?>
      ],
      datasets: [{
        data: [
	<?php foreach( $graphData as $graphCur ){
		echo $graphCur.",";
	} ?>
        ],
	label: 'Requests',
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
}())

</script>



<?php include 'inc.footer.php'; ?>
