<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByRead Clone</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            text-decoration: none;
            color:white;
        }
        body {
            background-color: #121212;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #121212;
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
            border: 1px solid white;
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            cursor: pointer;
        }
        .navbar button.signup {
            background: white;
            color: black;
        }
        .hero {
            text-align: left;
            max-width: 800px;
            margin-top: 50px;
        }
        .hero h1 {
            font-size: 56px;
            font-weight: bold;
            line-height: 1.2;
        }
        .hero p {
            font-size: 18px;
            margin-top: 20px;
            line-height: 1.5;
            color: #b3b3b3;
        }

        .options {
            width: 100%;
            max-width: 800px;
            margin-top: 50px;
        }
        .option {
            background: #1e1e1e;
            padding: 20px;
            border: 1px solid #444;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        .option:hover {
            background: #333;
        }
        .option span {
            font-size: 32px;
        }

        .footer {
            width: 100%;
            text-align: center;
            padding: 20px;
            background: #fff;
            color: black;
            margin-top: 50px;
        }
        .footer .links {
            margin-top: 10px;
            font-size: 14px;
        }
        .footer .links a {
            color: black;
            margin: 0 10px;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 40px;
            }
            .hero p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php"><div class="logo">ByRead</div></a>
        <div class="buttons">
            <a href="sign-up.php"><button>Sign in</button></a>
            <a href="sign-up.php"><button class="signup">Sign up</button></a>
        </div>
    </div>
    <div class="hero">
        <h1>Everyone has a story to tell</h1>
        <p>ByRead adalah rumah bagi cerita dan ide manusia. Di sini, siapa pun dapat berbagi pengetahuan dan kebijaksanaan dengan dunia—tanpa harus membangun milis atau pengikut terlebih dahulu. Internet berisik dan kacau; ByRead itu tenang namun penuh wawasan. Sederhana, indah, kolaboratif, dan membantu Anda menemukan pembaca yang tepat untuk apa pun yang Anda katakan.</p>
        <h1>Ultimately, our goal is to deepen our collective understanding of the world through the power of writing.</h1>
        <p>Kami percaya bahwa apa yang Anda baca dan tulis itu penting. Kata-kata dapat memecah belah atau memberdayakan kita, menginspirasi atau mematahkan semangat kita. Di dunia di mana cerita yang paling sensasional dan hanya di permukaan sering kali menang, kami membangun sistem yang menghargai kedalaman, nuansa, dan waktu yang dihabiskan dengan baik. Ruang untuk percakapan yang penuh pemikiran lebih dari sekedar perjalanan, dan substansi dibandingkan kemasan.</p>
        <br>
        <p>Lebih dari 100 juta orang terhubung dan berbagi kebijaksanaan mereka di ByRead setiap bulannya. Mereka adalah pengembang perangkat lunak, novelis amatir, perancang produk, CEO, dan siapa pun yang tertarik dengan cerita yang mereka perlukan untuk dipublikasikan. Mereka menulis tentang apa yang sedang mereka kerjakan, apa yang membuat mereka terjaga di malam hari, apa yang telah mereka jalani, dan apa yang telah mereka pelajari yang mungkin juga ingin diketahui oleh kita semua.</p>
        <br>
        <p>Daripada menjual iklan atau menjual data Anda, kami didukung oleh komunitas yang berkembang dengan lebih dari satu juta anggota ByRead yang percaya pada misi kami. Jika Anda baru di sini, mulailah membaca. Selami lebih dalam apa pun yang penting bagi Anda. Temukan postingan yang membantu Anda mempelajari sesuatu yang baru, atau mempertimbangkan kembali sesuatu yang familiar—lalu tulis cerita Anda.</p>
    </div>
    <div class="options">
        <div class="option">Start reading <span>&rarr;</span></div>
        <div class="option">Start writing <span>&rarr;</span></div>
        <div class="option">Become a member <span>&rarr;</span></div>
    </div>
    <div class="footer">
        <div class="logo">ByRead</div>
        <div class="links">
            <a href="#">About</a>
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Help</a>
            <a href="#">Teams</a>
            <a href="#">Press</a>
        </div>
</body>
</html>
