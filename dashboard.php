<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // Redirect to the login page or display an error message
  header("Location: auth/login.php");
  exit;
}


$successMessage = "";
if (!empty($_SESSION['success_msg'])) {
  $successMessage = $_SESSION['success_msg'];
  unset($_SESSION['success_msg']); // Clear the success message from the session
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Title -->
  <title>Charpeg Restaurant</title>

  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="../favicon.ico"> -->

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="assets/css/vendor.min.css">

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="assets/css/theme.minc619.css?v=1.0">

  <link rel="preload" href="assets/css/theme.min.css" data-hs-appearance="default" as="style">
  <link rel="preload" href="assets/css/theme-dark.min.css" data-hs-appearance="dark" as="style">

  <link rel="stylesheet" href="css/navbar.css">


  <style data-hs-appearance-onload-styles>
    * {
      transition: unset !important;
    }

    body {
      opacity: 0;
    }
  </style>

  <style>
    .main-container {
      margin-top: 5rem;
    }
  </style>

  <!-- upper script -->
  <script src="script.js"></script>

</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl   footer-offset">

  <script src="assets/js/hs.theme-appearance.js"></script>

  <!-- ========== HEADER ========== -->
  <!-- upper navbar -->
  <header>

    <a href="#" class="logo"><img src="images/logo-img.png" alt=""></a>

    <div id="menu-bar" class="fas fa-hamburger"></div>

    <nav class="navbar">
      <ul>

        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="transaction.php">Transaction</a></li>
        <li><a href="#">About</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>

  </header>

  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <!-- Navbar Vertical -->




  <!-- main content -->
  <main id="content" role="main" class="main-container">
    <!-- Content -->
    <div class="content container-fluid">
      <!-- alerting successful login -->
      <div class="alert-msg"><?php echo $successMessage; ?></div>


      <!-- Stats -->
      <div class="row">




        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100">
            <div class="card-body">
              <h6 class="card-subtitle">icon</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-12">
                </div>
              </div>
              <div class="col-12">
                <h1 class="card-title text-inherit mb-2">256</h1>
              </div>
              Items in Stock
              <div class="text-danger short-note border-top mb-0 align-items-center text-center p-1 ">Total item in stock</div>
            </div>
          </a>
          <!-- End Card -->
        </div>
        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100">
            <div class="card-body">
              <h6 class="card-subtitle">icon</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-12">
                </div>
              </div>
              <div class="col-12">
                <h1 class="card-title text-inherit mb-2">GHC 5,656</h1>
              </div>
              Today's total sales
              <div class="text-success short-note border-top mb-0 align-items-center text-center p-1 ">Number of Items sold today</div>
            </div>
          </a>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100">
            <div class="card-body">
              <h6 class="card-subtitle">icon</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-12">
                </div>
              </div>
              <div class="col-12">
                <h1 class="card-title text-inherit mb-2">56</h1>
              </div>
              Total transactions
              <div class="text-info short-note border-top mb-0 align-items-center text-center p-1 ">All time total transactions</div>
            </div>
          </a>
          <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
          <!-- Card -->
          <a class="card card-hover-shadow h-100">
            <div class="card-body">
              <h6 class="card-subtitle">icon</h6>

              <div class="row align-items-center gx-2 mb-1">
                <div class="col-12">
                </div>
              </div>
              <div class="col-12">
                <h1 class="card-title text-inherit mb-2">GHC 5,656</h1>
              </div>
              Total Earnings till Date
              <div class="text-muted short-note border-top align-items-center text-center p-1 ">All time total earnings</div>
            </div>
          </a>
          <!-- End Card -->
        </div>
      </div>
      <!-- End Stats -->



      <!-- Card -->
      <div class="card h-100 shadow-none">
        <!-- Header -->
        <div class="card-header card-header-content-sm-between">
          <h4 class="card-header-title mb-2 mb-sm-0">Monthly Earnings (2023)</h4>


        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">

          <!-- End Row -->

          <!-- Bar Chart -->
          <div class="chartjs-custom">
            <canvas id="updatingBarChart" style="height: 20rem;" data-hs-chartjs-options='{
                "type": "bar",
                "data": {
                  "labels": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                  "datasets": [{
                    "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220, 300, 100],
                    "backgroundColor": "#377dff",
                    "hoverBackgroundColor": "#377dff",
                    "borderColor": "#377dff",
                    "maxBarThickness": "40"
                  }
                 ]
                },
                "options": {
                  "scales": {
                    "y": {
                      "grid": {
                        "color": "#e7eaf3",
                        "drawBorder": false,
                        "zeroLineColor": "#e7eaf3"
                      },
                      "ticks": {
                        "beginAtZero": true,
                        "stepSize": 100,
                        "fontSize": 12,
                        "fontColor":  "#97a4af",
                        "fontFamily": "Open Sans, sans-serif",
                        "padding": 10,
                        "postfix": "GHC"
                      }
                    },
                    "x": {
                      "grid": {
                        "display": false,
                        "drawBorder": false
                      },
                      "ticks": {
                        "fontSize": 12,
                        "fontColor":  "#97a4af",
                        "fontFamily": "Open Sans, sans-serif",
                        "padding": 5
                      },
                      "categoryPercentage": 0.5,
                      "maxBarThickness": "10"
                    }
                  },
                  "cornerRadius": 2,
                  "plugins": {
                    "tooltip": {
                      "prefix": "GHC ",
                      "hasIndicator": true,
                      "mode": "index",
                      "intersect": false
                    }
                  },
                  "hover": {
                    "mode": "nearest",
                    "intersect": true
                  }
                }
              }'></canvas>
          </div>
          <!-- End Bar Chart -->
        </div>
        <!-- End Body -->
      </div>
      <!-- End Card -->

      <br class="visible-xs">
      <br class="visible-xs">


      <div class="row">
        <div class="col-lg-3">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp;High in Demand</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->
        <div class="col-lg-3">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="py-2 bg-dark text-light">&nbsp;&nbsp;Low in demand</div>
            <div class="table-responsive">
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->

        <div class="col-lg-3">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp;Highest Earning</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->

        <div class="col-lg-3">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp;Lowest Earning</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->

      </div>
      <!-- end of row -->
      <br class="visible-xs">
      <br class="visible-xs">


      <div class="row">
        <div class="col-lg-6">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp; Daily transactions</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->

        <div class="col-lg-6">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp; Transactions by days</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->
      <br class="visible-xs">
      <br class="visible-xs">

      <div class="row">
        <div class="col-lg-6">
          <!-- border-radius for the TH -->

          <div class="card overflow-hidden">

            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp;Transaction by months</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->

        <div class="col-lg-6">
          <!-- border-radius for the TH -->
          <div class="card overflow-hidden">
            <div class="table-responsive">
              <div class="py-2 bg-dark text-light">&nbsp;&nbsp;Transaction by years</div>
              <table class="table table-borderless table-thead-bordered table-nowrap table-text-center table-align-middle card-table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 2rem;">SN</th>
                    <th scope="col">Mode of payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10</td>
                    <td>159</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- end of col -->
      </div>
      <!-- end of row -->



    </div>


  </main>


  <!-- End Navbar Vertical -->







  <script>
    (function() {
      localStorage.removeItem('hs_theme')

      window.onload = function() {



        // INITIALIZATION OF CHARTJS
        // =======================================================
        HSCore.components.HSChartJS.init('.js-chart')


        // INITIALIZATION OF CHARTJS
        // =======================================================
        HSCore.components.HSChartJS.init('#updatingBarChart')
        const updatingBarChart = HSCore.components.HSChartJS.getItem('updatingBarChart')



        // INITIALIZATION OF CHARTJS
        // =======================================================
        HSCore.components.HSChartJS.init('.js-chart-datalabels', {
          plugins: [ChartDataLabels],
          options: {
            plugins: {
              datalabels: {
                anchor: function(context) {
                  var value = context.dataset.data[context.dataIndex];
                  return value.r < 20 ? 'end' : 'center';
                },
                align: function(context) {
                  var value = context.dataset.data[context.dataIndex];
                  return value.r < 20 ? 'end' : 'center';
                },
                color: function(context) {
                  var value = context.dataset.data[context.dataIndex];
                  return value.r < 20 ? context.dataset.backgroundColor : context.dataset.color;
                },
                font: function(context) {
                  var value = context.dataset.data[context.dataIndex],
                    fontSize = 25;

                  if (value.r > 50) {
                    fontSize = 35;
                  }

                  if (value.r > 70) {
                    fontSize = 55;
                  }

                  return {
                    weight: 'lighter',
                    size: fontSize
                  };
                },
                formatter: function(value) {
                  return value.r
                },
                offset: 2,
                padding: 0
              }
            },
          }
        })




        // INITIALIZATION OF SELECT
        // =======================================================
        HSCore.components.HSTomSelect.init('.js-select')


        // INITIALIZATION OF CLIPBOARD
        // =======================================================
        HSCore.components.HSClipboard.init('.js-clipboard')
      }
    })()
  </script>

  <!-- Style Switcher JS -->


  <script>
    // Hide the success message after 3 seconds
    setTimeout(function() {
      var successMsg = document.querySelector('.alert-msg');
      successMsg.style.display = 'none';
    }, 3000);
  </script>

  <!-- JS Implementing Plugins -->
  <script src="assets/js/vendor.min.js"></script>

  <!-- JS Front -->
  <script src="assets/js/theme.min.js"></script>


  <script src="js/navbar.js"></script>
  <!-- End Style Switcher JS -->
</body>

</html>