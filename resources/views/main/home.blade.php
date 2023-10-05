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
            <a href = "/home"><img src = "apdicon.png" alt = "APD Logo" class = "logo"></a>
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
        <div class="blurload" style="background-image: url(hero/low/BG1-small.png)">
            <img src="hero/BG1.png" loading="lazy" data-speedx = "0.05" data-speedy = "0.05" class = "parallax bg">
        </div>

        <div class="blurload" style="background-image: url(hero/low/Guy2-small.png)">
            <img src="hero/Guy2.png" loading="lazy" data-speedx = "0.18" data-speedy = "0.18" class = "parallax guy2">
        </div>

        <div class="blurload" style="background-image: url(hero/low/Girl1-small.png)">
            <img src="hero/Girl1.png" loading="lazy" data-speedx = "0.18" data-speedy = "0.015" class = "parallax girl1">
        </div>

        <div class="blurload" style="background-image: url(/hero/low/APD-small.png)">
            <img src="hero/APD.png" loading="lazy" data-speedx = "0.15" data-speedy = "0.15" class = "parallax apd">
        </div>

        <div class="blurload" style="background-image: url(hero/low/Table-small.png)">
            <img src="hero/Table.png" loading="lazy" data-speedx = "0.13" data-speedy = "0.08" class = "parallax table">
        </div>

        <div class="blurload" style="background-image: url(hero/low/Guy1-small.png)">
            <img src="hero/Guy1.png" loading="lazy" data-speedx = "0.18" data-speedy = "0.18" class = "parallax guy1">
        </div>

    </main>    

    <script src="home.js"></script>
<script>
const blurDivs = document.querySelectorAll(".blurload")
blurDivs.forEach(div => {
    const img = div .querySelector("img")

    function loaded(){ 
        div.classList.add("loaded")
    }

    if(img.complete){
        loaded() 
    }   
    else {
        img.addEventListener("load", loaded)
    }
})
</script>
    
</body>
</html>