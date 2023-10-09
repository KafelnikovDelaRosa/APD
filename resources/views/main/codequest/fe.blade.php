<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APD - Front End Challenge</title>
        <link rel = "stylesheet" href = "fe.css">
        <link rel = "icon" href = "apdicon.png">
    </head>
    <body>
     @if(!session('success'))
        <script>
            window.location.href="/loginpage";
        </script>
    @endif
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

    <div class = "row">
        <div class = "col left">
            <label><i class="fa-brands fa-html5"></i>HTML</label>
            <textarea id = "html" onkeyup = "run()"></textarea>

            <label><i class="fa-brands fa-css3-alt"></i>CSS</label>
            <textarea id = "css" onkeyup = "run()"></textarea>

            <label><i class="fa-brands fa-square-js"></i>JavaScript</label>
            <textarea id = "js" onkeyup = "run()"></textarea>
        </div>

        <div class = "col right">
            <label><i class="fa-solid fa-code"></i>Output</label>
            <iframe id = "output"></iframe>
        </div>
    </div>

    <script>
        function run() {
            let htmlCode = document.getElementById("html").value;
            let cssCode = document.getElementById("css").value;
            let jsCode = document.getElementById("js").value;
            let output = document.getElementById("output");

            output.contentDocument.body.innerHTML = htmlCode + "<style>" + cssCode + "</style>";
            output.contentWindow.eval(jsCode);
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>