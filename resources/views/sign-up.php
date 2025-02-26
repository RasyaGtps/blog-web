<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
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
        }
        .signup-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            text-align: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .signup-container h2 {
            margin-bottom: 20px;
        }
        .signup-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .signup-container button {
            width: 100%;
            padding: 10px;
            background: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .signup-container .social-login {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .signup-container .social-login button {
            border: none;
            background: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up to ByRead</h2>
        <input type="email" placeholder="example@mail.com">
        <input type="password" placeholder="Password">
        <button>Sign Up</button>
        <p>Have an account? <a href="sign-in.php">Sign in</a></p>
    </div>
</body>
</html>
