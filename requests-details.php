<?php include 'inc.header.php'; ?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Request details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-secondary">
            <span data-feather="calendar"></span>
            From 20200415 to 20200415
          </button>
        </div>
      </div>


<pre><code>xxxxSELECT COUNT(*) FROM `tracking` WHERE `date` = '20200415'  AND (`statusReturned` != '1' AND `statusReturned` != '200')</code></pre>
<pre><code>xxxxSELECT COUNT(*) FROM `tracking` WHERE `date` = '20200415'  AND (`statusReturned` =  '1' OR  `statusReturned` =  '200')</code></pre>


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
        '20190418',
        '20190419',
        '20190420',
        '20190421',
        '20190422'
      ],
      datasets: [{
        data: [
          24,
          27,
          9,
          14,
          15
        ],
	label: 'Successful requests',
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


<?php include 'inc.footer.php'; ?>
