<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByRead</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            text-decoration: none;
            color:black;
        }
        
        body {
            background-color: #fff;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: white;
            border-bottom: 1px solid #ddd;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .navbar .buttons {
            display: flex;
            gap: 10px;
        }
        .navbar button {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        .navbar button.signup {
            background: black;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            display: flex;
            margin-top: 20px;
        }
        .content {
            flex: 2;
            padding: 20px;
        }
        .sidebar {
            flex: 1;
            padding: 20px;
            border-left: 1px solid #ddd;
        }
        .article {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .article h2 {
            font-size: 20px;
            font-weight: bold;
        }
        .article p {
            color: #666;
            font-size: 16px;
        }
        .staff-picks {
            margin-bottom: 20px;
        }
        .staff-picks h3 {
            font-size: 18px;
            font-weight: bold;
        }
        .staff-picks ul {
            list-style: none;
            padding: 0;
        }
        .staff-picks li {
            margin-top: 10px;
        }
        .recommended-topics {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .recommended-topics span {
            background: #f1f1f1;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php"><div class="logo">Medium</div></a>
        <div class="buttons">
            <a href="sign-up.php"><button>Write</button></a>
            <a href="sign-up.php"><button>Sign in</button></a>
            <button class="signup">Sign up</button>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="article">
                <h2>Panduan Lengkap Pemula tentang Cara Menghasilkan Uang dengan Menulis Artikel</h2>
                <p>Ini untuk Anda jika Anda belum pernah mendapatkan satu sen pun seumur hidup Anda dari menulis—tetapi Anda menginginkannya.</p>
                <small>17 Des 2023 • 29 ribu penayangan • 921 komentar</small>
            </div>
            <div class="article">
                <h2>Jangan Menganggap Hidup Terlalu Serius, Itu Juga Tidak Menganggap Anda Serius</h2>
                <p>Menganggap hidup dengan serius itu konyol.</p>
                <small>17 Des 2023 • 29 ribu penayangan • 921 komentar</small>
            </div>
            <div class="article">
                <h2>Jangan Menganggap Hidup Terlalu Serius, Itu Juga Tidak Menganggap Anda Serius</h2>
                <p>Menganggap hidup dengan serius itu konyol.</p>
                <small>17 Des 2023 • 29 ribu penayangan • 921 komentar</small>
            </div>
            <div class="article">
                <h2>Jangan Menganggap Hidup Terlalu Serius, Itu Juga Tidak Menganggap Anda Serius</h2>
                <p>Menganggap hidup dengan serius itu konyol.</p>
                <small>17 Des 2023 • 29 ribu penayangan • 921 komentar</small>
            </div>
        </div>
        <div class="sidebar">
            <div class="staff-picks">
                <h3>Staff Picks</h3>
                <ul>
                    <li><strong>Via Negativa and Negative Capability</strong> - Sarah Firth</li>
                    <li><strong>The day I got a ketamine infusion while my house burned down.</strong> - Kate Alexandria</li>
                    <li><strong>‘The Adopted’: I visited a WW2 soldier’s home in Michigan to see what he sacrificed</strong> - Rob O’Brien</li>
                </ul>
            </div>
            <div class="recommended-topics">
                <h3>Recommended topics</h3>
                <span>Programming</span>
                <span>Self Improvement</span>
                <span>Data Science</span>
                <span>Writing</span>
            </div>
        </div>
    </div>
</body>
</html>
