<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medium Clone</title>
    <link rel="stylesheet" href="medium.css">
</head>
<body>
    <header>
        <div class="logo">ByRead</div>
        <nav>
            <ul class="nav-links">
                <li><a href="about.php">Our story</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="sign-up.php">Write</a></li>
                <li><a href="sign-up.php">Sign in</a></li>
                <li><a href="sign-up.php"><button class="btn">Get started</button></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>Cerita & Ide Manusia</h1>
            <p>Sebuah Tempat membaca, menulis, dan memperdalam pemahaman Anda</p>
            <a href="sign-up.php"><button class="btn">Mulai Membaca</button></a>
        </section>
    </main>
    <script>
        document.querySelector('.btn').addEventListener('click', function() {
            alert('Button clicked!');
        });
    </script>
</body>
</html>
