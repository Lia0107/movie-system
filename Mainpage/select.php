<?php 
session_start();
$number=empty($_SESSION["number"])?"1":$_SESSION["number"];
$movieOfdate=empty($_SESSION["dateOfmovie"])?"":$_SESSION["dateOfmovie"];
$movieID=empty($_SESSION["movieID"])?"":$_SESSION["movieID"];
$branchID=empty($_SESSION["branchID"])?"":$_SESSION["branchID"];
$packageID=empty($_SESSION["packageID"])?"":$_SESSION["packageID"];
$movieOftime=empty($_SESSION["timeOfmovie"])?"":$_SESSION["timeOfmovie"];

include "../Database/database.php";

$login = new Login("localhost", "user", "password", "cinema"); //connect to the object oriented of SQL for connecting the database

if(isset($_POST["checkout"]))
{
	if(!empty($_POST["finalPrice"]))
	{
			if($_POST["finalquantity"]==$number)
			{
				$_SESSION['timeout1'] = time() + 600;
				$_SESSION["price"]=$_POST["finalPrice"];
				$_SESSION["itemName"]="Tickets";
				header("location:../Payment/t.php");
			}
			else
			{
				echo "<script>
				alert(' The number of tickets for which you were chosen is not enough');
				window.location.href = 'select.php';
				</script>"; //header to the navigation page with the reminder
			}
	}
	else
	{
		echo "<script>
		alert('The tickets cannot be empty');
		window.location.href = 'select.php';
		</script>"; //header to the navigation page with the reminder
	}
}

$movie=$login->getMovieDetail($movieID);
$package = $login->getPackageDetail($packageID);

if($package["packageName"]=="3D") //set the package price
{
	$fee=$movie["Fee"]+10;

}
else
{
	$fee=$movie["Fee"];
}

if(isset($_POST["popcorn"]))
{
	if(!empty($_POST["finalPrice"]))
	{
		if($_POST["finalquantity"]==$number)
		{
			$_SESSION['timeout1'] = time() + 600;
			$_SESSION["price"]=$_POST["finalPrice"];
			$_SESSION["itemName"]="Tickets with Popcorn";
			header("location:../Food/popcorn.php");
		}
		else
		{
			echo "<script>
			alert(' The number of tickets for which you were chosen is not enough');
			window.location.href = 'select.php';
			</script>"; //header to the navigation page with the reminder
		}
	}
	else
	{
		echo "<script>
		alert('The tickets cannot be empty');
		window.location.href = 'select.php';
		</script>"; //header to the navigation page with the reminder
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

$(document).ready(function() {
    function incrementValue(e) {
      e.preventDefault();
      var fieldName = $(e.target).data('field');
      var parent = $(e.target).closest('div');
      var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
      var price = parseFloat(parent.closest('tr').find('td:nth-child(2)').text());
  
      if (!isNaN(currentVal) && calculateTotal() < <?php echo $number?>) {
        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        updateTotalPrice();
      }
    }
  
    function decrementValue(e) {
      e.preventDefault();
      var fieldName = $(e.target).data('field');
      var parent = $(e.target).closest('div');
      var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
      var price = parseFloat(parent.closest('tr').find('td:nth-child(2)').text());
  
      if (!isNaN(currentVal) && currentVal > 0) {
        parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        updateTotalPrice();
      }
    }
  
    function calculateTotal() {
      var total = 0;
      $('.quantity-field').each(function() {
        var quantity = parseInt($(this).val(), 10);
        total += isNaN(quantity) ? 0 : quantity;
      });
      return total;
    }
  
	function updateTotalPrice() {
  var total = 0;
  $('.quantity-field').each(function() {
    var quantity = parseInt($(this).val(), 10);
    var price = parseFloat($(this).closest('tr').find('td:nth-child(2)').text());
    total += isNaN(quantity) ? 0 : quantity * price;
  });
  $('#total_display').text('$' + total.toFixed(2));

  // Store the final price in a hidden input field
  $('input[name="finalPrice"]').val(total.toFixed(2));

  // Update the total quantity
  updateTotalQuantity();
}

function updateTotalQuantity() {
  var totalQuantity = 0;
  $('.quantity-field').each(function() {
    var quantity = parseInt($(this).val(), 10);
    totalQuantity += isNaN(quantity) ? 0 : quantity;
  });
  $('input[name="finalquantity"]').val(totalQuantity);
}  

$('.input-group').on('click', '.button-plus', function(e) {
  incrementValue(e);
  updateTotalQuantity();
});

$('.input-group').on('click', '.button-minus', function(e) {
  decrementValue(e);
  updateTotalQuantity();
});

  
    $('.quantity-field').on('input', function() {
      updateTotalPrice();
      updateMaxQuantities();
    });
  
    // Set the maximum value to 10 for all quantity inputs initially
    $('.quantity-field').attr('max', 10);
  
    // Update maximum quantity for each category based on the remaining total
    function updateMaxQuantities() {
      var currentTotal = calculateTotal();
      var remainingTickets = 10 - currentTotal;
  
      $('.quantity-field').each(function() {
        var quantityInput = $(this);
        var currentQuantity = parseInt(quantityInput.val(), 10);
        var maxQuantity = Math.min(currentQuantity + remainingTickets, 10);
  
        quantityInput.attr('max', maxQuantity);
      });
    }
  
    updateMaxQuantities();
  });
  



  </script>
  <style>

@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=VT323&display=swap');

.icon-shape {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    vertical-align: middle;
}

.icon-sm {
    width: 2rem;
    height: 2rem;   
}

body {
	font-family: 'Open Sans', sans-serif;
	color: white;
	background-color: #333; 
	width: 100%;
	margin: 0; 
}

p, button, input {
	font-family: 'Open Sans', sans-serif;
	font-size: 1em;
	padding: 5px 5px;
	margin: 1px;
}

h2 {
	text-align: center;
}

table {
	width: 100%;
	text-align: center;
}

table, th, td {
	border: 2px solid rgb(244, 231, 86);
	border-collapse: collapse;
	padding: 10px;
}

input[type="number"] {
	width: 35px;
}

#price_product {
	width: 100px;
}

.container {
	width: 90%;
	margin: auto;
}

.flex {
	display: flex;
	justify-content: space-around;
	flex-wrap: wrap;
	margin-top: 5em;
}

.structure {
	width: 80%;
	background-color: black;
	border-radius: 10px;
	padding: 20px;
	margin: auto;
}
#checkout_btn {
      background-color: white;
      border: 2px solid #333;
      border-radius: 4px;
      color: #333;
      cursor: pointer;
      font-size: 16px;
      padding: 10px 20px;
      transition: background-color 0.3s, color 0.3s;

	}

    #checkout_btn:hover {
      background-color: #333;
      color: white;
    }

  </style>
</head>
<body>
	<div class="container flex">
		<div class="structure">
		  <h1>Tickets Selection</h1>
		  <p><?php echo $movie["movieName"]?><br><?php echo $movie["RunningTime"]?><br><?php echo $package["packageName"]?><br>Please note that there are only <?php echo $number?> person tickets available</p>
		  <br>
		  <form action="select.php" method="post">
		  <table id="table">
			<tbody id="all_products">
				<tr>
				  <th>Categories</th>
				  <th>Price</th>	
				  <th>Quantities</th>
				</tr>
				<tr>
				  <td>Adult</td>
				  <td><?php echo $fee?></td>
				  <td>
					<div class="input-group w-auto justify-content-end align-items-center">
					  <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1" data-field="quantity" data-target="adult-quantity" name="add">
					  <input type="number" step="1" max="10" value="0" name="quantity" id="adult-quantity" class="quantity-field border-0 text-center w-25" readonly>
					  <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm" data-field="quantity" data-target="adult-quantity" name="add">
					</div>
				  </td>
				</tr>
				<tr>
				  <td>Children</td>
				  <td><?php echo $fee*0.7?></td>
				  <td>
					<div class="input-group w-auto justify-content-end align-items-center">
					   <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1" data-field="quantity" data-target="children-quantity">
					   <input type="number" step="1" max="10" value="0" name="quantity" id="children-quantity" class="quantity-field border-0 text-center w-25" readonly>
					   <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm" data-field="quantity" data-target="children-quantity">
					</div>
				  </td>
				</tr>
				<tr>
				  <td>Senior Citizen</td>
				  <td><?php echo $fee*0.6?></td>
				  <td>
					<div class="input-group w-auto justify-content-end align-items-center">
					   <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1" data-field="quantity" data-target="senior-quantity">
					   <input type="number" step="1" max="10" value="0" name="quantity" id="senior-quantity" class="quantity-field border-0 text-center w-25" readonly>
					   <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm" data-field="quantity" data-target="senior-quantity">
					</div>
				  </td>
				</tr>
				<tr>
				  <td>OKU</td>
				  <td><?php echo $fee*0.5?></td>
				  <td>
					<div class="input-group w-auto justify-content-end align-items-center">
					   <input type="button" value="-" class="button-minus border rounded-circle icon-shape icon-sm mx-1" data-field="quantity" data-target="oku-quantity">
					   <input type="number" step="1" max="10" value="0" name="quantity" id="oku-quantity" class="quantity-field border-0 text-center w-25" readonly>
					   <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm" data-field="quantity" data-target="oku-quantity">
					</div>
				  </td>
				</tr>
			</tbody>			
		  </table>
		<h2>Total Price : <span id="total_display"></span></h2>
		  <input type="hidden" value="0" name="finalPrice">
		  <input type="hidden" value="0" name="finalquantity">
		  <button id="checkout_btn" style="background-color: white;" name="checkout" onclick="return confirm('Are you sure that you want to checkout?')">Checkout</button> <!-- New button with white background -->
		  <button id="checkout_btn" style="background-color: white; float:right;" name="popcorn" onclick="return confirm('Do you want to purchase popcorn?')">Add on popcorn</button> <!-- New button with white background -->

		</form>
		</div>
	  </div>
</body>
</html>
