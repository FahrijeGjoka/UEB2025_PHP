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
        <form id="signup-form">
          <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" id="name" required>
            <label for="name">Name</label>
            <div class="underline"></div>
           
          </div>
          <div class="input-container">
            <i class="fas fa-calendar-alt"></i>
            <input type="date" id="dob" required>
            <label for="dob"></label>
            <div class="underline"></div>
         
          </div>
          <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" required>
            <label for="email">Email</label>
            <div class="underline"></div>
         
          </div>
          <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" required>
            <label for="password">Password</label>
            <div class="underline"></div>
            <span id="password-error"></span>
          </div>
          <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="confirm-password" required>
            <label for="confirm-password">Password</label>
            <div class="underline"></div>
            <span 
            class="error-message" id="confirm-password-error"></span>
          </div>
          <div class="input-container">
            <i class="fas fa-phone"></i>
            <input type="tel" id="phone" pattern="[0-9]{10}" required>
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