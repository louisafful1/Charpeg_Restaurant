<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // Redirect to the login page or display an error message
  header("Location: auth/login.php");
  exit;
}

include "include/database.php";

if (($_SERVER['REQUEST_METHOD'] === "POST") && isset($_POST['submit'])) {

  $food_item = test_input($_POST['food_item']);
  $quantity = test_input($_POST['quantity']);
  $price = test_input($_POST['TotalPrice']);



  $selectPrice = mysqli_query($connection, "SELECT price from food where food=  '$food_item';");
  $arr = mysqli_fetch_array($selectPrice);

  $TotalPrice =  $quantity * $arr['price'];

  if (!$food_item) {
    echo "<script>alert('Please Select a food Item')</script>";
  } 
  if ($TotalPrice == $price && $food_item != '') {


    $staff =$_SESSION['name'];
    // $price =243;

    if ($quantity == '' || $quantity <= 0) {
      echo "<script>alert('Quantity cannot be zero or empty')</script>";
      echo "<script>window.location = 'transaction.php'</script>"; // Redirect to clear history
      exit();
    } elseif ($food_item != '') {


      $stmt = $connection->prepare("INSERT INTO `transactions`(`food_item`, `quantity`, `amount`, `date`, `staff`) VALUES (?, ?, ?, NOW(), ?)");
      $stmt->bind_param("sids", $food_item, $quantity, $TotalPrice, $staff);

      if ($stmt->execute()) {

        header("Location: transaction.php"); //redirect to prevent re-inserting
        exit();
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    } else {
      echo "<script>alert('Please Select a food Item')</script>";
      echo "<script>window.location = 'transaction.php'</script>"; // Redirect to clear history
      exit();
    }
  } else {
    echo "<script>alert('Why do you want to steal...lol')</script>";
  }
}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  //  $data =mysqli_escape_string($data);
  // $data = FILTER_VALIDATE_INT
  $data = htmlspecialchars_decode($data);
  return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charpeg Restaurant</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="favicon.ico">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="assets/css/vendor.min.css">

  <script src="node_modules/tom-select/dist/js/tom-select.complete.min.js"></script>

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="assets/css/theme.minc619.css?v=1.0">

  <link rel="stylesheet" href="css/transaction.css">
</head>

<body>
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
      </ul>
    </nav>

  </header>

  <main id="content" role="main" class="main">
    <!-- Content -->

    <div class="content container-fluid">

      <form method="post" action="" name="form1">
        <!-- Content -->
        <div class="row">
          <div class="col-md-5">
            <label for="">Food Item</label>

            <?php

            $sql1 = "SELECT * FROM food ORDER BY food";
            $query1 = mysqli_query($connection, $sql1);

            ?>

            <select id="food_item" class="form-control mb-3" name="food_item" autocomplete="off" aria-label="Item name">
              <?php
              if (mysqli_num_rows($query1) > 0) {
                echo "<option value=''></option>";
                // echo "<option readonly   style='text-align:left;'>---SELECT ITEM----</option>";
                while ($arr = mysqli_fetch_row($query1)) {

                  echo "<option class='fs-3'  value='$arr[1]'>" . $arr[1] . "</option>";
                }
              } else {
                echo "<option>NO FOOD AVAILABLE</option>";
              }
              ?>
            </select>
          </div>
          <!-- End Col -->

          <div class="col-12 col-sm-auto col-md-3">
            <!-- Quantity -->
            <label for="">Quantity</label>
            <div class="quantity-counter mb-3">

              <div class="js-quantity-counter row align-items-center">

                <div class="col">
                  <input style="text-align:center;" class="js-result form-control form-control-quantity-counter" type="number" name="quantity" value="1" readonly>
                </div>
                <a class="js-minus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
                  <i class="bi bi-dash-circle-fill display-5"></i>
                </a>
                <!-- End Col -->
                <a class="js-plus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
                  <i class="bi bi-plus-circle-fill display-5"></i>
                </a>

              </div>
              <!-- End Row -->
            </div>
            <!-- End Quantity -->
          </div>
          <!-- End Col -->

          <div class="col-12 col-sm col-md-2">
            <!-- Input Group -->
            <div class="mb-3">
              <label for="">Price</label>
              <input type="number" id="price" name="TotalPrice" class="form-control" placeholder="00" aria-label="00" readonly>
              <!-- <span id="totalPrice" class="form-control"></span> -->

            </div>
            <!-- End Input Group -->
          </div>
          <!-- End Col -->


          <!-- End Col -->
        </div>
        <div class="col-12 col-sm col-md-2">
          <!-- Input Group -->
          <div class="mb-2">

            <input type="Submit" name="submit" class="form-control mt-4 text-dark">
      </form>
    </div>
    <!-- End Input Group -->
    </div>

    <!-- Card -->
    <div class="card">
      <!-- Header -->
      <div class="card-header card-header-content-md-between">
        <div class="mb-2 mb-md-0">
          <form>
            <!-- Search -->
            <div class="input-group input-group-merge input-group-flush">
              <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
              </div>
              <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
            </div>
            <!-- End Search -->
          </form>
        </div>
        <div class="d-grid d-sm-flex gap-2">

        <?php
        // $todayTotalPrice = mysqli_query($connection, "SELECT amount FROM transactions WHERE date=NOW();");


        
        ?>



            Today's Earned Today: 
        </div>
      </div>
      <!-- End Header -->

      <!-- Table -->
      <div class="table-responsive datatable-custom">
        <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                       "columnDefs": [{
                          "targets": [1],
                          "width": "5%",
                          "orderable": false,
                          "searchable": false
                        }],
                        
                        "columnDefs": [{
                          "targets": [9],
                          "width": "1%",
                          "orderable": false,
                          "searchable": false
                        }],

                       "search": "#datatableSearch",
                       "entries": "#datatableEntries",
                       "pageLength": 12,
                       "isResponsive": false,
                       "isShowPaging": false,
                       "pagination": "datatablePagination"
                     }'>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="table-column-pe-0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" disabled checked id="datatableCheckAll">
                  <label class="form-check-label">
                  </label>
                </div>
              </th>

              <th class="table-column-ps-0">S/N</th>
              <th>FOOD</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
              <th>Staff</th>
              <th>DATE</th>
              <th></th>
              <th></th>
              <th>ACTIONS</th>
            </tr>
          </thead>

          <tbody>

            <?php
            $fetch = mysqli_query($connection, "SELECT * FROM transactions");
            $sn  = 1;

            while ($row = mysqli_fetch_array($fetch)) {


              $dbDate = $row['date'];;

              // Convert the database date string to a DateTime object
              $dateTime = new DateTime($dbDate);

              // Format the date
              $formattedDate = $dateTime->format('jS M, Y h:ia');


            ?>
              <tr>
                <td class="table-column-pe-0">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" disabled checked id="datatableCheckAll1">
                    <label class="form-check-label" for="datatableCheckAll1"></label>
                  </div>
                </td>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $row['food_item']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['staff']; ?></td>
                <td><?php echo $formattedDate; ?></td>
                <td></td>
                <td></td>
                <td>

                  <div class="btn-group" role="group">
                    <!-- edit quantity button -->
                    <a class="btn btn-white btn-sm edit_quantity" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#updateStockModal">
                      <i class="bi-pencil-fill me-1"></i>
                    </a>

                    <!-- Modal for updating quantity -->
                    <div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static" style="margin-top:4rem;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Quantity</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form name="updateStockForm" id="updateStockForm" role="form">
                              <div class="row">
                                <div class="col-sm-12 form-group-sm">
                                  <label>Quantity</label>

                                  <input type="text" class="form-control" id="editQuantityValue" data-id="<?php echo $row['id']; ?>">
                                </div>
                              </div>
                              <input type="hidden" id="stockUpdateItemId">
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" id="quantityUpdateSubmit">Update</button>
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>


                    <!-- End of modal -->
                    <a class="btn btn-white btn-sm text-danger delete-record" data-id="<?php echo $row['id']; ?>" href="">
                      <i class="bi-trash-fill me-1"></i>
                    </a> <!--delete button-->

                  </div>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- End Table -->

      <!-- Footer -->
      <div class="card-footer">
        <div class="row justify-content-center justify-content-sm-between align-items-sm-center">

          <!-- End Col -->

          <div class="col-em-auto">
            <div class="d-flex justify-content-center justify-content-sm-end">
              <!-- Pagination -->
              <nav id="datatablePagination" aria-label="Activity pagination"></nav>
            </div>
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
      <!-- End Footer -->
    </div>
    <!-- End Card -->
    </div><br><br><br>
    <!-- End Content -->

    <!-- Footer -->

    <div class="footer " style="background:#000;">
      <!-- <div class="col "> -->
      <p class="fs-10 mt-2 mb-0 " style="margin-left:40% !important;">&copy; thefullness Hub. All Rights Reserved <span class="d-sm-inline-block">2023.</span></p>
      <!-- End Col -->
    </div>

    <!-- End Footer -->
  </main>


  <!-- JS Implementing Plugins -->
  <script src="assets/js/vendor.min.js"></script>

  <!-- JS Front -->
  <script src="assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script src="js/plugin.js"></script>
  <!-- Style Switcher JS -->
  <script>
    $(document).ready(function() {
      $('#menu-bar').click(function() {
        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');
      })
    });
  </script>

  <script>
    new TomSelect("#food_item", {
      allowEmptyOption: true,
      create: false
    });
  </script>
  <script src="js/ajax.js"></script>
</body>

</html>