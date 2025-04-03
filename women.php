<?php
// Krijimi i klasës Perfume
class Perfume {
    protected $name;
    protected $price;
    protected $category;

    public function __construct($name, $price, $category) {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCategory() {
        return $this->category;
    }

    public function displayPerfume() {
        echo "<div class='product'>
                <h3>{$this->name}</h3>
                <p>Kategoria: {$this->category}</p>
                <span class='price'>\${$this->price}</span>
                <a href='#' class='btn'>Add to Cart</a>
              </div>";
    }
}

// Klasa për parfume luksoze
class LuxuryPerfume extends Perfume {
    private $brand;

    public function __construct($name, $price, $category, $brand) {
        parent::__construct($name, $price, $category);
        $this->brand = $brand;
    }

    public function displayPerfume() {
        echo "<div class='product'>
                <h3>{$this->name} ({$this->brand})</h3>
                <p>Kategoria: {$this->category}</p>
                <span class='price'>\${$this->price}</span>
                <a href='#' class='btn'>Add to Cart</a>
              </div>";
    }
}

// Krijimi i objekteve të parfumeve
$perfumes = [
    new LuxuryPerfume("Chanel No.5", 120, "Floral", "Chanel"),
    new LuxuryPerfume("Dior Sauvage", 150, "Spicy", "Dior"),
    new Perfume("Tom Ford Lost Cherry", 240, "Fruity"),
    new Perfume("YSL Black Opium", 130, "Spicy"),
    new Perfume("Prada Luna Rossa", 110, "Luxury"),
];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women</title>
    <link rel="stylesheet" href="women.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="logo">Online Shop</div>
        <nav>
            <ul>
                <li><a href="Website.html">Homepage</a></li>
                <li><a href="#">Women</a></li>
                <li><a href="men.html">Men</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contactus.html">Contact</a></li>
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
        <button id="menuBtn">SCENTES</button>
        <ul id="menu" class="start">
            <li><a href="#floralscent">Floral Scent</a></li>
            <li><a href="#warmandspicy">Warm and Spicy</a></li>
            <li><a href="#fruitscent">Fruit Scent</a></li>
            <li><a href="#phpperfumes">Luxury Perfumes</a></li>
        </ul>
    </section>

    <section class="products">
        <h2 style="font-size: 60px;">Featured Products</h2>

        <!-- Seksioni i parfumeve nga PHP -->
        <div id="phpperfumes">
            <h3 class="ntitle">Luxury Perfumes (PHP)</h3>
            <?php foreach ($perfumes as $perfume): ?>
                <?php $perfume->displayPerfume(); ?>
            <?php endforeach; ?>
        </div>

        <!-- Seksionet ekzistuese të parfumeve statike -->
        <div id="floralscent">
            <h3 class="ntitle">Floral Scent</h3>
            <div class="product">
                <img src="womanimg/valentino2.jpg.png" alt="Product Image">
                <h3>Valentino</h3>
                <p>Born In Roma Eau de Parfum</p>
                <span class="price">$35.99</span>
                <a href="#" class="btn">Add to Cart</a>
            </div>
            <!-- Produktet e tjera statike -->
        </div>

        <!-- Seksione të tjera statike -->
    </section>

    <footer>
        <p>&copy; 2024 Online Shop</p>
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
            $("#menuBtn").on("mouseenter", function(){
                $("#menu").slideDown(500);
            });
        });
    </script>
</body>
</html>