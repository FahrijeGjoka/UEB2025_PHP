<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="box">
        <div class="overlay"></div>
        <div class="content">
          <h1>Login</h1>

          <?php
           $loginMessage="";
           $messageClass="";
           $jsrespone="";

           class User{
            private $username;
            private $password;

            public function __construct($username, $password){
              $this->username=$username;
              $this->password=$password;
            }

            public function isValid($inputUsername, $inputPasswordd){
              return $this->username===$inputUsername && $this->password===$inputPasswordd;
            }
           }

           if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $inputUsername = $_POST['username'];
            $inputPassword = $_POST['password'];
            $admin = new User("admin", "12345");

            if ($admin->isValid($inputUsername, $inputPassword)) {
                $loginMessage = "Welcome Admin!";
                $messageClass = "success-message";
                $jsResponse = "submitted";
            } else {
                $loginMessage = "Invalid username or password!";
                $messageClass = "error-message";
                $jsResponse = "not-submitted";
            }
        }
          ?>

          <form id="loginForm" method="POST">
            <div class="input-field">
              <input type="text" name="username" id="username" required>
              <label>Username</label>
            </div>
            <div class="input-field">
              <input type="password" name="password" id="password" required>
              <label>Password</label>
            </div>
            <button type="submit" class="btn">Login</button>
            <button type="reset" class="btn">Reset</button>

            <?php if (!empty($loginMessage)): ?>
              <p class="<?php echo $messageClass; ?>"><?php echo $loginMessage; ?></p>
            <?php endif; ?>

            <p id="js-message" style="color:blue;"></p>
          </form>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        const jsResponse = "<?php echo $jsResponse; ?>";

        if (jsResponse === "submitted") {
          $("#js-message").text("Form Submitted!");
        } else if (jsResponse === "not-submitted") {
          $("#js-message").text("Form Not Submitted!");
        }
      });
    </script>
  </body>
</html>