<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In</title>
  <style>
    /* Reset dan font */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    body {
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }
    .signin-container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      text-align: center;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .signin-container h2 {
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: 600;
    }
    .signin-container input {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }
    .signin-container button {
      width: 100%;
      padding: 10px;
      background: blue;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
    }
    .signin-container button:hover {
      background: darkblue;
    }
    .signin-container .social-login {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
    }
    .signin-container .social-login button {
      border: none;
      background: none;
      cursor: pointer;
      font-size: 24px;
    }
    .signin-container p {
      font-size: 14px;
      margin-top: 10px;
    }
    .signin-container p a {
      color: blue;
      text-decoration: none;
      font-weight: 600;
    }
    .signin-container p a:hover {
      text-decoration: underline;
    }
    .error-message {
      color: red;
      margin-bottom: 10px;
      font-size: 14px;
    }
    
    /* Responsif */
    @media (max-width: 480px) {
      .signin-container {
        padding: 15px;
      }
      .signin-container h2 {
        font-size: 20px;
      }
      .signin-container input, 
      .signin-container button {
        font-size: 14px;
        padding: 8px;
      }
    }
  </style>
</head>
<body>
  <div class="signin-container">
    <h2>Sign In to ByRead</h2>
    <div class="error-message" id="error-message"></div>
    <input type="email" id="email" placeholder="example@mail.com" required>
    <input type="password" id="password" placeholder="Password" required>
    <button id="signin-button">Sign In</button>
    <p><a href="#">Forgot password?</a></p>
    <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
  </div>
  <script>
    document.getElementById('signin-button').addEventListener('click', function(e) {
      e.preventDefault();
      
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value.trim();
      var errorMessage = document.getElementById('error-message');
      
      if (email === '' || password === '') {
        errorMessage.textContent = 'Please fill in both email and password.';
      } else {
        errorMessage.textContent = '';
        // Simulasi validasi login sukses, redirect ke medium.php
        window.location.href = 'medium.php';
      }
    });
  </script>
</body>
</html>
