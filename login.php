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
          <form id="loginForm">
            <div class="input-field">
              <input type="text" id="username" required>
              <label>Username</label>
            </div>
            <div class="input-field">
              <input type="password" id="password" required>
              <label>Password</label>
            </div>
            <button type="submit" class="btn">Login</button>
            <button type="reset" class="btn">Reset</button>
            <div id="error-message" style="color: #eacaca;display:none;">Both fields are required.</div>
          </form>

          //Kam shtuar një formular të thjeshtë login-i me verifikimin e emrit të përdoruesit dhe fjalëkalimit.
          <?php
          $loginMessage="";
          $messageClass="";

          if(isset($_POST['username'])&&isset($POST['password'])){
            $username=$_POST['username'];
            $password=$_POST['password'];

            if($username==="admin"&&$password==="12345"){
              $loginMessage = "Welcome Admin!";
                $messageClass = "success-message";
              } else {
                $loginMessage = "Invalid username or password.";
                $messageClass = "error-message";
              }
          }

          if($loginMessage !=""){
            echo "<p class='$messageClass'>$loginMessage</p>";
          }
        ?>
        
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $("#loginForm").submit(function(e) {
          e.preventDefault();
          var username = $("#username").val();
          var password = $("#password").val();

          if(username === "" || password === "") {
            $("#error-message").show();
          } else {
            $("#error-message").hide();
            alert("Form Submitted!");
          }
        });
      });
    </script>
  </body>
</html>