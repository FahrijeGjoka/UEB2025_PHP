<?php
$GLOBALS['site_name'] = "Online Shop";
$GLOBALS['current_year'] = date('Y');
$GLOBALS['currency'] = "$";
function format_price($price) {
  return $GLOBALS['currency'] . number_format($price, 2);
}


$slogans = [
  "Smell like never before!",
  "Find your signature scent.",
  "Elegance in every drop.",
  "Style. Fragrance. You."
];
$random_slogan = $slogans[array_rand($slogans)];
?>


<!DOCTYPE html>
<html>
    <head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $GLOBALS['site_name']; ?> 
            Women
        </title>
        <link rel="stylesheet" href="women.css">

    </head>

    <body>

        <header>
            <div class="logo"><?php echo $GLOBALS['site_name']; ?></div>
            <nav>
              
              <ul>
                <li><a href="Website.html">Homepage</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="men.html">Men</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contactus.html">Contact Us</a></li>
              </ul>
            </nav>
          
            <div class="cart">
              <a href="#">Cart</a>
              <span class="cart-items">0</span>
            </div>
        
          </header>
        

        <section class="hero">
            <h1>Welcome to Online Shop</h1>
            <h2>Shop the latest trends in perfumes.</h2>

            <section class="hero">
    <h1><?php echo $random_slogan; ?></h1> 
    <h2>Shop the latest trends in perfumes.</h2>

            <button id="menuBtn"  >SCENTES</button>
          <ul id="menu"  class="start" >
          <li><a href="#floralscent">Florall Scent</a></li>
          <li ><a href="#warmandspicy">Warm and Spicy</a></li>
          <li ><a href="#fruitscent">Fruit Scent</a></li>
        </ul>
        </section>

          <section class="products">
            <h2 style="font-size: 60px;" >Featured Products</h2>

            <div id="floralscent" >
            <h3 class="ntitle" >Floral Scent</h3>

           
            <div class="product">
              <img src="womanimg/valentino2.jpg.png" alt="Product Image">
              <h3>Valentino</h3>
              <p>Born In Roma Eau de Parfum</p>
              <span class="price"><?php echo format_price(35.9889); ?></span>
              <a href="#"  class="btn">Add to Cart</a>
            </div>
        
            <div class="product">
              <img src="womanimg/burberry.jpg" alt="Product Image">
              <h3>BURBERYY</h3>
              <p>Her Eau de Parfum</p>
              <span class="price"><?php echo format_price(39.989); ?></span>
              <a href="#" class="btn">Add to Cart</a>
            </div>
        
            <div class="product">
              <img src="womanimg/ariana.jpg" alt="Product Image">
              <h3>Ariana Grande</h3>
              <p>MOD Blush Eau de Parfum</p>
              <span class="price"><?php echo format_price(29.989); ?></span>
              <a href="#"  class="btn">Add to Cart</a>
            </div>
            <div class="product">
                <img src="womanimg/carolina.jpg" alt="Product Image">
                <h3>Carolina Herrera</h3>
                <p>Good Girl Blush Eau de Parfum</p>
                <span class="price"><?php echo format_price(19.989); ?></span>
                <a href="#"   class="btn">Add to Cart</a>
             </div>
        
            <div class="product">
                <img src="womanimg/Yves Saint Laurent.jpg" alt="Product Image">
                <h3>Yves Saint Laurent</h3>
                <p>Libre Eau De Parfum</p>
                <span class="price"><?php echo format_price(69.989); ?></span>
                <a href="#" class="btn">Add to Cart</a>
              </div>
        
              <div class="product">
                <img src="womanimg/JIMMY CHOO.jpg" alt="Product Image">
                <h3>JIMMY CHOO</h3>
                <p>I want Choo Eau de Parfum</p>
                <span class="price"><?php echo format_price(33.989); ?></span>
                <a href="#"  class="btn">Add to Cart</a>
              </div>
        
              <div class="product">
                <img src="womanimg/Prada.jpg" alt="Product Image">
                <h3>Prada</h3>
                <p>Paradoce Eau de Parfum</p>
                <span class="price"><?php echo format_price(59.989); ?></span>
                <a href="#" id="addToCartBtn" class="btn">Add to Cart</a>
              </div>

              <div class="product">
                <img src="womanimg/Gucci.jpg" alt="Product Image">
                <h3>Gucci</h3>
                <p>Gardenia Eau de Parfum</p>
                <span class="price"><?php echo format_price(49.989); ?></span>
                <a href="#" class="btn">Add to Cart</a>
              </div>
            </div>

      

            <div id="warmandspicy" >
              <h3 class="ntitle" >Warm And Spicy</h3>
             
                <div class="product">
                <img src="womanimg/blackopium.jpg" alt="Product Image">
                <h3>Yves Saint Laurent</h3>
                <p>Black Opium Eau de Parfum</p>
                <span class="price"><?php echo format_price(35.989); ?></span>
                <a href="#"  class="btn">Add to Cart</a>
                </div>
          
                <div class="product">
                <img src="womanimg/burberry.jpg" alt="Product Image">
                <h3>BURBERRY</h3>
                <p>Burberry Goddess Eau de Parfum</p>
                <span class="price"><?php echo format_price(39.989); ?></span>
                <a href="#"  class="btn">Add to Cart</a>
                </div>
          
                <div class="product">
                <img src="womanimg/Ariana Grande.jpg" alt="Product Image">
                <h3>Ariana Grande</h3>
                <p>Cloud Eau de Parfum</p>
                <span class="price"><?php echo format_price(24.989); ?></span>
                <a href="#" class="btn">Add to Cart</a>
                </div>
                <div class="product">
                  <img src="womanimg/PHLUR.jpg" alt="Product Image">
                  <h3>PHLUR</h3>
                  <p>Body & Hair Fragrance Mist</p>
                  <span class="price"><?php echo format_price(39.989); ?></span>
                  <a href="#" class="btn">Add to Cart</a>
               </div>
          
                <div class="product">
                  <img src="womanimg/Kayali.jpg" alt="Product Image">
                  <h3>Kayali</h3>
                  <p>Vanilla Candy Rock Sugar</p>
                  <span class="price"><?php echo format_price(29.989); ?></span>
                  <a href="#" class="btn">Add to Cart</a>
                </div>
          
                <div class="product">
                  <img src="womanimg/opiumred.jpg" alt="Product Image">
                  <h3>Yves Saint Laurent</h3>
                  <p>Black Opium Eau de Parfum</p>
                  <span class="price"><?php echo format_price(39.989); ?></span>
                  <a href="#" class="btn">Add to Cart</a>
                </div>
          
                <div class="product">
                  <img src="womanimg/mod.jpg" alt="Product Image">
                  <h3>Ariana Grande</h3>
                  <p>MOD Vanilla Eau de Parfum</p>
                  <span class="price"><?php echo format_price(52.989); ?></span>
                  <a href="#" class="btn">Add to Cart</a>
                </div>
  
                <div class="product">
                  <img src="womanimg/download.jpg" alt="Product Image">
                  <h3>Viktor&Rolf</h3>
                  <p>Flowerbomb Eau de Parfum</p>
                  <span class="price"><?php echo format_price(49.989); ?></span>
                  <a href="#"  class="btn">Add to Cart</a>
                </div>
              </div>

              <div id="fruitscent" >
                <h3 class="ntitle" >Fruit Scent</h3>
               
                  <div class="product">
                  <img src="womanimg/tomfordpeach.jpg" alt="Product Image">
                  <h3>Tom Ford Bitter Peach</h3>
                  <p>Bitter Peach Eau De Parfum Fragrance</p>
                  <span class="price">$350.99</span>
                  <a href="#"  class="btn">Add to Cart</a>
                  </div>
            
                  <div class="product">
                  <img src="womanimg/cherry.jpg" alt="Product Image">
                  <h3>Tom Ford</h3>
                  <p>Fucking Fabulous Eau de Parfum Fragrance</p>
                  <span class="price"><?php echo format_price(399.989); ?></span>
                  <a href="#"  class="btn">Add to Cart</a>
                  </div>
            
                  <div class="product">
                  <img src="womanimg/vanile.jpg" alt="Product Image">
                  <h3>Tom Ford Lost Cherry</h3>
                  <p>Lost Cherry Eau de Parfum Fragrance</p>
                  <span class="price"><?php echo format_price(240.989); ?></span>
                  <a href="#" class="btn">Add to Cart</a>
                  </div>
                  <div class="product">
                    <img src="womanimg/tom.png" alt="Product Image">
                    <h3>Neroli Portofino Perfume</h3>
                    <p>Citruc floral cent</p>
                    <span class="price"><?php echo format_price(239.989); ?></span>
                    <a href="#" class="btn">Add to Cart</a>
                 </div>
              </div>

            </section>

            <footer>
                <p>&copy; <?php echo $GLOBALS['current_year'] . ' ' . $GLOBALS['site_name']; ?></p>
              </footer> 
              <script>

const cartItems = document.querySelector('.cart-items');

let itemCount = 0;


const addToCartButtons = document.querySelectorAll('.btn');


addToCartButtons.forEach(button => {
  button.addEventListener('click', () => {
   
    itemCount++;
    
   
    cartItems.textContent = itemCount;
  });
});

$(function(){

  $("#menu").hide();
      
      $("#menuBtn").on("mouseenter",function(){
        $("#menu").slideDown(500);
      });
      
    });



          </script>
        
          
    </body>
</html>