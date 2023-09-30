<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "apdicon.png">
    <link rel="stylesheet" href="admin/adminnews.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>APD Admin - News</title>
</head>
<body>

<div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="fa-solid fa-user-secret"></i>
                <span>APD SecretOffice</span>
            </div>
            <i class="fa-solid fa-bars" id = "btn"></i>
        </div>
        <div class="user">
            <img src = "admin/admins/201910416.jpg" alt="secret-user" class = "user-img">
            <div class="">
                <p class = "bold">Jeremiah V.</p>
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

    <div class = "container">
        <form id = "article">
            <input class = "form-control" type = "text" id = "title" for = "title" placeholder = "Article Title">
            <input class = "form-control" type = "text" id = "content" for = "content" placeholder = "Article Content">
            <input class = "form-control" type = "text" id = "author" for = "author" placeholder = "Article Author">
            <input class = "form-control" type = "file" id = "images" for = "images">

            <button class="btn btn-warning" type = "submit" id = "post">Post Article</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Attach a click event handler to the "Save changes" button
            $("#post").click(function (e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = {
                        title: $("#title").val(),
                        content: $("#content").val(),
                        author: $("#author").val()
                };

                // Send an AJAX request to update the profile
                $.ajax({
                    type: "POST",
                    url: "/post",
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            // Display a success message or perform any desired actions
                            console.log("Article Posted Successfully");
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Article Posted',
                                showConfirmButton: true,
                                timer: 2500
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            // Handle errors if necessary
                            console.error("Article Posting Failed");
                        }
                    },
                    error: function () {
                        // Handle errors if necessary
                        console.error("Article Posting Failed");
                    }
                });
            });
        });

        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function () {
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>