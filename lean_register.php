<?php
$nameErr = $emailErr = $genderErr = $stateErr = $phnoErr = $ageErr = "";
$name = $email = $gender = $state = $phno = $ageErr = "";

if(isset($_POST["submit"])){
    $break = 0;

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $break = 1;
    } else {
        $name = validate_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
            $break = 1;
        }
    }
    if (empty($_POST["phno"])) {
        $phnoErr = "Phone number is required";
        $break = 1;
    } else {
        $phno = validate_input($_POST["phno"]);
        if (!preg_match('/^[0-9]{10}+$/',$phno)) {
            $phnoErr = "Only 10 digits numbers are valid";
            $break = 1;
        }
    }

    if ($_POST['dob']) {
        $date2=date("d-m-Y");//today's date
        $dd = $_POST['dob'];
        $date1=new DateTime($dd);
        $date2=new DateTime($date2);
        $interval = $date1->diff($date2);
        $myage= $interval->y;

        if ($myage < 10){
            $ageErr = "You must be over 10 years of age to register!";
            $break = 1;
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $break = 1;
    } else {
        $email = validate_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $break = 1;
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $break = 1;
    } else {
        $gender = validate_input($_POST["gender"]);
    }

    if($break == 0){
        $mail = $_POST['email'];
        $pass = $_POST['pwd'];
        $nam = $_POST['name'];
        $phn = $_POST['phno'];
        $age = $myage;
        // $myage
        $aadh = $_POST['state'];

        $con=mysqli_connect('localhost','root','^_^iambatman') or die(mysqli_error());
        mysqli_select_db($con, 'Lean_proj') or die("cannot select DB");

        $query=mysqli_query($con, "SELECT * FROM dashboard_login WHERE email='".$mail."'");
        $numrows=mysqli_num_rows($query);
        if($numrows == 0){
            $sql="INSERT INTO dashboard_login (email,password,age,name,phno,state) VALUES ('$mail','$pass','$age','$nam','$phn','$aadh')";
            if(mysqli_query($con,$sql)){
                echo "Account Successfully Created";
                header("refresh:0.6; url=lean_login.php");
            } else {
                echo "Failure!";
                echo $sql;
            }
        } else {
            echo "That username already exists! Please try again with another.";
        }
    }
}
function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!doctype html>
<html>
    <head>
    <title>Register</title>
    <style>
        /* The message box is shown when the user clicks on the password field */
        #message {
            display:none;
            color: #fff;
            position: relative;
            padding: 0px;
            margin-top: 10px;
        }
        #message p {
            padding: 0px 35px;
            font-size: 16px;
        }
        .error{
            color: #ff4c4c;
        }
        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: #4ce600;
        }
        .valid:before {
            position: relative;
            left: -20px;
            content: "✔";
        }
        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: #ff4c4c;
        }
        .invalid:before {
            position: relative;
            left: -20px;
            content: "✖";
        }


        body{
            color: white;
            background-color: #121212;
        }
        #form_section{
            width:60%;
            margin: 50px auto 50px auto;
            padding: 30px;
            border: 1px #0080ff solid;
            border-radius: 5px;
            /* box-shadow: 0px 8px 16px 0px #0080ff; */
            -webkit-transition : box-shadow 1000ms ease-out;
            -moz-transition : box-shadow 1000ms ease-out;
            -o-transition : box-shadow 1000ms ease-out;
        }
        #form_section:hover{
            border : 1px solid #0080ff;
            box-shadow: 0px 8px 16px 0px #0080ff;
        }
        #titles{
            text-align: center;
            border-bottom: 1px #bbb solid;
        }
        .form_1{
            padding: 30px 0px 0px 0px;
        }
        .fields{
            padding: 10px;
            border-radius: 4px;
            background-color: #3f3f3f;
            margin: 5px;
        }
        #submit{
            width: 100%;
            border: 1px #0080ff solid;
            border-radius: 5px;
            color: #121212;
            font-weight: bold;
            background-color: #0080ff;
            padding: 10px;
        }
        #submit:hover{
            color:#0080ff;
            background-color: #121212;
            transition-duration: 0.4s;
            box-shadow:0 4px 16px -3px #0080ff;
        }
        #titles{
            width: 70%;
            text-align: center;
            border-bottom: 1px #bbb solid;
            margin: auto;
            padding: 10px;
        }
        #signin_button{
            width:20%;
            position: relative;
            margin: 0% 40% 0% 40%;
            border: 1px #0080ff solid;
            border-radius: 5px;
            /* box-shadow: 0px 8px 16px 0px #0080ff; */
            -webkit-transition : box-shadow 1000ms ease-out;
            -moz-transition : box-shadow 1000ms ease-out;
            -o-transition : box-shadow 1000ms ease-out;
            -webkit-transition : background-color 500ms ease-out;
            -moz-transition : background-color 500ms ease-out;
            -o-transition : background-color 500ms ease-out;
            padding: 10px;
            background-color: #0080ff;
            color: #121212;
            font-weight: bold;
        }
        #signin_button:hover{
            border : 1px solid #0080ff;
            background-color: #121212;
            box-shadow: 0px 8px 16px 0px #ff4c4c;
            color: #0080ff;
        }
    </style>
    </head>
    <body>
        <div id="form_section">
            <div id="titles">
                <h1>Data visualisation and analysis on COVID-19 in India and in your state</h1>
                <p>
                    <i>Register and enjoy exclusive benefits and features we provide on our site </i>
                </p>
                <h1>Welcome</h1>
            </div>
            <form action="" method="POST" name="form_1" id="form_1">
                <div class="fields">
                    <label>Name: </label>
                    <input name="name" id="name" class="name" type="text" /><span class="error">* <?php echo $nameErr;?></span><br />
                </div>

                <div class="fields">
                    <label>E-mail address: </label>
                    <input placeholder="example@gmail.com" name="email" id="email" class="email" type="text" /><span class="error">* <?php echo $emailErr;?></span><br />
                </div>

                <div class="fields">
                    <label>Phone number: </label>
                    <input placeholder="xxxxxxxxxx" name="phno" id="phno" class="phno" type="number" /><span class="error">* <?php echo $phnoErr;?></span><br />
                </div>

                <div class="fields">
                    <label>State: </label>
                    <select name="state" id="state" class="state" class="form-control">
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Puducherry">Puducherry</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select><span class="error">* <?php echo $stateErr;?></span><br />
                </div>

                <div class="fields">
                    <label>Date of birth: </label>
                    <input name="dob" id="dob" class="dob" type="date" required/><span class="error">* <?php echo $ageErr;?></span><br />
                </div>

                <div class="fields">
                    <label>Gender: </label>
                    <input type="radio" name="gender" value="female">Female
                    <input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="other">Other
                    <span class="error">* <?php echo $genderErr;?></span><br />
                </div>

                <div class="fields">
                    <label>Password: </label>
                    <input name="pwd" id="pwd" class="pwd" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/><span class="error">*</span><br />
                    <div id="message">
                        <h3>Password must meet the following conditions:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b></p>
                        <p id="capital" class="invalid">An <b>uppercase</b></p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
                </div>

                <input id="submit" class="submit" name="submit" type="submit" value="Register"/>
            </form>
        </div>

        <p>
            <center><i>Already a user? Sign-in</i></center>
        </p>
        <a href="lean_login.php"><button name="signin_button" id="signin_button">Sign in</button></a>

        <script>
            var myInput = document.getElementById("pwd");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");
            // When the user clicks on the password field, show the message box
            myInput.onfocus = function() {
                document.getElementById("message").style.display = "block";
            }
            // When the user clicks outside of the password field, hide the message box
            myInput.onblur = function() {
                document.getElementById("message").style.display = "none";
            }
            // When the user starts to type something inside the password field
            myInput.onkeyup = function() {
                // Validate lowercase letters
                var lowerCaseLetters = /[a-z]/g;
                if(myInput.value.match(lowerCaseLetters)) {
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }
                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if(myInput.value.match(upperCaseLetters)) {
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }
                // Validate numbers
                var numbers = /[0-9]/g;
                if(myInput.value.match(numbers)) {
                    number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }
                // Validate length
                if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
            }
        </script>
    </body>
</html>
