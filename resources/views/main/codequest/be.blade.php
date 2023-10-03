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
                                <option value='cpp'>C++</option>
                                <option value='py'>Python</option>
                                <option value='js'>Node.js</option>
                                <option value='php'>Php</option>
                                <option value='java'>Java</option>
                            </select>
                        </li>
                        <li>
                            <button class="btn-submit">Run</button>
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
                    <div class="code-container">
                        <ol>
                            <li>
                                1
                            </li>
                        </ol>
                        <textarea id="written-code-content" style="resize:none" cols=200>
                        </textarea>
                    </div>
                    <div class="console-container">

                    </div>
                </div>
            </div>
        </div> 
    <script>
//***********************************Code events and functions here************************************************************************
        const specialChars=['Enter','Backspace','Shift','Control','ArrowUp','ArrowDown','ArrowLeft','ArrowRight'];
        const textArea = document.querySelector('#written-code-content');
        var rowCol={};
        textArea.addEventListener('keydown', (event) => {
            if(event.key=="Enter"){
                newLine();
                getRowCol();
            }
            if(event.key=="Backspace"&&rowCol.col==1&&rowCol.row!=1){
                removeLine();
                getRowCol();
            }
            if(event.key===undefined){
                event.preventDefault();
            }
            else{
                getRowCol();
            }
        });
        textArea.addEventListener('click',()=>{
            getRowCol();
        })
        textArea.addEventListener('focus', () => {
            // Trigger the input event to display the initial cursor position
            textArea.dispatchEvent(new Event('keydown'));
        });
        /*textArea.addEventListener('paste',()=>{
            textArea.dispatchEvent(new Event('input'));
        })
        function pasteCodes(row){
            const ol=document.querySelector(".code-container ol");
            const pastedList=document.createElement("li");
            for(let i=0;i<(row+1);i++){
                ol.append(pastedList);
            }
            updateLineOrder();
        }*/
        function getRowCol(){
            const row = textArea.value.substr(0, textArea.selectionStart).split('\n').length;
            const col = textArea.selectionStart - textArea.value.lastIndexOf('\n', textArea.selectionStart - 1);
            rowCol['row']=row;
            rowCol['col']=col;
            console.log(row,col);
        }
        function updateLineOrder(){
            const ol=document.querySelector('.code-container ol');
            const li=ol.querySelectorAll('li');
            let liIndex=1;
            li.forEach((liItem)=>{
                liItem.textContent=liIndex;
                liIndex++;
            })
        }
        function newLine(){
            const ol=document.querySelector(".code-container ol");;
            const newList=document.createElement("li");
            ol.append(newList);
            updateLineOrder();
        }
        function removeLine(){
            const ol=document.querySelector(".code-container ol");
            const liToRemove=ol.querySelector(`li:last-child`);
            liToRemove.remove();
            updateLineOrder();
        }
//***********************************Console events and functions here*********************************************************************
        const button = document.querySelector('.btn-submit');
        const language= document.querySelector('#programming-language');
        const consoleContainer= document.querySelector('.console-container');
        button.addEventListener('click',(event)=>{
            let fields={};
            fields['content']=textArea.value;
            fields['language']=language.value;
            console.log(fields);
            saveTempProgram(fields);           
        });
        function saveTempProgram(fields){
            $.ajax({
                type:"POST",
                url:"/save-code",
                data:{
                    'content':fields.content,
                    'language':fields.language
                },
                success:function(response){
                    if(response.success){
                        console.log('File temporarily stored Running the Program!');
                        consoleContainer.textContent=response.result;
                        runCode(fields.language);
                    }
                    else{
                        console.log('File failed to store!');
                    }
                },
                error:function(error){
                    console.error("Saving program request error ",error);
                }
            });
        }
        function runCode(language){
             $.ajax({
                type:"GET",
                url:"/run-code",
                data:{
                    'language':language
                },
                success:function(response){
                    if(response.success){
                        consoleContainer.textContent=response.result;
                        textArea.focus();
                    }
                    else{
                        consoleContainer.textContent=response.error;
                        textArea.focus();
                    }
                },
                error:function(error){
                    console.error("Running request error ",error);
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>