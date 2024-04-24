<?php
// Retrieve user information from the database
$stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $param_id);
$param_id = $_SESSION["user_id"];
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<div class="row justify-content-center">
    <div class="col-12">
    <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Welcome! <?php echo $username?></h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                      <label for="reportrange" class="sr-only">Date Ranges</label>
                      <div id="reportrange" class="px-2 py-2 text-muted">
                        <span class="small"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                      <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row items-align-baseline">
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body mb-n3">
                      <div class="row items-align-baseline h-100">
                        <div class="col-md-6 my-3">
                          <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">Lesson PLans</strong></p>
                          <h3>Нийт боловсруулсан хөтөлбөр <?php echo $lesson_plans_count; ?></h3>
                          <p class="text-muted">There will be Lesson plan count number</p>
                        </div>
                        <div class="col-md-6 my-4 text-center">
                        <div class="chart-box mx-4">
    <div id="radialbarWidget1"></div>
</div>
<script>
    
    var options = {
  chart: {
      height: 250,
      type: 'radialBar',
  },
  series: [0],
  labels: ['Ашигласан'],
}

var chart = new ApexCharts(document.querySelector("#radialbarWidget1"), options);

chart.render();

  
</script>

                          
                        </div>
                        <div class="col-md-6 border-top py-3">
                          <p class="mb-1"><strong class="text-muted">Хөтөлбөр боловсруулах тоо</strong></p>
                          <h4 class="mb-0">300</h4>
                         
                        </div> <!-- .col -->
                        <div class="col-md-6 border-top py-3">
                          <p class="mb-1"><strong class="text-muted">Үлдсэн эрх</strong></p>
                          <h4 class="mb-0">300</h4>
                       
                        </div> <!-- .col -->
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body">
                      <div class="chart-widget mb-2">
                        <div id="barChartWidget"></div>
                      </div>
                      <div class="row items-align-center">
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Нийт анги бүлэг</p>
                          <h6 class="mb-1">0</h6>
                          <p class="text-muted mb-0">засна</p>
                        </div>
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Хэдэн хувь нь ямар анги вэ? Гарч ирэх</p>
                          <h6 class="mb-1">0</h6>
                          <p class="text-muted mb-0">засна</p>
                        </div>
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Chart-аар харуулах</p>
                          <h6 class="mb-1">0</h6>
                          <p class="text-muted mb-0">засна</p>
                        </div>
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body">
                      <div class="d-flex mt-3 mb-4">
                        <div class="flex-fill pt-2">
                          <p class="mb-0 text-muted">Нийт анги бүлэг</p>
                          <h4 class="mb-0">12</h4>
                          <span class="small text-muted">Subjects Chart Гарч ирэх</span>
                        </div>
                        <div class="flex-fill chart-box mt-n2">
                          <div id="barChartWidget"></div>
                        </div>
                      </div> <!-- .d-flex -->
                      <div class="row border-top">
                        <div class="col-md-6 pt-4">
                          <h6 class="mb-0">Аль хичээлийг их боловсруулсан вэ?</h6>
                          <br>
                          <p class="mb-0 text-muted">Math</p>
                          <p class="mb-0 text-muted">Physics</p>
                          <p class="mb-0 text-muted">Chemistry</p>
                        </div>
                        <div class="col-md-6 pt-4">
                          <h6 class="mb-0">Хувиар харуулах</h6><br><br>
                          <p class="mb-0 text-muted">0%</p>
                          <p class="mb-0 text-muted">0%</p>
                          <p class="mb-0 text-muted">0%</p>
                        </div>
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col-md -->
              </div> <!-- .row -->
              <div class="row">
                <!-- Recent Activity -->
                <div class="col-md-12 col-lg-4 mb-4">
                  <div class="card timeline shadow">
                    <div class="card-header">
                      <strong class="card-title">Recent Activity</strong>
                      <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                  </div> <!-- / .card -->
                </div> <!-- / .col-md-6 -->
                <div class="col-md-12 col-lg-8">
                  <div class="card shadow">
                    <div class="card-header">
                      <strong class="card-title">Хэрэглэгчид </strong>
                      <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                    <div class="card-body my-n2">
                      <table class="table table-striped table-hover table-borderless">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all_users as $user_id => $user) : ?>
                <tr>
                    <td><?php echo $user_id + 1; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
            <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- Striped rows -->
              </div> <!-- .row-->
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </div>
</div>
