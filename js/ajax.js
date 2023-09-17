$(document).ready(function() {
    
   /******* HANDLING THE DELETE RECORD. ******/
  $(document).on('click', '.delete-record', function() {
    // event.preventDefault();
    
    var rowId = $(this).data('id');
    
    // Confirm before deletion
    if (confirm('Are you sure you want to delete this transaction with ?'+ rowId)) {

      // Send an AJAX request to delete the record
      $.ajax({
        url: 'ajax_db.php', 
        method: 'POST',
        data: { id: rowId },
        success: function(response) {
          // If deletion is successful
          if (response === 'success') {
          //echo a successful delete message
           
          } 
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }
  });
  


/******* HANDLING THE EDIT BUTTON. ******/
  $(document).on('click', '.edit_quantity', function() {
    // event.preventDefault();
    var editQuantityValue = $("#editQuantityValue");
    var editId = $(this).data('id');
    // Send an AJAX request to output the quantity      
      $.ajax({
        url: 'ajax_db.php', 
        method: 'POST',
        data: { edit: editId },
        dataType: 'json',
        success: function(response) {
         
          editQuantityValue.val(response.selectedQuantity);
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    
  });


  /******* AJAX REQUEST TO UPDATE PRICE AND CALCULATE TOTAL PRICE BASED ON SELECTED ITEM AND QUANTITY. ******/

      // Function to handle the AJAX request and update the price field
      function updatePrice() {
        var selectedItem = document.getElementById('food_item').value;
        var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var priceElement = document.getElementById('price');
                priceElement.dataset.initialPrice = this.responseText; 
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
    
    // Event listener for when an item is changed
    document.getElementById('food_item').addEventListener('change', updatePrice);

    


  /******  HANDLING QUANTITY CHANGES AND CALCULATING TOTAL PRICE  *****/
const minusBtn = document.querySelector(".js-minus");
const plusBtn = document.querySelector(".js-plus");
const quantityInput = document.querySelector(".js-result");
const priceInput = document.getElementById("price");

// Add event listener for minus button
minusBtn.addEventListener("click", function (event) {
  event.preventDefault();
  handleQuantityChange(-1);
  calculateTotalPrice(); // Recalculate the total price
});

// Add event listener for plus button
plusBtn.addEventListener("click", function (event) {
  event.preventDefault();
  handleQuantityChange(1);
  calculateTotalPrice(); // Recalculate the total price
});

// Function to handle quantity changes
function handleQuantityChange(changeValue) {
  const currentValue = parseInt(quantityInput.value);
  const newValue = currentValue + changeValue;
  if (newValue >= 1) {
    quantityInput.value = newValue;
  }
}

// Function to calculate and update total price
function calculateTotalPrice() {
  const quantity = parseInt(quantityInput.value);
  const initialPrice = parseFloat(priceInput.dataset.initialPrice); 
  if (!isNaN(quantity) && !isNaN(initialPrice)) {
    const totalPrice = quantity * initialPrice;
    priceInput.value = totalPrice.toFixed(2); // Update the input value
  }
}

// Event listener for when an item is changed
document.getElementById("food_item").addEventListener("change", updatePrice); 




 /******* Update QUANTITY AJAX *****/
 //TASK: IT STILL PERFORMS EVEN WHEN I DELETE IT. 
 $(document).on('click', '#quantityUpdateSubmit', function() {
  var updatedQuantityValue = $("#editQuantityValue").val();
  var updateId = $("#stockUpdateItemId").val(); // Retrieve the item ID from a hidden input field

  // Send an AJAX request to update the record
  $.ajax({
    url: 'ajax_db.php',
    method: 'POST',
    data: {
      update: updateId,
      currentQuantityValue: updatedQuantityValue
    },
    success: function(response) {
      $('#updateStockModal').modal('hide');
      alert(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
});





    
  });

  