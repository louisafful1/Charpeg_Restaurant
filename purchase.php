<?php 
include "include/database.php";

 if($_SERVER['REQUEST_METHOD'] === "POST"){
   
$food_item = $_POST['food_item'];
$quantity = $_POST['quantity'];
$TotalPrice = $_POST['TotalPrice'];
$staff = "LOUIS";
// $price =243;


if ($food_item != '---SELECT ITEM----') {
  // Process the selected food item
  // Your further processing logic here

$stmt = $connection->prepare("INSERT INTO `transactions`(`food_item`, `quantity`, `amount`, `date`, `staff`) VALUES (?, ?, ?, NOW(), ?)");
$stmt->bind_param("sids", $food_item, $quantity, $TotalPrice, $staff);

if ($stmt->execute()) {
  
    header("Location: purchase.php"); //redirect to prevent re-inserting
exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
} else {
  echo "<script>alert('Please Select a food Item')</script>";
}




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

  <!-- CSS Front Template -->
  <link rel="stylesheet" href="assets/css/theme.minc619.css?v=1.0">



      <style>
:root {
  --yellow: #F7CA3E;
}

* {
  /* font-family: 'Roboto', sans-serif; */
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  outline: none;
  border: none;
  text-transform: capitalize;
  transition: all .2s linear;
}

h1, h3 {
  /* font-family: 'Oswald', sans-serif; */
}




html::-webkit-scrollbar {
  width: 1.4rem;
}

html::-webkit-scrollbar-track {
  background: #333;
}

html::-webkit-scrollbar-thumb {
  background: var(--yellow);
}


body{
    margin-top: 5.5rem;
}



  header {
  position: fixed !important;
  top: 0;
  left: 0;
  z-index: 1000;
  width: 100%;
  background: #fff;
  padding: 0.3rem 10%;
  box-shadow: 0 .3rem 2rem rgba(0, 0, 0, .1);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

header .logo img {
  height: 3rem;
}

header .navbar ul {
  display: flex;
  align-items: center;
  justify-content: center;
  list-style: none;
}

header .navbar ul li {
  margin-left: 3rem;
}

header .navbar ul li a {
  font-size: 1rem;
  color: #666;
}

header .navbar ul li a.active,
header .navbar ul li a:hover {
  color: var(--yellow);
}

header #menu-bar {
  font-size: 3rem;
  color: #666;
  cursor: pointer;
  display: none;
}

input[type="submit"]{
    background-color: #F7CA3E;
}




@media (max-width: 768px) {
  header #menu-bar {
    display: block;
  }
}
      </style>
</head>
<body> 
    <header>

        <a href="#" class="logo"><img src="images/logo-img.png" alt=""></a>
    
        <div id="menu-bar" class="fas fa-hamburger"></div>
    
        <nav class="navbar">
            <ul>
                
                <li><a href="#">about</a></li> 
                <li><a href="#">Logout</a></li>
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
                <select id="food_item" name="food_item" class="form-control mb-3">
              
                <?php
                 if (mysqli_num_rows($query1) > 0) {
                 echo "<option readonly selected  style='text-align:left;'>---SELECT ITEM----</option>";
                while($arr=mysqli_fetch_row($query1)){

                    echo "<option class='fs-3'  value='$arr[1]'>".$arr[1]."</option>"; 
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
                        <input style="text-align:center;" class="js-result form-control form-control-quantity-counter" type="number" name="quantity" value="1"  oninput="calculateTotalPrice()" >
                      </div>
                      <a class="js-minus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
        <i class="fas fa-minus"></i>
      </a>
                      <!-- End Col -->
                      <a class="js-plus btn btn-white btn-xs btn-icon rounded-circle" href="javascript:;">
        <i class="fas fa-plus"></i>
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
                    <input type="number" id="price"name="TotalPrice"  class="form-control" placeholder="00" aria-label="00">
                    

                  </div>
                  <!-- End Input Group -->
                </div>
                <!-- End Col -->

             
                <!-- End Col -->
              </div>
              <div class="col-12 col-sm col-md-2">
                <!-- Input Group -->
                <div class="mb-2">
                 
                  <input type="Submit" class="form-control mt-4 text-dark" >
</form>
                </div>
                <!-- End Input Group -->
              </div>
          <!-- Page Header -->



          

          <!-- End Page Header -->
   
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
                    <th scope="col" class="table-column-pe-0" >
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" disabled checked  id="datatableCheckAll">
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
               

                while(   $row = mysqli_fetch_array($fetch)){
                            

                  $dbDate = $row['date'];; // Replace this with your actual database date

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
                        <a class="btn btn-white btn-sm" data-bs-toggle="modal" data-bs-target="#updateStockModal" href="">
                          <i class="bi-pencil-fill me-1"></i> 
                        </a>

                              <!-- Modal -->          
     <div id="updateStockModal" class="modal fade" role="dialog" data-backdrop="static" style="margin-top:4rem;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" >Update Quantity</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="updateStockForm" id="updateStockForm" role="form">
                        <div class="row">
                            <div class="col-sm-12 form-group-sm">
                                <label>Quantity</label>



                                <?php
                                
                                // if(isset())
                                
                                // $sel = mysqli_query($connection, "select quantity from transactions where id=''")
                                
                                
                                ?>





                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="stockUpdateItemId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="stockUpdateSubmit">Update</button>
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
                  
                  <?php }?>
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
          <!-- <div class="row justify-content-between align-items-center"> -->
            <!-- <div class="col "> -->
            <p class="fs-10 mt-2 mb-0 " style="margin-left:40% !important;">&copy; thefullness Hub. All Rights Reserved <span class="d-sm-inline-block">2023.</span></p>

            <!-- </div> -->
            <!-- End Col -->
    
         
          <!-- </div> -->
          <!-- End Row -->
        </div>
    
        <!-- End Footer -->
      </main>


  <!-- JS Implementing Plugins -->
  <script src="assets/js/vendor.min.js"></script>

  <!-- JS Front -->
  <script src="assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // INITIALIZATION OF DATATABLES
      // =======================================================
      HSCore.components.HSDatatables.init($('#datatable'), {
        
        language: {
          zeroRecords: `<div class="text-center p-4">
              <img class="mb-3" src="./assets/svg/illustrations/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
              <img class="mb-3" src="./assets/svg/illustrations-light/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
            <p class="mb-0">No data to show</p>
            </div>`
        }
      });

      const datatable = HSCore.components.HSDatatables.getItem('datatable')





      $('#toggleColumn_product').change(function (e) {
        datatable.columns(1).visible(e.target.checked)
      })

      $('#toggleColumn_food').change(function (e) {
        datatable.columns(2).visible(e.target.checked)
      })



      $('#toggleColumn_quantity').change(function (e) {
        datatable.columns(3).visible(e.target.checked)
      })

      $('#toggleColumn_price').change(function (e) {
        datatable.columns(4).visible(e.target.checked)
      })

      $('#toggleColumn_date').change(function (e) {
        datatable.columns(5).visible(e.target.checked)
      })

      $('#toggleColumn_price').change(function (e) {
        datatable.columns(6).visible(e.target.checked)
      })

      datatable.columns(7).visible(false)
      datatable.columns(8).visible(false)

      

    });
  </script>



  <!-- Style Switcher JS -->
  <script>$(document).ready(function() {
    $('#menu-bar').click(function() {
        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');
    })



});</script>

  <script>
    // Function to handle the AJAX request and update the price field
    function updatePrice() {
        var selectedItem = document.getElementById('food_item').value;
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var priceElement = document.getElementById('price');
                priceElement.dataset.initialPrice = this.responseText; // Store initial price in a custom attribute
                calculateTotalPrice(); // Recalculate the total price
            }
        };

        xhttp.open("GET", "get_price.php?food_item=" + selectedItem, true);
        xhttp.send();
    }

    // Function to calculate the total price and update the 'price' input field
    function calculateTotalPrice() {
        var quantity = parseFloat(document.forms['form1']['quantity'].value);
        var initialPrice = parseFloat(document.getElementById('price').dataset.initialPrice);

        // Check if the values are valid numbers and if quantity is not empty
        if (!isNaN(quantity) && !isNaN(initialPrice) && quantity !== "") {
            var totalPrice = quantity * initialPrice;
            // Update the 'price' input field with the calculated total price
            document.getElementById('price').value = totalPrice.toFixed(2);
        }
    }

    // Event listeners
    document.getElementById('food_item').addEventListener('change', updatePrice);
    document.forms['form1']['quantity'].addEventListener('input', calculateTotalPrice);
</script>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    const minusBtn = document.querySelector(".js-minus");
    const plusBtn = document.querySelector(".js-plus");
    const quantityInput = document.querySelector(".js-result");
    const priceInput = document.getElementById("price");

    minusBtn.addEventListener("click", function (event) {
      event.preventDefault();
      handleQuantityChange(-1);
    });

    plusBtn.addEventListener("click", function (event) {
      event.preventDefault();
      handleQuantityChange(1);
    });

    function handleQuantityChange(changeValue) {
      const currentValue = parseInt(quantityInput.value);
      const newValue = currentValue + changeValue;
      if (newValue >= 1) {
        quantityInput.value = newValue;
        calculateTotalPrice();
      }
    }

    function updatePrice() {
      // ... (same as previous implementation)
    }

    function calculateTotalPrice() {
  const quantity = parseInt(quantityInput.value);
  const price = parseInt(priceInput.value);
  const totalPrice = quantity * price;
  document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
}


    // Event listeners
    document.getElementById("food_item").addEventListener("change", updatePrice);
    document.forms["form1"]["quantity"].addEventListener("input", calculateTotalPrice);
  });
</script>



<script>
  $(document).ready(function() {
  $(document).on('click', '.delete-record', function() {
    // event.preventDefault();
    
    var rowId = $(this).data('id');

    // Confirm before deletion
    if (confirm('Are you sure you want to delete this record?')) {
      // Send an AJAX request to delete the record
      $.ajax({
        url: 'delete.php', // Replace with your backend endpoint
        method: 'POST',
        data: { id: rowId },
        success: function(response) {
          // If deletion is successful, remove the deleted row from the table
          if (response === 'success') {
            $(this).closest('tr').remove();
           
          }
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }
  });
});

</script>
</body>
</html>