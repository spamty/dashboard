<?php include 'inc.header.php'; ?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">API Errors</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
           <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
           </button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary">Filter</button>
        </div>
      </div>



<pre><code>SELECT * FROM `tracking` WHERE `statusReturned` != '1' AND `statusReturned` != '200'</code></pre>

<?php

// get connection details
require_once dirname(__FILE__)."/../dbconnect/readonly.php";
// connect to mysql db
try{ $db = new PDO('mysql:host='.MYSQLHOST.';dbname=spamty_api', MYSQLUSER, MYSQLPASS); }
catch(PDOException $e){ exit("Error while connecting to database."); }

// prepare search query
$dbSearchQuery = "SELECT * FROM `tracking` WHERE `statusReturned` != '1' AND `statusReturned` != '200'";
if( !empty($_GET['api'])){ $dbSearchQuery=$dbSearchQuery." AND `api` = :api"; }
if( !empty($_POST['version'])){ $dbSearchQuery=$dbSearchQuery." AND `version` = :version"; }
if( !empty($_POST['user'])){ $dbSearchQuery=$dbSearchQuery." AND `user` = :user"; }
if( !empty($_POST['user'])){ $dbSearchQuery=$dbSearchQuery." AND `IP` = :IP"; }
if( !empty($_POST['user'])){ $dbSearchQuery=$dbSearchQuery." AND `statusReturned` = :status"; }
print_r($dbSearchQuery);

// get data from db
$dbQuery = $db->prepare($dbSearchQuery);
$dbExecData = array(
	":api" => $_GET['api'],
	":version" => $_POST['version'],
	":user" => $_POST['user'],
	":IP" => $_POST['IP'],
	":status" => $_POST['status']
);
$dbQuery->execute($dbExecData);
$dbD = $dbQuery->fetchAll(PDO::FETCH_ASSOC);

// The db data we get:  $dbD = 
//  Array ( [0] => Array ( [api] => D [version] => 5 [user] => d_441230 [apiKey] => 9d7dde843523476f1f3d7de92 [date] => 20190430 [time] => 193816 [IP] => 678.123.345.000 [statusReturned] => 0 [detailsReturned] => Invalid value for k. [additional] => ) [1] => Array... )

if( empty($dbD) ){ echo "No data found in database."; }

?>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>date</th>
              <th>time</th>
              <th>api</th>
              <th>version</th>
              <th>user</th>
              <th>IP</th>
              <th>status</th>
              <th>detailsReturned</th>
            </tr>
          </thead>
          <tbody>
            <tr>
	      <form>
              <td>-</td>
              <td>-</td>
              <td><input type="text" class="form-control form-control-sm" placeholder="api"></td>
              <td><input type="text" class="form-control form-control-sm" placeholder="version"></td>
              <td><input type="text" class="form-control form-control-sm" placeholder="user"></td>
              <td><input type="text" class="form-control form-control-sm" placeholder="IP"></td>
              <td><input type="text" class="form-control form-control-sm" placeholder="status"></td>
              <td><input type="submit" class="btn btn-sm btn-outline-secondary" value="Filter"></td>
              </form>
            </tr>

<?php
  foreach ( $dbD as $dbValue ){ 
?>
            <tr>
              <td><?php echo $dbValue['date']; ?></td>
              <td><?php echo $dbValue['time']; ?></td>
              <td><?php echo $dbValue['api']; ?></td>
              <td><?php echo $dbValue['version']; ?></td>
              <td><?php echo $dbValue['user']; ?></td>
              <td><?php echo $dbValue['IP']; ?></td>
              <td><?php echo $dbValue['statusReturned']; ?></td>
              <td><?php echo $dbValue['detailsReturned']; ?></td>
            </tr>
<?php
  }
?>

          </tbody>
        </table>
      </div>




<?php include 'inc.footer.php'; ?>
