<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APD - Login</title>
        <link rel = "stylesheet" href = "registerlogin.css">
        <link rel = "icon" href = "apdicon.png">
        <script src="https://kit.fontawesome.com/b3459fa126.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <div class = "row">
        <form>
            <h1>Login</h1>
            <div class="mb-3">
                <label for="studentid" class="form-label">Student Number</label>
                <input type="text" maxlength="9" class="form-control" id="studentid" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
                <small id="error" style="color:red;"></small>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <br><br>
            <a href = "/registerpage" class="mt-2">New to APD? Click here</a>
        </form>
    </div>
    <script>
//*******************************Student Id Listeners and Functions*********************************************************

        const studentId=document.querySelector("#studentid");
        studentId.addEventListener('keypress',(event)=>{
            var letters=/^[A-Za-z]+$/;
            if(event.keyCode==8 || event.keyCode==13){
                return true;
            }
            if(letters.test(event.key)){
                event.preventDefault();
                return false;
            }
        })
//********************************Form Validations**************************************************************************
        function validateStudentNum(studentNum){
            if(studentNum.length==0){
                $("#error").text("Please Fill in The Fields!");
                return false;
            }
            return true;
        }
        function validatePassword(password){
            if(password.length==0){
                $("#error").text("Please Fill in The Fields!");
                return false;
            }
            return true;
        }
        function formHandler(field){
            const forms={
                'studentNum':validateStudentNum(field.studentid),
                'password':validatePassword(field.password)
            };
            if(forms.studentNum&&forms.password){
                checkProfile(field);
            }
        }
//*******************************Form Listeners and Functions***************************************************************
        function checkProfile(field){
            $.ajax({
                type:"POST",
                url:"/login",
                data:{
                    'studentid':field.studentid,
                    'password':field.password
                },
                success:function(response){
                    if(response.success){
                        console.log(response.data);
                        if(response.role==="admin"){
                            window.location.href="/admindashboard";
                        }
                        else{
                            window.location.href="/home";
                        }
                    }
                    else{
                        $("#error").text("Incorrect Credentials!");
                    }
                },
                error:function(error){
                    console.error("Student login request error:",error)
                }
            });
        }
        $("form").submit(function(e){
           e.preventDefault();
           let field={
                studentid:"",
                password:""
           };
           field.studentid=$("#studentid").val();
           field.password=$("#password").val();
           formHandler(field);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>