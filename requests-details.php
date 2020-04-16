<?php include 'inc.header.php'; ?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Request details per User</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-secondary">
            <span data-feather="calendar"></span> last 14 days
          </button>
        </div>
      </div>




<?php 
// get connection details
require_once dirname(__FILE__)."/../dbconnect/readonly.php";
// connect to mysql db
try{ $db = new PDO('mysql:host='.MYSQLHOST.';dbname=spamty_api', MYSQLUSER, MYSQLPASS); }
catch(PDOException $e){ exit("Error while connecting to database."); }


// get list of API users
$dbQuery = $db->prepare("SELECT * FROM `apikeys`");
$dbQuery->execute($dbExecData);
$dbAPIuser = $dbQuery->fetchAll(PDO::FETCH_ASSOC);


// last 14 days:
$displayDates = date("Ymd", time() - 60*60*24 *13);

// count for each API user
$graphData = array();

foreach( $dbAPIuser as $userCur ){
	$dbQuery = $db->prepare("SELECT COUNT(*) FROM `tracking` WHERE `user` = '".$userCur['user']."' AND `date` >= ".$displayDates);
	$dbQuery->execute($dbExecData);
	$dbD = $dbQuery->fetch(PDO::FETCH_BOTH);
	$graphData[$userCur['user']] = $dbD[0];

}

?>





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
    type: 'bar',
    data: {
      labels: [
	<?php foreach( $dbAPIuser as $userCur ){
		echo "'".$userCur['user']."',";
	} ?>
      ],
      datasets: [{
        data: [
	<?php foreach( $graphData as $graphCur ){
		echo $graphCur.",";
	} ?>
        ],
	label: 'total requests',
        lineTension: 0,
        backgroundColor: '#007bff',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      legend: {
        display: false
      }
    }
  })
}())

</script>







      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Info about Users</h2>
      </div>


      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>user</th>
              <th>userName</th>
              <th>userEmail</th>
              <th>userWebsite</th>
              <th>notes</th>
              <th>Total requests:</th>
            </tr>
          </thead>
          <tbody>

<?php
  foreach( $dbAPIuser as $userCur ){
?>
            <tr>
              <td><?php echo $userCur['user']; ?></td>
              <td><?php echo $userCur['userName']; ?></td>
              <td><?php echo $userCur['userEmail']; ?></td>
              <td><?php echo $userCur['userWebsite']; ?></td>
              <td><?php echo $userCur['notes']; ?></td>
              <td><?php echo $graphData[$userCur['user']]; ?></td>
            </tr>
<?php
  }
?>

          </tbody>
        </table>
      </div>






<?php include 'inc.footer.php'; ?>
