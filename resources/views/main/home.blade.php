<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "apdicon.png">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>APD - Home</title>
</head>
<body>

    <header>
        <nav>
            <img src = "apdicon.png" alt = "APD Logo" class = "logo">
            <ul>
                <li class = "home">
                    <a href = "/home">Home</a>
                </li>
                <li class = "cq">
                    <a href = "/codequest">Code Quest</a>
                </li>
                <li class = "news">
                    <a href = "/news">News</a>
                </li>
                <li class = "about">
                    <a href = "/about">About</a>
                </li>
                <li class = "profile">
                    <a href = "/profile"><i class="fa-solid fa-address-card"></i></a>
                </li>
                <li class = "hamburger">
                    <a href = "#">
                        <div class = "bar"></div>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <img src="hero/BG1.png" data-speedx = "0.05" data-speedy = "0.05" class = "parallax bg">
        <img src="hero/Guy2.png" data-speedx = "0.18" data-speedy = "0.18" class = "parallax guy2">
        <img src="hero/Girl1.png" data-speedx = "0.15" data-speedy = "0.005" class = "parallax girl1">
        <img src="hero/APD.png" data-speedx = "0.118" data-speedy = "0.118" class = "parallax apd">
        <img src="hero/Table.png" data-speedx = "0.13" data-speedy = "0.08" class = "parallax table">
        <img src="hero/Guy1.png" data-speedx = "0.18" data-speedy = "0.18" class = "parallax guy1">
    </main>    

    <script src = "home.js"></script>
</body>
</html>