jQuery(document).ready(function ($) {
  var cartWrapper = $(".cd-cart-container");
  var productId = 0;

  if (cartWrapper.length > 0) {
    var cartBody = cartWrapper.find(".body");
    var cartList = cartBody.find("ul").eq(0);
    var cartTotal = cartWrapper.find(".checkout").find("span");
    var cartTrigger = cartWrapper.children(".cd-cart-trigger");
    var cartCount = cartTrigger.children(".count");
    var addToCartBtn = $(".image-overlay");

    addToCartBtn.on("click", function (event) {
      event.preventDefault();
      var price = $(this).data("price");
      var productName = $(this).siblings(".product-box-details").text().trim();
      addToCart($(this), price, productName);
    });

    cartTrigger.on("click", function (event) {
      event.preventDefault();
      toggleCart();
    });

    cartWrapper.on("click", function (event) {
      if ($(event.target).is($(this))) toggleCart(true);
    });

    cartList.on("click", ".delete-item", function (event) {
      event.preventDefault();
      removeProduct($(event.target).parents(".product"));
    });

    cartList.on("change", "select", function (event) {
      quickUpdateCart();
    });
  }

  function toggleCart(bool) {
    var cartIsOpen =
      typeof bool === "undefined" ? cartWrapper.hasClass("cart-open") : bool;

    if (cartIsOpen) {
      cartWrapper.removeClass("cart-open");
      cartList.find(".deleted").remove();

      setTimeout(function () {
        cartBody.scrollTop(0);
        if (Number(cartCount.find("li").eq(0).text()) == 0)
          cartWrapper.addClass("empty");
      }, 500);
    } else {
      cartWrapper.addClass("cart-open");
    }
  }

  function addToCart(trigger, price, productName) {
    var cartIsEmpty = cartWrapper.hasClass("empty");
    addProduct(price, productName);
    updateCartCount(cartIsEmpty);
    updateCartTotal(price, true);
    cartWrapper.removeClass("empty");
  }

  function addProduct(price, productName) {
    productId = productId + 1;
    var productAdded = $('<li class="product"><div class="product-image"><a href="#0"><img src="https://codyhouse.co/demo/add-to-cart-interaction/img/product-preview.png" alt="placeholder"></a></div><div class="product-details"><h3><a href="#0">' + productName + '</a></h3><span class="price">$' + price + '</span><div class="actions"><a href="#0" class="delete-item">Delete</a><div class="quantity"><label for="cd-product-' + productId + '">Qty</label><span class="select"><select id="cd-product-' + productId + '" name="quantity"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></span></div></div></div></li>');
    cartList.prepend(productAdded);
  }

  function removeProduct(product) {
    var productPrice = Number(product.find(".price").text().replace("$", ""));
    var productQuantity = Number(product.find(".quantity").find("select").val());
    var productTotPrice = productPrice * productQuantity;
  
    product.remove();
  
    updateCartTotal(productTotPrice, false);
    updateCartCount(true, -productQuantity);
  }

  function quickUpdateCart() {
    var quantity = 0;
    var price = 0;
  
    cartList.children("li").each(function () {
      var singleQuantity = Number($(this).find("select").val());
      quantity += singleQuantity;
      price +=
        singleQuantity *
        Number($(this).find(".price").text().replace("$", ""));
    });
  
    cartTotal.text(price.toFixed(2));
    cartCount.find("li").eq(0).text(quantity);
    cartCount.find("li").eq(1).text(quantity + 1);
    updateCartTotal(price, true); // Update the cart total with the correct quantity
  }
  

  function updateCartCount(emptyCart, quantity) {
    if (typeof quantity === "undefined") {
      var actual = Number(cartCount.find("li").eq(0).text()) + 1;
      var next = actual + 1;

      if (emptyCart) {
        cartCount.find("li").eq(0).text(actual);
        cartCount.find("li").eq(1).text(next);
      } else {
        cartCount.addClass("update-count");

        setTimeout(function () {
          cartCount.find("li").eq(0).text(actual);
        }, 150);

        setTimeout(function () {
          cartCount.removeClass("update-count");
        }, 200);

        setTimeout(function () {
          cartCount.find("li").eq(1).text(next);
        }, 230);
      }
    } else {
      var actual = Number(cartCount.find("li").eq(0).text()) + quantity;
      var next = actual + 1;

      cartCount.find("li").eq(0).text(actual);
      cartCount.find("li").eq(1).text(next);
    }
  }

  function updateCartTotal() {
    var totalPrice = 0;
  
    cartList.find('.product').each(function() {
      var productPrice = Number($(this).find('.price').text().replace('$', ''));
      var productQuantity = Number($(this).find('select').val());
      totalPrice += productPrice * productQuantity;
    });
  
    cartTotal.text(totalPrice.toFixed(2));
    $('#final_price').val(totalPrice.toFixed(2)); // Update the hidden input field
  }
});
