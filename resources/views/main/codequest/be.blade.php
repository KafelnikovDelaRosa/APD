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
                        @php
                            $colorDiff='';
                        @endphp
                        @foreach($question as $content)
                            @php
                                $diff=$content->difficulty;
                                switch($diff){
                                    case 'easy':
                                        $colorDiff="green";
                                        break;
                                    case 'medium':
                                        $colorDiff="orange";
                                        break;
                                    case 'hard':
                                        $colorDiff="red";
                                        break;
                                }
                            @endphp
                            <h1>{{$content->title}}</h1>
                            <h5 style='color:{{$colorDiff}};text-transform:capitalize'>{{$diff}}</h5>
                            <br>
                            <p>{{$content->description}}</p>
                            <br>
                            @if(!empty($content->graphics))
                                <img src="{{$content->graphics}}" alt="image">
                                <br>
                            @endif
                            @if(isset($content->input)&&$content->input!='null')
                                <h4>Expected Input</h4>
                                <p>{{$content->input}}</p>
                                <br>
                            @endif
                                <h4>Expected Output</h4>
                                <p>{{$content->output}}</p>
                                <br>
                            @if(isset($content->followup)&&$content->followup!='null')
                                <h4>Follow Up Question</h4>
                                <p>{{$content->followup}}</p>
                            @endif 
                        @endforeach 
                    </div>
                </div>
                <div class="code">
                    <div class="code-container">
                        <div class="line-number"></div>
                        <div class="code-content">
                            <textarea spellcheck="false" class="code-input" style="resize:none;height:25px;" oninput="updateLineNumbers()">
                            </textarea>
                        </div>
                    </div>
                    <div class="console-container">

                    </div>
                </div>
            </div>
        </div> 
    <script>
//***********************************Code events and functions here************************************************************************
        const codeEvent=document.querySelector('.code-input');
        codeEvent.addEventListener('keydown',(event)=>{
            const line=updateLineNumbers();
            console.log(line);
            if(event.keyCode==13){
                const codeInputHeight=parseInt(codeEvent.style.height);
                codeEvent.style.height=codeInputHeight+25+"px";
            }
            if(event.keyCode==8&&line.length!=1&&line[line.length-1]===''){
                const codeInputHeight=parseInt(codeEvent.style.height);
                codeEvent.style.height=(codeInputHeight)-25+"px";
            }
        });
        function updateLineNumbers() {
            const codeInput=document.querySelector('.code-input');
            const lineNumbers=document.querySelector('.line-number');
            const lines=codeInput.value.split('\n');
            console.log(lines);
            let lineNumberHTML = '';
            for (let i = 1; i <= lines.length; i++) {
                lineNumberHTML += i + '<br>';
            }
            lineNumbers.innerHTML=lineNumberHTML;
            return lines;
        }
        // Initialize line numbers on page load
        updateLineNumbers();
//***********************************Console events and functions here*********************************************************************
        const button = document.querySelector('.btn-submit');
        const language= document.querySelector('#programming-language');
        const consoleContainer= document.querySelector('.console-container');
        button.addEventListener('click',(event)=>{
            const codeInput=document.querySelector('.code-input');
            let fields={};
            fields['content']=codeInput.value;
            fields['language']=language.value;
            console.log(fields);
            saveTempProgram(fields);           
        });
        function saveTempProgram(fields){
            $.ajax({
                type:"POST",
                url:"http://localhost:3000/save-code",
                data:JSON.stringify({
                    'content':fields.content,
                    'language':fields.language
                }),
                contentType:'application/json',
                success:function(response){
                    if(response.success){
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
                type:"POST",
                url:"http://localhost:3000/run-code",
                data:JSON.stringify({
                    'language':language
                }),
                contentType:'application/json',
                success:function(response){
                    if(response.success){
                        console.log(response);
                        consoleContainer.textContent=response.result;
                    }
                    else{
                        consoleContainer.textContent=response.error;
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