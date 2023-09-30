<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APD - Backend Challenge</title>
        <link rel = "stylesheet" href = "be.css">
        <link rel = "icon" href = "apdicon.png">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://kit.fontawesome.com/b3459fa126.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <div class="be-container">
            <div class="be-nav">
                <div class="left-hand">
                    <ul>
                        <li>
                            Description
                        </li>
                    </ul>
                </div>
                <div class="right-hand">
                    <ul>
                        <li>
                            <select id="programming-language">
                                <option>C++</option>
                                <option>Python</option>
                                <option>Node.js</option>
                                <option>Php</option>
                                <option>Java</option>
                            </select>
                        </li>
                        <li>
                            <button class="btn-submit">Submit</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="be-content">
                <div class="question">
                    <div class="content">
                       <h1>FizzBuzz</h1>
                       <p>
                            Given a program that would loop from numbers from 1 to 100, create a condition that would print “Fizz” if the number is divisible by 3 and print “Buzz” if the number is divisible by 5. If both numbers are divisible by 3 and 5, print FizzBuzz, otherwise just print the number. You may use any programming language to solve this problem
                       </p>
                       <br>
                       <h4>Expected Output</h4>
                       <p>
                         1, 2, Fizz, 4, Buzz, ..., 14, FizzBuzz
                       </p>
                       <br>
                       <h4>Follow Up Question</h4>
                       <p>
                            Given a new condition where if the number is divisible by 7 which would print “Comb”, kindly modify the code such that if the number is divisible by 7 and 3 it prints FizzComb or if the number is divisible by 7 and 5 it prints BuzzComb otherwise if both numbers are divisible by 3, 5 and 7 print FizzBuzzComb
                       </p>
                    </div>
                </div>
                <div class="code">
                    <div class="code-content">
                        <ol>
                            <li>
                                <input type="text">
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>