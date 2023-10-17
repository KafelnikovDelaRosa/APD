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
        <h1><a href="/adminchallenges">Challenges</a>/<a href="/adminchallenges/backend">Backend</a>/Post</h1>
        <div class="container">
            <form class='form-container'>
                <label for="title">Title</label>
                <input type="text" id="title">
                <small style="color:red" id="title-error"></small>
                <br>
                <label for="description">Description</label>
                <textarea id="description" placeholder="Write something.." style="height:60px;resize:none;font-size:1rem;"></textarea>
                <small style="color:red" id="description-error"></small>
                <br>
                <label for="image">Graphics (Optional)</label>
                <input type="file" id="image">
                <br>
                <label for="input">Expected Input (Optional)</label>
                <textarea id="input" placeholder="Write something.." style="height:60px;resize:none;font-size:1rem"></textarea>
                <br>
                <label for="output">Expected Output</label>
                <textarea id="output" placeholder="Write something.." style="height:60px;resize:none;font-size:1rem"></textarea>
                <small style="color:red" id="output-error"></small>
                <br>
                <label for="followup">Follow Up Question (Optional)</label>
                <textarea id="followup" placeholder="Write something.." style="height:60px;resize:none;font-size:1rem"></textarea>
                <br>
                <label for="difficulty">Difficulty</label>
                <select id="difficulty">
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
                <br>
                <input id='submitForm' style="padding:1rem" type="button" value="Submit">
            </form>
        </div>
    </div>


    <script>
        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function () {
            sidebar.classList.toggle('active');
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
            if(description.length==0){
                $("#description-error").text("Description is required!");
                return false;
            }
            $("#description-error").text("");
            return true;
        }
        function validateOutput(output){
            if(output.length==0){
                $("#output-error").text("Expected output is required!");
                return false;
            }
            $("#output-error").text("");
            return true;
        }
        function formHandler(formData){
            formValid={
                title:validateTitle(formData.title),
                description:validateDescription(formData.description),
                output:validateOutput(formData.output),
            }
            if(formValid.title==false||formValid.description==false||formValid.output==false){
                return;
            }
            submitFormData(formData);
        }
        function submitFormData(formData){
            console.log(formData);
           $.ajax({
                type:"POST",
                url:"/post-backend",
                data:{
                    'title':formData.title,
                    'description':formData.description,
                    'graphics':formData.graphics,
                    'input':formData.input,
                    'output':formData.output,
                    'followup':formData.followup,
                    'difficulty':formData.difficulty,
                    'points':formData.points,
                    'status':formData.status
                },
                success:function(response){
                    if(response.success){
                        Swal.fire({
                            icon:'success',
                            title:'Question successfully stored',
                            confirmButtonText: 'Confirm',
                            customClass:{
                                confirmButton:'change-width-confirm-button',
                            },
                        }).then((result) =>{
                            if(result.isConfirmed){
                                window.location.href='/adminchallenges/backend'
                            }
                        });
                    }
                },
                error:function(error){
                    console.error('Backend posting error ',error)
                }
           });
        }
        $('#submitForm').click(()=>{
            let formData={
                title:'',
                description:'',
                graphics:null,
                input:null,
                output:'',
                followup:null,
                difficulty:'',
                points:0,
                status:'inactive',
            };
            formData.title=$('#title').val();
            formData.description=$('#description').val();
            formData.input=($('#input').val()==="")?null:$('#input').val();
            formData.output=$('#output').val();
            formData.followup=($('#followup').val()==="")?null:$('#followup').val();
            formData.difficulty=$('#difficulty').val();
            formData.points=(formData.difficulty==='easy')?10:(formData.difficulty==='medium')?20:30;
            formHandler(formData);
        })
    </script>


</body>
</html>