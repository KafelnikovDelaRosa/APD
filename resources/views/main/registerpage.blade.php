<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>APD - Register</title>
        <link rel = "stylesheet" href = "registerlogin.css">
        <link rel = "icon" href = "apdicon.png">
        <script src="https://kit.fontawesome.com/b3459fa126.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <div class = "row">
        <form>
            <h1>Register</h1>
            <div class="mb-3">
                <label for="studentnumber" class="form-label">Student Number</label>
                <input type="text" value="" maxlength="9" class="form-control" id="studentid" aria-describedby="emailHelp">
                <small id="studnumber-error" style="color:red"></small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control name-field"  id="email">
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control name-field"  id="firstname">
            </div>
            <div class="mb-3">
                <label for="middlename" class="form-label">Middle Name (Optional)</label>
                <input type="text" class="form-control name-field" id="middlename">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control name-field" id="lastname">
                <small id="lastname-error" style="color:red"></small>
            </div>
            <div class="mb-3">
                <label for="yearlevel" class="form-label">Year Level</label>
                <input type="number" value="1" class="form-control" id="yearlevel">
                <small id="yearlevel-error"></small>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program</label>
                <select id="program" class="form-control">
                    <option>BSITWMA</option>
                    <option>BSITAGD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
                <small id="password-error" style="color:red"></small>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword">
                <small id="confirmpassword-error" style="color:red"></small>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <br><br>
            <a href = "/loginpage" class="mt-2">Already have an account</a>
        </form>
    </div>



    <script>
//***********************Student Number Listeners and Functions********************************************
        //create listener on student no field
        const studNumber=document.querySelector("#studentid");
        const studErr=document.querySelector("#studnumber-error");
        //create an event that would not allow the user to enter letters
        studNumber.addEventListener('keypress',(event)=>{
            var letters=/^[A-Za-z]+$/;
            if(event.keyCode==8 || event.keyCode==13){
                return true;
            }
            if(letters.test(event.key)){
                event.preventDefault();
                return false;
            }
        });
        studNumber.addEventListener('input',(event)=>{
            if(studNumber.value===""){
                studErr.textContent="";
            }
            else{
                validateStudentNum(studNumber.value);
            }
        });
        function studentNumExists(num){
            return new Promise(function(resolve,reject){
                $.ajax({
                    type:'GET',
                    url:'/student-num-exists',
                    data:{'studentid':num},
                    success:function(response){
                        let success=response.success
                        resolve(success);
                    },
                    error:function(error){
                        console.error("Student request error: ",error);
                        reject(error);
                    }
                });
            });
        } 
        function validateStudentNum(num) {
            if (!num || typeof num !== 'string') {
                studErr.textContent = "Student number is required!";
                return false;
            }
            if (num.length < 9) {
                studErr.textContent = "Student number must contain at least 9 digits!";
                return false;
            }
            studentNumExists(num)
                    .then(function(result) {
                        if (result) {
                            studErr.textContent = "Student number exists!";
                        } else {
                            studErr.textContent = "";
                        }
                    })
                    .catch(function(error) {
                        console.error("Error in studentNumExists:", error);
                    });
            studErr.textContent="";
            return true;
        }

//**********************************Name Field Listeners and Functions********************************

        //create listener on name fields
        const firstname=document.querySelector("#firstname");
        const middlename=document.querySelector("#middlename");
        const lastname=document.querySelector("#lastname");
        const firstnameErr=document.querySelector("#firstname-error");
        const lastnameErr=document.querySelector("#lastname-error");
        function validateFirstname(firstname){
            if(firstname.length==0){
                firstnameErr.textContent="Firstname field is required!";
                return false;
            }
            return true;
        }
        firstname.addEventListener("keypress",(event)=>{
            var numbers=/^[0-9]+$/;
            if(event.keyCode==8 || event.keyCode==13){
                return true;
            }
            if(numbers.test(event.key)){
                event.preventDefault();
                return false;
            }
        })
        firstname.addEventListener("input",(event)=>{
            if(firstname.value===""){
                firstnameErr.textContent="";
            }
            else{
                validateFirstname(firstname.value);
            }
        });
        middlename.addEventListener("keypress",(event)=>{
            var numbers=/^[0-9]+$/;
            if(event.keyCode==8 || event.keyCode==13){
                return true;
            }
            if(numbers.test(event.key)){
                event.preventDefault();
                return false;
            }
        });
        function validateLastname(lastname){
            if(lastname.length==0){
                lastnameErr.textContent="Lastname field is required!";
                return false;
            }
            lastnameErr.textContent="";;
            return true;
        }
        lastname.addEventListener("keypress",(event)=>{
            var numbers=/^[0-9]+$/;
            if(event.keyCode==8 || event.keyCode==13){
                return true;
            }
            if(numbers.test(event.key)){
                event.preventDefault();
                return false;
            }
        })
        lastname.addEventListener("input",()=>{
            if(lastname.value===""){
                lastnameErr.textContent="";
            }
            else{
                validateLastname(lastname.value);
            }
        });

//***********************Year Level Listeners and Functions********************************************

        const yearLevel=document.querySelector("#yearlevel");
        const yearLevelErr=document.querySelector("#yearlevel-error");
        function validateYearLevel(yearLevel){
            if(yearLevel.length==0){
                yearLevelErr.textContent="Year level field is required!";
                return false;
            }
            yearLevelErr.textContent="";
            return true;
        }
        yearLevel.addEventListener("change",()=>{
            if(yearLevel.value>=5){
                yearLevel.value=5;
            }
            if(yearLevel.value<1){
                yearLevel.value=1;
            }
            if(yearLevel.value===""){
                yearLevel.value="";
            }
            else{
                validateYearLevel(yearLevel.value);
            }
        })

//**********************Password And Config Password Listeners and Functions***************************

        const password=document.querySelector("#password");
        const confPass=document.querySelector("#confirmpassword");
        const passwordErr=document.querySelector("#password-error");
        const confPassErr=document.querySelector("#confirmpassword-error");
        //initialize confPass to be disabled;
        confPass.disabled=true;
        function validatePassword(pass){
            if(pass.length==0){
                passwordErr.textContent="Password field is required!";
                return false;
            }
            if(pass.length<8){
                passwordErr.textContent="Password must contain at least 8 characters";
                return false;
            }
            passwordErr.textContent="";
            return true;
        }
        password.addEventListener('change',()=>{
            if(password.value===""){
                confPass.disabled=true;
                confPass.value="";
                confPass.textContent="";
            }
            else{
                confPass.disabled=false;
            }
        });
        password.addEventListener('input',()=>{
            if(password.value===""){
                passwordErr.textContent="";
            }
            else{
                validatePassword(password.value);
            }
        });
        function validateConfirmPassword(confPass){
            if(confPass.length===0){
                confPassErr.textContent="Confirm password field is required!";
            }
            if(confPass!=password.value){
                confPassErr.textContent="Both passwords do not match!";
                return false;
            }
            confPassErr.textContent="";
            return true;
        }
        confPass.addEventListener('change',()=>{
            if(confPass.value===""){
                confPass.textContent="";
            }
            else{
                validateConfirmPassword(confPass.value);
            }
        })
//**********************Submit listeners and functions*************************************************
        //create listeners and function for the password and config password
        function validateFields(fields){
            let result={
                studentField:(validateStudentNum(fields.studentid)?true:false),
                emailField:(validateStudentNum(fields.email)?true:false),
                firstnameField:(validateFirstname(fields.firstname)?true:false),
                lastnameField:(validateLastname(fields.lastname)?true:false),
                passwordField:(validatePassword(fields.password)?true:false),
            }
            let isValid=true;
            for(let key in result){
                if(result[key]==false){
                    isValid=false;
                }
            }
            if(isValid){
                addUser(fields);
            }
        }
        function addUser(fields){
            $.ajax({
                    type:'POST',
                    url:'/register',
                    data:fields,
                    success:function(response){
                        if(response.success){
                            console.log('User successfully registered!');
                            window.location.href="registersuccess";
                        }
                    },
                    error:function(error){
                        console.error("Student regisration request error: ",error);
                    }
            });
        }
        $("form").submit(function(e){
            e.preventDefault();
            let field = {
              studentid:"",
              email:"",
              firstname:"",
              middlename:"",
              lastname:"",
              yearlevel:"",
              program:"",
              password:""
            };
            field.studentid = $('#studentid').val();
            field.email = $('#email').val();
            field.firstname = $('#firstname').val();
            field.middlename = $('#middlename').val();
            field.lastname = $('#lastname').val();
            field.yearlevel = $('#yearlevel').val();
            field.program = $('#program').val();
            field.password = $('#password').val();
            validateFields(field);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>