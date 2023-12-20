<html lang="en">
<?php 
   include "../database/database.php";

session_start();
$finalPrice=empty($_SESSION["price"])?"":$_SESSION["price"];//tickets
$number=empty($_SESSION["number"])?"":$_SESSION["number"];


$Login = new Login("localhost","user","password","cinema");
$popcorn1=$Login->showPopcorn1();
$popcorn3=$Login->showPopcorn3();
$popcorn2=$Login->showPopcorn2();

$popcorn4=$Login->showPopcorn4();
$popcorn5=$Login->showPopcorn5();
$popcorn6=$Login->showPopcorn6();

if(isset($_POST["bill"]))
{
	$_SESSION["popcornPrice"]=$_POST["final_price"];
	header("location:../Payment/t.php");
}

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="popcorn.css">
</head>
<main>
  <h1>PopCorn package</h1>
  <div class="app-content-field">
        <div class="product-box medium" style="height:100%;">
        <img class="product-box-image" src="../Mainpage/assets/img/Product/<?php echo $popcorn1["image"]?>" alt="Product" data-price="25.99">
        <div class="product-box-details"><?php echo $popcorn1["productName"]?> <span><?php echo $popcorn1["price"]?></span></div>
          <div class="image-overlay" alt="Product" data-price="<?php echo $popcorn1["price"]?>" >
            <p class="image-text">RM <?php echo $popcorn1["price"]?></p>
          </div>
        </div>

    <div class="product-boxes">
      <div class="product-box-wrapper three">
      <div class="product-box medium" style="height:100%;">
        <img class="product-box-image"  src="../Mainpage/assets/img/Product/<?php echo $popcorn2["image"]?>" alt="Product" data-price="25.99">
        <div class="product-box-details"><?php echo $popcorn2["productName"]?> <span><?php echo $popcorn2["price"]?></span></div>
          <div class="image-overlay" alt="Product" data-price="<?php echo $popcorn2["price"]?>" >
            <p class="image-text">RM <?php echo $popcorn2["price"]?></p>
          </div>
        </div>

        <div class="product-box medium" style="height:100%;">
        <img class="product-box-image"  src="../Mainpage/assets/img/Product/<?php echo $popcorn3["image"]?>" alt="Product" data-price="25.99">
        <div class="product-box-details"><?php echo $popcorn3["productName"]?> <span><?php echo $popcorn3["price"]?></span></div>
          <div class="image-overlay" alt="Product" data-price="<?php echo $popcorn3["price"]?>" >
            <p class="image-text">RM <?php echo $popcorn3["price"]?></p>
          </div>
        </div>

        <div class="product-box medium" style="height:100%;">
        <img class="product-box-image"  src="../Mainpage/assets/img/Product/<?php echo $popcorn4["image"]?>" alt="Product" data-price="25.99">
        <div class="product-box-details"><?php echo $popcorn4["productName"]?> <span><?php echo $popcorn4["price"]?></span></div>
          <div class="image-overlay" alt="Product" data-price="<?php echo $popcorn4["price"]?>" >
            <p class="image-text">RM <?php echo $popcorn4["price"]?></p>
          </div>
        </div>

      </div>

      <div class="product-box-wrapper two">

      <div class="product-box medium" style="height:100%;">
        <img class="product-box-image"  src="../Mainpage/assets/img/Product/<?php echo $popcorn5["image"]?>" alt="Product" data-price="25.99">
        <div class="product-box-details"><?php echo $popcorn5["productName"]?> <span><?php echo $popcorn5["price"]?></span></div>
          <div class="image-overlay" alt="Product" data-price="<?php echo $popcorn5["price"]?>" >
            <p class="image-text">RM <?php echo $popcorn5["price"]?></p>
          </div>
        </div>

        <div class="product-box medium" style="height:100%;">
        <img class="product-box-image"  src="../Mainpage/assets/img/Product/<?php echo $popcorn6["image"]?>" alt="Product" data-price="25.99">
        <div class="product-box-details"><?php echo $popcorn6["productName"]?> <span><?php echo $popcorn6["price"]?></span></div>
          <div class="image-overlay" alt="Product" data-price="<?php echo $popcorn6["price"]?>" >
            <p class="image-text">RM <?php echo $popcorn6["price"]?></p>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<div class="cd-cart-container empty">
  <a href="#0" class="cd-cart-trigger">
    Cart
    <ul class="count">
      <!-- cart items count -->
      <li>0</li>
      <li>0</li>
    </ul> <!-- .count -->
  </a>

  <div class="cd-cart">
    <div class="wrapper">
      <header>
        <h2>Cart</h2>
      </header>
      <div class="body">
        <ul>
      <?php 
      if(empty($finalPrice))
      {

      }
      else
      {
      ?>    
        <li class="product">
          <div class="product-details">
            <h3>
              <a href="#0">Ticket</a>
            </h3>
            <span class="price">
            <?php 
              echo $finalPrice;
            ?></span>
            <div class="actions">
              <div class="quantity">
                <label for="cd-product-' + productId + '">Qty</label>
                <span class="select">
                  <select id="cd-product-' + productId + '" name="quantity">
                    <option value="1"><?php echo $number?></option>
                  </select>
                </span>
              </div>
            </div>
          </div>
        </li>
        <?php }?>
          <!-- products added to the cart will be inserted here using JavaScript -->
        </ul>
      </div>

      <footer>
        <form action="popcorn.php" method="post">
          <input type="hidden" name="final_price" id="final_price" value="0">
          <button name="bill" class="checkout btn"><em>Checkout - $<span id="final_price_display">0</span></em></button>
        </form>
      </footer>
    </div>
  </div> <!-- .cd-cart -->
</div> <!-- cd-cart-container -->

<script src="food.js"></script>

</html>
