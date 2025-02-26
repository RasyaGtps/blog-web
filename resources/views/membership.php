<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByRead Clone - Our Story & Membership</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Georgia', serif;
        }

        a {
            text-decoration: none;
            color: black;
        }

        body {
            background-color: #ffffff;
            color: #000;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 16px;
        }
        .btn {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 16px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 50px;
        }
        .content {
            max-width: 50%;
        }
        .content h1 {
            font-size: 64px;
            font-weight: bold;
            line-height: 1.2;
        }
        .content p {
            font-size: 20px;
            margin: 20px 0;
            color: #555;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons .btn {
            margin-right: 10px;
            padding: 15px 30px;
            font-size: 18px;
        }
        .image-section {
            max-width: 50%;
        }
        .image-section img {
            width: 100%;
            border-radius: 10px;
        }
        .membership-section {
            padding: 50px;
        }
        .membership-content {
            display: flex;
            justify-content: space-between;
        }
        .membership-content h1 {
            font-size: 64px;
            font-weight: bold;
        }
        .membership-text {
            max-width: 60%;
        }
        .membership-item {
            margin-top: 40px;
        }
        .membership-item h2 {
            font-size: 32px;
        }
        .membership-item p {
            font-size: 20px;
            color: #555;
        }
        .unlock-section {
            background-color: #e8f2d2;
            text-align: center;
            padding: 100px 20px;
        }
        .unlock-section h1 {
            font-size: 48px;
            font-weight: bold;
        }
        .unlock-section .btn {
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            .nav-links {
                flex-direction: column;
                gap: 10px;
            }
            .container, .membership-content {
                flex-direction: column;
                text-align: center;
            }
            .content, .image-section, .membership-text {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="welcome.blade.php"><div class="logo">ByRead</div></a>
        <nav>
            <ul class="nav-links">
                <li><a href="about.php">Our story</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="sign-in.php">Write</a></li>
                <li><a href="sign-in.php">Sign in</a></li>
                <li><button class="btn">Get started</button></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="our-story" class="container">
            <div class="content">
                <h1>Support human stories</h1>
                <p>Become a member to read without limits or ads, fund great writers, and join a global community of people who care about high-quality storytelling.</p>
                <div class="buttons">
                    <button class="btn">Get started</button>
                    <button class="btn" style="background-color: white; color: black; border: 1px solid black;">View plans</button>
                </div>
            </div>
        </div>
        <div id="membership" class="membership-section">
            <div class="membership-content">
                <h1>Why membership?</h1>
                <div class="membership-text">
                    <div class="membership-item">
                        <h2>Reward writers</h2>
                        <p>Keanggotaan Anda secara langsung mendukung para penulis, editor, kurator, dan tim yang menjadikan ByRead sebagai rumah yang dinamis dan inklusif bagi kisah-kisah manusia.</p>
                    <div class="membership-item">
                        <h2>Unlock every story</h2>
                        <p>Dapatkan akses ke jutaan cerita orisinal yang memicu ide cemerlang, menjawab pertanyaan besar, dan mendorong ambisi yang berani.</p>
                    </div>
                    <div class="membership-item">
                        <h2>Enhance your reading experience</h2>
                        <p>Benamkan diri Anda dalam cerita audio, baca secara offline ke mana pun Anda pergi, dan terhubung dengan komunitas ByRead di Mastodon.</p>
                    </div>
                    <div class="membership-item">
                        <h2>Elevate your writing</h2>
                        <p>Buat dan berkontribusi pada publikasi untuk berkolaborasi dengan penulis lain, buat domain khusus untuk profil Anda, dan tingkatkan tulisan Anda dengan alat penerbitan kami yang sederhana namun canggih.</p>
                    </div>
                    <div class="membership-item">
                        <h2>Support a mission that matters</h2>
                        <p>Para anggota menciptakan dunia tempat berkembangnya kisah-kisah orisinal buatan manusia. Sebagai platform yang didukung anggota, kualitas adalah yang utama, bukan iklan atau clickbait.</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>    
        <div class="unlock-section">
            <h1>Unlock a world of wisdom</h1>
            <button class="btn">Get started</button>
        </div>
    </main>
    <footer>
        &copy; 2025 ByRead Clone. All rights reserved.
    </footer>
    <script>
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                alert('Button clicked!');
            });
        });
    </script>
</body>
</html>
