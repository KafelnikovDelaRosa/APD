<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "/apdicon.png">
    <link rel="stylesheet" href = "/admin/admincodequest.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>APD SecretOffice: Challenges</title>
</head>
<body>
    @if(!session('adminsuccess'))
        <script>
            window.location.href="/loginpage";
        </script>
    @endif
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="fa-solid fa-user-secret"></i>
                <span>APD SecretOffice</span>
            </div>
            <i class="fa-solid fa-bars" id = "btn"></i>
        </div>
        <div class="user">
            <img src = "{{ Auth::guard('admins')->user()->avatar??'Image not set'}}" alt="secret-user" class = "user-img">
            <div class="">
                <p class = "bold">{{Auth::guard('admins')->user()->firstname??'Firstname not set'}}</p>
                <p>Admin</p>
            </div>
        </div>
        <ul>
            <li>
                <a href = "/admindashboard">
                    <i class="fa-solid fa-grip"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href = "/adminchallenges">
                    <i class="fa-solid fa-font-awesome"></i>
                    <span class="nav-item">Challenges</span>
                </a>
                <span class="tooltip">Challenges</span>
            </li>
            <li>
                <a href = "/adminsubmissions">
                    <i class="fa-solid fa-file-code"></i>
                    <span class="nav-item">Submissions</span>
                </a>
                <span class="tooltip">Submissions</span>
            </li>
            <li>
                <a href = "/adminnews">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="nav-item">News</span>
                </a>
                <span class="tooltip">News</span>
            </li>
            <li>
                <a href = "/adminusers">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-item">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
            <li>
                <a href = "/adminadmins">
                    <i class="fa-solid fa-user-secret"></i>
                    <span class="nav-item">Admins</span>
                </a>
                <span class="tooltip">Admins</span>
            </li>
            <li>
                <a href = "/adminlogout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <h1><a href="/adminchallenges">Challenges</a>/<a href="/adminchallenges/multiplechoice">Multiple Choice</a>/Edit</h1>
        <div class="container">
            <form class='form-container'>
                @foreach($quiz as $content)
                    <label for="title">Title</label>
                    <input type="text" id="title" value="{{$content->title}}">
                    <small style="color:red" id="title-error"></small>
                    <br>
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Write something.." style="height:60px;resize:none;font-size:1rem;">{{$content->description}}</textarea>
                    <small style="color:red" id="description-error"></small>
                    <br>
                    Questions
                    <div class="question-container">
                    </div>
                    <br>
                    <small style="color:red" id="questions-error"></small>
                    <input onclick="addQuestion()" style="padding:1rem" id="addBtn" type="button" value="Add Question">
                    <br>
                    <label for="difficulty">Difficulty</label>
                    <select id="difficulty" value="{{$content->difficulty}}">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                    <br>
                    <input id='submitForm' style="padding:1rem" type="button" value="Submit">
                @endforeach
            </form>
        </div>
    </div>
    <script>
        let btn=document.querySelector('#btn');
        let sidebar=document.querySelector('.sidebar');
        btn.onclick = function () {
            sidebar.classList.toggle('active');
        }
        //retrieve quesitions
        let jsonQuestions=@json($choice);
        function addQuestion(){
            jsonQuestions.push({
                numb:jsonQuestions.length+1,
                question:'',
                answer:'',
                options:['','','','']
            });
            console.log(jsonQuestions);
            displayQuestion();
        }
        function retrieveQuestion(){
            let queryContainer=document.querySelector(".question-container");
            let queryForms=queryContainer.querySelectorAll(".question-form");
            jsonQuestions.forEach(question=>{
                console.log(question);
                let tag='';
                if(question.numb==1){
                    tag=`
                        <div class="question-form" id="${question.numb}">
                            <p>Question ${question.numb}</p>
                            <textarea id="Q${question.numb}" oninput="textAreaEvent(${question.numb})" style="height:60px;width:100%;resize:none;font-size:1rem;">${question.question}</textarea>
                            <p>Choices</p>
                        <input type="text" style="width:100%;" placeholder="Choice 1" oninput="inputEvent(${question.numb},0)" value="${question.options[0]}" id="Q${question.numb}-C1">
                            <input type="text" style="width:100%;" placeholder="Choice 2" oninput="inputEvent(${question.numb},1)" value="${question.options[1]}" id="Q${question.numb}-C2">
                            <input type="text" style="width:100%;" placeholder="Choice 3" oninput="inputEvent(${question.numb},2)" value="${question.options[2]}" id="Q${question.numb}-C3">
                            <input type="text" style="width:100%;" placeholder="Choice 4" oninput="inputEvent(${question.numb},3)" value="${question.options[3]}" id="Q${question.numb}-C4">
                            <p>Correct Answer</p>
                            <input type="text" style="width:100%;" placeholder="Correct Answer" oninput="inputAnswerEvent(${question.numb})" value="${question.answer}" id="CA${question.numb}">
                            <br><br>
                        </div>
                    `;
                }
                else{
                    tag=`
                        <div class="question-form" id="${question.numb}">
                            <p>Question ${question.numb}</p>
                            <textarea id="Q${question.numb}" oninput="textAreaEvent(${question.numb})" style="height:60px;width:100%;resize:none;font-size:1rem;">${question.question}</textarea>
                            <p>Choices</p>
                            <input type="text" style="width:100%;" placeholder="Choice 1" oninput="inputEvent(${question.numb},0)" value="${question.options[0]}" id="Q${question.numb}-C1">
                            <input type="text" style="width:100%;" placeholder="Choice 2" oninput="inputEvent(${question.numb},1)" value="${question.options[1]}" id="Q${question.numb}-C2">
                            <input type="text" style="width:100%;" placeholder="Choice 3" oninput="inputEvent(${question.numb},2)" value="${question.options[2]}" id="Q${question.numb}-C3">
                            <input type="text" style="width:100%;" placeholder="Choice 4" oninput="inputEvent(${question.numb},3)" value="${question.options[3]}" id="Q${question.numb}-C4">
                            <p>Correct Answer</p>
                            <input type="text" style="width:100%;" placeholder="Correct Answer" oninput="inputAnswerEvent(${question.numb})" value="${question.answer}" id="CA${question.numb}">
                            <br><br>
                            <input onclick="removeQuestion(${question.numb})" style="padding:1rem;width:100%" type="button" value="Remove Question">
                        </div>
                    `;
                }
                $(queryContainer).append(tag);
            });
        }
        function displayQuestion(){
            let queryContainer=document.querySelector(".question-container");
            let queryForms=queryContainer.querySelectorAll(".question-form");
            let index=0;
            queryForms.forEach(form=>{
                form.remove();
            })
            jsonQuestions.forEach(question=>{
                let tag='';
                if(question.numb==1){
                    tag=`
                        <div class="question-form" id="${question.numb}">
                            <p>Question ${question.numb}</p>
                            <textarea id="Q${question.numb}" oninput="textAreaEvent(${question.numb})" style="height:60px;width:100%;resize:none;font-size:1rem;">${question.question}</textarea>
                            <p>Choices</p>
                            <input type="text" style="width:100%;" placeholder="Choice 1" oninput="inputEvent(${question.numb},0)" value="${question.options[0]}" id="Q${question.numb}-C1">
                            <input type="text" style="width:100%;" placeholder="Choice 2" oninput="inputEvent(${question.numb},1)" value="${question.options[1]}" id="Q${question.numb}-C2">
                            <input type="text" style="width:100%;" placeholder="Choice 3" oninput="inputEvent(${question.numb},2)" value="${question.options[2]}" id="Q${question.numb}-C3">
                            <input type="text" style="width:100%;" placeholder="Choice 4" oninput="inputEvent(${question.numb},3)" value="${question.options[3]}" id="Q${question.numb}-C4">
                            <p>Correct Answer</p>
                            <input type="text" style="width:100%;" placeholder="Correct Answer" oninput="inputAnswerEvent(${question.numb})" value="${question.answer}" id="CA${question.numb}">
                            <br><br>
                        </div>
                    `;
                }
                else{
                    tag=`
                        <div class="question-form" id="${question.numb}">
                            <p>Question ${question.numb}</p>
                            <textarea id="Q${question.numb}" oninput="textAreaEvent(${question.numb})" style="height:60px;width:100%;resize:none;font-size:1rem;">${question.question}</textarea>
                            <p>Choices</p>
                            <input type="text" style="width:100%;" placeholder="Choice 1" oninput="inputEvent(${question.numb},0)" value="${question.options[0]}" id="Q${question.numb}-C1">
                            <input type="text" style="width:100%;" placeholder="Choice 2" oninput="inputEvent(${question.numb},1)" value="${question.options[1]}" id="Q${question.numb}-C2">
                            <input type="text" style="width:100%;" placeholder="Choice 3" oninput="inputEvent(${question.numb},2)" value="${question.options[2]}" id="Q${question.numb}-C3">
                            <input type="text" style="width:100%;" placeholder="Choice 4" oninput="inputEvent(${question.numb},3)" value="${question.options[3]}" id="Q${question.numb}-C4">
                            <p>Correct Answer</p>
                            <input type="text" style="width:100%;" placeholder="Correct Answer" oninput="inputAnswerEvent(${question.numb})" value="${question.answer}" id="CA${question.numb}">
                            <br><br>
                            <input onclick="removeQuestion(${question.numb})" style="padding:1rem;width:100%" type="button" value="Remove Question">
                        </div>
                    `;
                }
                $(queryContainer).append(tag);
                index++;
            });
        }
        retrieveQuestion();
        function inputEvent(numb,index){
            const choice=index+1;
            const valueSelector="#Q"+numb+"-C"+choice;
            const valueContent=document.querySelector(valueSelector);
            jsonQuestions[numb-1].options[index]=valueContent.value;
        }
        function textAreaEvent(index){
            const valueSelector="#Q"+index;
            jsonQuestions[index-1].question=$(valueSelector).val();
        }
        function inputAnswerEvent(index){
            const valueSelector="#CA"+index;
            const valueContent=document.querySelector(valueSelector);
            jsonQuestions[index-1].answer=valueContent.value;
            console.log(jsonQuestions);
        }
        function removeQuestion(numb){
            let count=0;
            jsonQuestions.forEach(questions=>{
                if(questions.numb==numb){
                    jsonQuestions.splice(count,1);
                }
                count++;
            })
            count=1;
            jsonQuestions.forEach(questions=>{
                questions.numb=count;
                count++;
            })
            console.log(jsonQuestions);
            displayQuestion();
        }
        function validateTitle(title){
            if(title.length==0){
                $("#title-error").text("Title is required!");
                return false;
            }
            $("#title-error").text("");
            return true;
        }
        function validateDescription(description){
            if(title.length==0){
                $("#description-error").text("Description is required!");
                return false;
            }
            $("#description-error").text("");
            return true;
        }
        function validateQuestions(questions){
            if(questions.length==0){
                $("#questions-error").text("Question(s) is required!");
                return false;
            }
            $("#questions-error").text("");
            return true;
        }
        function submitFormData(formData){
            $.ajax({
                type:"POST",
                url:"/update-multiplechoice-post",
                data:formData,
                processData: false,
                contentType: false,
                success:function(response){
                    if(response.success){
                        Swal.fire({
                            icon:'success',
                            title:'Question successfully updated',
                            confirmButtonText: 'Confirm',
                            customClass:{
                                confirmButton:'change-width-confirm-button',
                            },
                        }).then((result) =>{
                            if(result.isConfirmed){
                                window.location.href='/adminchallenges/multiplechoice'
                            }
                        });
                    }
                },
                error:function(error){
                    console.error("Posting multiplechoice error ",error);
                }
            })
        }
        $('#submitForm').click(()=>{
            let formData= new FormData();
            formData.append('id',{{$idValue}});
            formData.append('title',$("#title").val());
            formData.append('description',$("#description").val());
            formData.append('questions',JSON.stringify(jsonQuestions));
            formData.append('difficulty',$("#difficulty").val());
            formData.append('points',jsonQuestions.length);
            if(!validateTitle(formData.get('title'))||!validateDescription(formData.get('description'))||!validateQuestions(formData.get('questions'))){
                return;
            }
            submitFormData(formData);
        });
    </script>
</body>
</html>