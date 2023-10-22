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
        <h1><a href="/adminchallenges">Challenges</a>/<a href="/adminchallenges/frontend">Frontend</a>/Edit</h1>
        <div class="container">
            <form class='form-container'>
                @foreach($values as $value)
                    <label for="title">Title</label>
                    <input type="text" id="title" value="{{$value->title}}">
                    <small style="color:red" id="title-error"></small>
                    <br>
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Write something.." style="height:60px;resize:none;font-size:1rem;">{{$value->description}}</textarea>
                    <small style="color:red" id="description-error"></small>
                    <br>
                    <label for="graphics">Video or Image of Expected Output</label>
                    <input type="file" name="graphics" id="graphics-id">
                    <small style="color:red" id="graphics-error"></small>
                    <br>
                    <label for="difficulty">Difficulty</label>
                    <select id="difficulty">
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
        function submitFormData(formData) {
            $.ajax({
                type: "POST",
                url: "/update-frontend-post",
                data: formData, // FormData object
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Question successfully updated',
                            confirmButtonText: 'Return',
                            customClass:{
                                confirmButton:'change-width-confirm-button',
                            },
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/adminchallenges/frontend';
                            }
                        });
                    }
                },
                error: function (error) {
                    // Handle errors if necessary
                    console.error("Posting frontend challenge error", error);
                }
            });
        }
        $('#submitForm').click(()=>{
            let formData = new FormData();
            formData.append("id",{{$idValue}});
            formData.append("title", $('#title').val());
            formData.append("description", $('#description').val());
            const graphicFile=($('#graphics-id')[0].files[0]==undefined)?null:$('#graphics-id')[0].files[0];
            formData.append("graphics",graphicFile)
            formData.append("difficulty", $('#difficulty').val());
            formData.append("points", formData.get("difficulty") === 'easy' ? 10 : formData.get("difficulty") === 'medium' ? 20 : 30);
            formData.append("status", 'inactive');

            // Client-side validation
            if (!validateTitle(formData.get("title")) || !validateDescription(formData.get("description"))) {
                return;
            }

            // Submit the form
            submitFormData(formData);
        })
    </script>


</body>
</html>