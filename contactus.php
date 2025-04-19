<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $email)) {
        echo '<div class="error-message">Invalid email format.</div>';
    } else {
        echo '<div class="success-message">Thank you! Your email is valid!</div>';
    }
}

if (isset($_POST['products'])) {
  $totalProducts = intval($_POST['products']);
  if ($totalProducts > 0) {
      if ($totalProducts % 2 == 0) {
        echo '<div class="product-message">';
        $each = $totalProducts / 2;
        echo "Great! We assume you bought $each perfumes for women and $each for men.</div>";
      } else {
          $women = floor($totalProducts / 2);
          $men = $totalProducts - $women;
          echo "We'll divide your order as follows: <b>$women for women</b> and <b>$men for men</b>.<br>";
      }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Contact Page</title>
    <link rel="stylesheet" href="contactus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  </head>
  <body>
    <header>
        <div class="logo">Contact Us</div>
        <nav>
          <ul>
            <li><a href="website.php">Homepage</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="men.php">Men</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
        </header>

        <section class="hero">
          <h1>Contact Us</h1>
          <p>We are here to help you find the perfect fragrance</p>
        </section>

        <main>
          <form id="contactForm" action="contactus.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            
            <div class="chkbx">
              <div class="question">
                  Are you interested in women or men perfumes?<br><br>
              </div>
              <div class="options">
                  <label>
                      <input type="checkbox" name="perfume" value="women"> Women
                  </label>
                  <label>
                      <input type="checkbox" name="perfume" value="men"> Men
                  </label>
              </div>
          </div>  

            <div class="rdbtn">
              <div class="write">
                  How was your experience?<br><br>
              </div>
              <div class="options">
                  <label>
                      <input type="radio" name="perfumes" value="excellent"> Excellent
                  </label>
                  <label>
                      <input type="radio" name="perfumes" value="Verygood"> Very good
                  </label>
                  <label>
                    <input type="radio" name="perfumes" value="Good"> Good
                </label>
              </div>
          </div> 

          <div class="products">
            <br>
          <label for="products">How many perfumes did you buy?</label><br>
          <br>
          <input type="number" id="products" name="products" min="1" placeholder="Enter total number" required>
           </div>
           <br>
            <input type="submit" value="Send">
          </form>

          <div class="ul">
            <ul>For more informations, visit our site in:<br>
              <li class="li"><a href="https://facebook.com"><i class="fab fa-facebook"></i> Facebook</a></li>
              <li class="li"><a href="https://instagram.com"><i class="fab fa-instagram"></i> Instagram</a></li>
              <li class="li"><a href="https://tiktok.com"><i class="fab fa-tiktok"></i> TikTok</a></li>
            </ul>
          </div>
  
        </main>
        <footer>
        <p>Rruga Adem Jashari, Prishtine Kosove</p>
        <p>Phone: +383 49 001 001</p>
      </footer>

      <script>
        document.getElementById("contactForm").addEventListener("submit", function(event) {
          const name = document.getElementById("name").value.trim();
          const email = document.getElementById("email").value.trim();
          const message = document.getElementById("message").value.trim();
  
          if (!name || !email || !message) {
            alert("Please fill in all required fields.");
            event.preventDefault();
          } else {
            alert("Thank you! Your form has been submitted successfully.");
          }
        });
      </script>

      </body>
      </html>