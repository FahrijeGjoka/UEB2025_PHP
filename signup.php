<?php

define("MIN_PASS_LEN", 8);

$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$phone = $_POST['phone'];

echo "<pre>";
var_dump($_POST);
echo "</pre>"

function isValidEmail($email){
  return preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/", $email);
}

function isValidPassword($password){
  return preg_match("/^[A-Z][a-zA-Z0-9]{7,}$/", $password);
}

function isValidPhone($phone){
  return preg_match("/^[0-9]{10}$/", $phone);
}


class User{
  public $name;
  public $email;
  protected $dob;
  protected $password;

  public function __construct($name, $email, $dob, $password){
    $this->name = $name;
    $this->email = $email;
    $this->dob = $dob;
    $this->password = $password;
  }

  public function getInfo(){
    return "Emri: $this->name <br> Emaili: $this->email <br> Data e lindjes: $this->dob";
  }

  public function setPassword($password){
    if(isValidPassword($password)){
      $this->password = $password;
    }
  }

  public function __destruct(){
    echo "<br><em>Objekti u shkaterrua</em>";
  }

  $errors = [];

  if(!isValidEmail($email)){
    $errors[] = "Email-i nuk eshte valid!";
  }

  if(!isValidPassword($password)){
    $errors[] = "Fjalekalimi duhet te filloje me shkronje te madhe dhe te kete minimumi " . MIN_PASS_LEN . " karaketere";
  }

  if($password !== $confirmPassword){
    $errors[] = "Fjalekalimet nuk perputhen!";
  }

  if (empty($errors)) {
    $user = new User($name, $email, $dob, $password);
    echo "<p><strong>Regjistrimi i kryer me sukses!</strong></p>";
    echo $user->getInfo();
} else {
    echo "<ul style='color: red;'>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "<hr><strong>Te dhenat e derguara:</strong>";
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <div class="form-container">
        <h1>Sign Up</h1>
        <form id="signup-form" method="POST" action="">
          <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" name="name" id="name" required>
            <label for="name">Name</label>
            <div class="underline"></div>
           
          </div>
          <div class="input-container">
            <i class="fas fa-calendar-alt"></i>
            <input type="date" id="dob" name = "dob" required>
            <label for="dob"></label>
            <div class="underline"></div>
         
          </div>
          <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" required>
            <label for="email">Email</label>
            <div class="underline"></div>
         
          </div>
          <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name = "password" required>
            <label for="password">Password</label>
            <div class="underline"></div>
            <span id="password-error"></span>
          </div>
          <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="confirm-password" name="confirmPassword" required>
            <label for="confirm-password">Password</label>
            <div class="underline"></div>
            <span 
            class="error-message" id="confirm-password-error"></span>
          </div>
          <div class="input-container">
            <i class="fas fa-phone"></i>
            <input type="tel" id="phone" pattern="[0-9]{10}" name="phone" required>
            <label for="phone">Phone Number</label>
            <div class="underline"></div>
            
          </div>
          <div class="button-container">
            <button type="submit" class="btn">Sign Up</button>
            <button type="reset" class="btn">Reset</button>
          </div>
        </form>
      </div>
    </div>
    <script src="signup.js"></script>
  </body>
</html>