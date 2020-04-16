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
              <th>statusDetails</th>
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
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>dolor</td>
              <td>dolor</td>
              <td>sit</td>
              <td>dolor</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>dolor</td>
              <td>dolor</td>
              <td>dolor</td>
              <td>elit</td>
            </tr>

          </tbody>
        </table>
      </div>




<?php include 'inc.footer.php'; ?>
