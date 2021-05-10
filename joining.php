<?php
session_start();
if(!isset($_SESSION["sess_email"])){
    header("location:lean_login.php");
}
?>
<?php
    if(isset($_POST["submit"])){
        if(!empty($_POST['name_of_turf']) && !empty($_POST['Date']) && !empty($_POST['Num_players'])) {
            // Connect to the database
            $con = mysqli_connect('localhost','root','^_^iambatman') or die(mysql_error());
            mysqli_select_db($con, 'Lean_proj') or die("cannot select DB");

            // Create a look-up table for the time slots
            $time_table = array("0"=>"06:00-07:00", "1"=>"07:00-08:00", "2"=>"08:00-09:00", "3"=>"09:00-10:00", "4"=>"10:00-11:00", "5"=>"11:00-12:00", "6"=>"12:00-13:00", "7"=>"13:00-14:00", "8"=>"14:00-15:00", "9"=>"15:00-16:00", "10"=>"16:00-17:00", "11"=>"17:00-18:00");
            
            // Get post variables from the form
            $Date_of_play = $_POST['Date'];
            $name_of_turf = $_POST['name_of_turf'];
            $num_want_to_join = $_POST['Num_players'];
            $already_booked = 10-$num_want_to_join;
            setcookie("num_want_to_join", $num_want_to_join, time() + (86400 * 30), "/");
            

            // Select the tuples that meet the search conditions
            $query = mysqli_query($con, "SELECT * FROM Joining WHERE Turf_name='".$name_of_turf."' AND number_of_players<=$already_booked AND Date='".$Date_of_play."'");
            $numrows = mysqli_num_rows($query);
            echo '<table id="available_results">';
            echo '<tr><th id="bor">Row</th><th id="bor">Date</th><th id="bor">Turf name</th><th id="bor">Time available</th><th id="bor">Number of players</th><th id="bor">Available slots</th><th id="bor">Confirm joining?</th></tr>';
            $i = 1;
            if($numrows > 0 || $numrows){
                while($row = mysqli_fetch_assoc($query)){
                    $join_tuple_row = $row['Join_ID'];
                    $cookie_nop = $row['number_of_players'];
                    setcookie("join_tuple_row", $join_tuple_row, time() + (86400 * 30), "/");
                    setcookie("cookie_nop", $cookie_nop, time() + (86400 * 30), "/");
                    $available_slots = 10-$row['number_of_players'];
                    
                    echo '<tr><td id="bor">'.$i.'</td><td id="bor">'.$row['Date'].'</td><td id="bor">'.$row['Turf_name'].'</td><td id="bor">'.$time_table[$row['Time_available']].'</td><td id="bor">'.$row['number_of_players'].'</td></td><td id="bor">'.$available_slots.'</td><td id="bor"><form action="" method="POST" name="form_2" id="form_2"><input type="submit" id="button" name="join" class="button" value="Join"/></form></td></tr>';
                    $i = $i + 1;

                    setcookie("join_tuple_row", "", time() - 3600);
                    setcookie("cookie_nop", "", time() - 3600);
                }
            } else {
                echo '<tr><td colspan="7" style="text-align:center;">There are no bookings in the turf you have selected</td></tr>';
            }
            echo '</table>';
        }
    }

    function confirm_booking() {
        if(isset($_COOKIE['join_tuple_row']) && isset($_COOKIE['cookie_nop']) && isset($_COOKIE['num_want_to_join'])){
            $con = mysqli_connect('localhost','root','^_^iambatman') or die(mysql_error());
            mysqli_select_db($con, 'Lean_proj') or die("cannot select DB");

            $Join_id = $_COOKIE["join_tuple_row"];
            $players = $_COOKIE["cookie_nop"] + $_COOKIE["num_want_to_join"];
            if($players == 0){
                mysqli_query($con, "DELETE FROM Joining WHERE Join_ID='".$Join_id."'");
            } else {
                if (mysqli_query($con, "UPDATE Joining SET number_of_players=$players WHERE Join_ID=$Join_id")) {
                    echo "successfully changed";
                } 
            }
            
            setcookie("num_want_to_join", "", time() - 3600);
            setcookie("join_tuple_row", "", time() - 3600);
            setcookie("cookie_nop", "", time() - 3600);
        }
    }

    if(isset($_POST["join"])){
        confirm_booking();
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
            #available_results{
                position: absolute;
                /* float: right; */
                top: 56%;
                margin: 30px;
                right: 13%;
                padding: 20px;
                width: 70%;
                border: 1px #e0aa3e solid;
                font-size: 16px;
                border-radius: 5px;
            }
            tr{
                -webkit-transition : background-color 200ms ease-out;
                -moz-transition : background-color 200ms ease-out;
                -o-transition : background-color 200ms ease-out;
            }
            tr:hover{
                background-color: #3f3f3f;
            }
            #bor{
                border: 1px solid white;
                border-radius: 1px;
                text-align: center;
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
            <form action="" method="POST" name="form_1" id="form_1">
                <div class="fields">
                    <label>Number of players: </label>
                    <input placeholder="Number of players" name="Num_players" id="Num_players" class="Num_players" type="text" required/><br />
                </div>

                <div class="fields">
                    <label>Date: </label>
                    <input placeholder="dd-mm-yyyy" name="Date" id="Date" class="Date" type="text" required/><br />
                </div>

                <div class="fields">
                    <label>Turf name: </label>
                    <input placeholder="Turf name" name="name_of_turf" id="name_of_turf" class="name_of_turf" type="text" required/><br />
                </div>

                <input id="submit" class="submit" name="submit" type="submit" value="Search"/>
            </form>
        </div>
    </body>
</html>
