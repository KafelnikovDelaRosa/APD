<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "apdicon.png">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>APD - Home</title>
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
    
    <div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <img class="img-account-profile rounded-circle mb-2" src="{{ Auth::user()->avatar }}" alt="" id = "avatar">
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <input id = "uploadAvatar" type = "file" class = "form-control" name = "avatar">
                    <button class="btn btn-warning" type="button" id = "upload">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form id = "accountDetails">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="studentid">Student Number</label>
                                <input class="form-control" for="studentid" id="studentid" type="text" placeholder="Enter your Student Number" value="{{ Auth::user()->studentid }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" for="email" id="email" type="text" placeholder="Enter your Email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">                
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputFirstName">First Name</label>
                                <input class="form-control" for="inputFirstName" id="inputFirstName" type="text" placeholder="Enter your First Name" value="{{ Auth::user()->firstname }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="middlename">Middle Name</label>
                                <input class="form-control" for="middlename" id="middlename" type="text" placeholder="Enter your Middle Name" value="{{ Auth::user()->middlename }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="lastname">Last Name</label>
                                <input class="form-control" id="lastname" type="text" placeholder="Enter your Last Name" value="{{ Auth::user()->lastname }}" disabled>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="yearlevel">Year Level</label>
                                <input class="form-control" for="yearlevel" id="yearlevel" type="text" placeholder="Enter your Year Level" value="{{ Auth::user()->yearlevel }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="program">Program</label>
                                <input class="form-control" for="program" id="program" type="text" placeholder="Enter your Program" value="{{ Auth::user()->program }}">
                            </div>
                        </div>
                        <button class="btn btn-warning" type="submit" id="saveChangesButton">Save changes</button>
                        <button class="btn btn-warning" type="button" id="signOutButton">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    // Attach a click event handler to the "Sign Out" button
    $("#signOutButton").click(function () {
        // Send an AJAX request to log the user out
        $.ajax({
            type: "POST",
            url: "/signOut", // Update the URL to the actual logout route
            data: {},
            success: function (response) {
                // Redirect the user to the login page after successful logout
                window.location.href = "/loginpage"; // Update the URL as needed
            },
            error: function () {
                // Handle errors if necessary
                console.error("Logout failed");
            }
        });
    });
});

$(document).ready(function () {
    // Attach a click event handler to the "Save changes" button
    $("#saveChangesButton").click(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = {
                email: $("#email").val(),
                yearlevel: $("#yearlevel").val(),
                program: $("#program").val()
        };

        // Send an AJAX request to update the profile
        $.ajax({
            type: "POST",
            url: "/updateProfile",
            data: formData,
            success: function (response) {
                if (response.success) {
                    // Display a success message or perform any desired actions
                    console.log("Profile updated successfully");
                } else {
                    // Handle errors if necessary
                    console.error("Profile update failed");
                }
            },
            error: function () {
                // Handle errors if necessary
                console.error("Profile update failed");
            }
        });
    });
});

$(document).ready(function () {
    // Attach a click event handler to the "Upload new image" button
    $("#upload").click(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData();
        formData.append("avatar", $("#uploadAvatar")[0].files[0]);

        // Send an AJAX request to update the profile photo
        $.ajax({
            type: "POST",
            url: "/uploadPhoto",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    // Display a success message or perform any desired actions
                    console.log("Photo uploaded successfully");
                } else {
                    // Handle errors if necessary
                    console.error("Photo upload failed");
                }
            },
            error: function () {
                // Handle errors if necessary
                console.error("Photo upload failed");
            }
        });
    });
});


</script>
</body>
</html>