<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "apdicon.png">
    <link rel="stylesheet" href="codequest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>APD - Home</title>
</head>
<body>
    @if(!session('success'))
        <script>
            window.location.href="/loginpage";
        </script>
    @endif
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
    <div class = "title"><h1>Pick a Challenge!</h1></div>
    <div class="start_btn">
        <button id = "mc">Multiple Choice</button>
        <button id = "fe">Front-End</button>
        <button id = "be">Back-End</button>
    </div>

    <script>
        const mc_btn = document.getElementById('mc');
        const fe_btn = document.getElementById('fe');
        const be_btn = document.getElementById('be');

        mc_btn.addEventListener('click', function () {
            window.location.href = '/mpcq';
        });

        fe_btn.addEventListener('click', function () {
            window.location.href = '/fe';
        });

        be_btn.addEventListener('click', function () {
            window.location.href = '/be';
        });

    </script>
    
</body>
</html>