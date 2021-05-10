<?php
    if(isset($_POST["submit"])){
        if(!empty($_POST['email']) && !empty($_POST['pwd'])) {
            $email = $_POST['email'];
            $pass = $_POST['pwd'];

            $con = mysqli_connect('localhost','root','^_^iambatman') or die(mysql_error());
            mysqli_select_db($con, 'Lean_proj') or die("cannot select DB");

            $query = mysqli_query($con, "SELECT * FROM dashboard_login WHERE email='".$email."' AND password='".$pass."'");
            $numrows = mysqli_num_rows($query);
            if($numrows != 0){
                while($row = mysqli_fetch_assoc($query)){
                    $dbuseremail = $row['email'];
                    $dbpassword = $row['password'];
                }

                if($email == $dbuseremail && $pass == $dbpassword){
                    session_start();

                    $s_phno = mysqli_query($con, "SELECT phno FROM dashboard_login WHERE email='".$email."' AND password='".$pass."'");
                    $s_name = mysqli_query($con, "SELECT name FROM dashboard_login WHERE email='".$email."' AND password='".$pass."'");
                    // $s_city = mysqli_query($con, "SELECT city FROM dashboard_login WHERE email='".$email."' AND password='".$pass."'");
                    $s_state = mysqli_query($con, "SELECT state FROM dashboard_login WHERE email='".$email."' AND password='".$pass."'");
                    $s_age = mysqli_query($con, "SELECT age FROM dashboard_login WHERE email='".$email."' AND password='".$pass."'");

                    $ph0 = mysqli_fetch_array($s_phno);
                    $ph = $ph0['phno'];
                    $agq0 = mysqli_fetch_array($s_age);
                    $agq = $ag0['age'];
                    // $ag0 = mysqli_fetch_array($s_city);
                    // $ag = $ag0['city'];
                    $na0 = mysqli_fetch_array($s_name);
                    $na = $na0['name'];
                    $aa0 = mysqli_fetch_array($s_state);
                    $aa = $aa0['state'];

                    $_SESSION['sess_email'] = $email;
                    $_SESSION['sess_phno'] = $ph;
                    // $_SESSION['sess_city'] = $ag;
                    $_SESSION['sess_age'] = $agq;
                    $_SESSION['sess_name'] = $na;
                    $_SESSION['sess_state'] = $aa;

                    header("Location: landing.php");
                }
            } else {
                echo "Invalid username or password!";
            }
        } else {
            echo "All fields are required!";
        }
    }
?>
<!doctype html>
<html>
    <head>
        <title>Login</title>
        <style>
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
            #register_button{
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
            #register_button:hover{
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
                <h1>FastFut</h1>
                <p>
                    <i>A one place stop for anything football. Got some players but not a team? Find other players in your city and get footballing</i>
                </p>
                <h1>Welcome!</h1>
            </div>
            <form action="" method="POST" name="form_1" id="form_1">
                <div class="fields">
                    <label>E-mail address: </label>
                    <input placeholder="example@gmail.com" name="email" id="email" class="email" type="email" required/><br />
                </div>

                <div class="fields">
                    <label>Password: </label>
                    <input name="pwd" id="pwd" class="pwd" type="password" required/><br />
                </div>

                <input id="submit" class="submit" name="submit" type="submit" value="Login"/>
            </form>
        </div>

        <a href="lean_register.php"><button name="register_button" id="register_button">Register as a new user</button></a>


        <a href="dashboard.php"><div class="login100-pic js-tilt" data-tilt style="margin:auto; width: 100px; padding: 20px;">
            <img src="images/img-01.png" alt="IMG" style="width:100px;">
        </div></a>
        <!--===============================================================================================-->
        	<script src="./vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        	<script src="./vendor/bootstrap/js/popper.js"></script>
        	<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        	<script src="./vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        	<script src="./vendor/tilt/tilt.jquery.min.js"></script>
        	<script >
        		$('.js-tilt').tilt({
        			scale: 1.1
        		})
        	</script>
        <!--===============================================================================================-->
        	<script src="./js/main.js"></script>
    </body>
</html>
