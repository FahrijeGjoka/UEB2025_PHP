<?php
          $loginMessage="";
          $messageClass="";

          if(isset($_POST['username'])&&isset($_POST['password'])){
            $username=$_POST['username'];
            $password=$_POST['password'];

            if($username==="admin"&&$password==="12345"){
              $loginMessage = "Welcome Admin!";
                $messageClass = "success-message";
              } else {
                $loginMessage = "Invalid username or password!";
                $messageClass = "error-message";
              }
          }

          if($loginMessage !=""){
            echo "<p class='$messageClass'>$loginMessage</p>";
          }
        ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>
    <div class="container">
      <div class="box">
        <div class="overlay"></div>
        <div class="content">
          <h1>Login</h1>
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
          </form>
          
          <?php
          $loginMessage="";
          $messageClass="";

          if(isset($_POST['username'])&&isset($_POST['password'])){
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