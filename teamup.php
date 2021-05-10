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
            // echo '<tr><th id="bor">Row</th><th id="bor">Date</th><th id="bor">Turf name</th><th id="bor">Time available</th><th id="bor">Number of players</th><th id="bor">Available slots</th><th id="bor">Confirm joining?</th></tr>';
            $i = 1;
            if($numrows > 0 || $numrows){
                while($row = mysqli_fetch_assoc($query)){
                    $join_tuple_row = $row['Join_ID'];
                    $cookie_nop = $row['number_of_players'];
                    setcookie("join_tuple_row", $join_tuple_row, time() + (86400 * 30), "/");
                    setcookie("cookie_nop", $cookie_nop, time() + (86400 * 30), "/");
                    $available_slots = 10-$row['number_of_players'];
                    
                    echo '<tr id="flex_box">
                    <td id="bor">
                    <span class="data_flex_box" id="date_flex_box">Date:<br>'.$row['Date'].'<br></span>
                    <span class="data_flex_box" id="turf_name_flex_box">Turf name:<br>'.$row['Turf_name'].'<br></span>
                    </td>
                    <td id="bor">
                    <span class="data_flex_box" id="time_available_flex_box">Time available:<br>'.$time_table[$row['Time_available']].'<br></span>
                    <span class="data_flex_box" id="available_slots_flex_box">Slots available:<br>'.$available_slots.'</span>
                    </td>
                    </td><td id="bor"><form action="" method="POST" name="form_2" id="form_2"><input type="submit" id="button" name="join" class="button" value="Join"/></form></td><br></tr>';
                    $i = $i + 1;

                    setcookie("join_tuple_row", "", time() - 3600);
                    setcookie("cookie_nop", "", time() - 3600);
                }
            } else {
                echo '<tr><td colspan="5" style="text-align:center;">There are no bookings in the turf you have selected</td></tr>';
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
<html>
    <head>
        <head>
            <link
              rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
            />
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">
          </head>
          
       <style>
           body
            {
                background-image: url("bg1.jpeg");
                background-repeat: no-repeat;
                background-size: 100%;
                background-color: black;
            }
            em
            {
                color:#ffffff;
                font-family: 'Merienda', cursive;
                font-size: 50px;
                padding: 0px;
                font-style: normal;
            }
            a
            {
                text-decoration: none;
            }
            #topbar
            {
                height: 80px;
                background-color:#a1c362;
                margin-left: 200px;
                width: 89%;
                position: fixed;
                top: 0;
                border-bottom: 5px solid #000000;
            }
            #headingspace
            {
                width: 270px;
                background-color: #0D0D0D;
                height: 93%;
                padding-left: 50px;
                float:left;
                padding-top: 7px;
                overflow-y: hidden;
            }
            #navbar
            {
                float:right;
            }
            #navbar li
            {
                display:inline-block;
                list-style: none;
                height: 80px;
                line-height: 50px;
                padding: none;
                margin-left:25px;
                margin-right: 25px;
                align-self: center;
                font-size: 25px;
                font-family: 'Itim', cursive;
                color:black;
            }
            #navbar li:hover
            {
                color:white;
            }
            #navbar ul 
            {
                margin-right: 100px;
            }
            #content 
            {
                border-radius: 10px;
                margin-left: 10%;
                margin-top: 6%;
                padding-right: 10px;
                margin-right: 10%;
                width: 80%;
                height: 90px;
                background-color: #a1c362;
                border-top: 5px solid #000000;
            }
            #phead
            {
                font-size: 40px;
                color:white;
                font-style: bold;
                font-family: 'Merriweather', serif;
            }
            #ppara
            {
                font-size: 20px;
                color:white;
                font-family: 'Merriweather', serif;
            }
            .my-element 
            {
                display: inline-block;
                margin: 0 0.5rem;
                animation: fadeInUp; /* referring directly to the animation's @keyframe declaration */
                animation-duration: 0.6s; /* don't forget to set a duration! */
            }
            .btn-16 
            {
                border: none;
                color: #000;
                font-family: 'Merriweather', serif;
            }
            .btn-16:after 
            {
                position: absolute;
                content: "";
                width: 0;
                height: 100%;
                top: 0;
                left: 0;
                direction: rtl;
                z-index: -1;
                box-shadow:
                -7px -7px 20px 0px rgba(24, 56, 20, 0.6),
                -4px -4px 5px 0px rgba(33, 83, 24, 0.6),
                7px 7px 20px 0px #0002,
                4px 4px 5px 0px #0001;
                transition: all 0.3s ease;
            }
            .btn-16:hover 
            {
                color: #000;
            }
            .btn-16:hover:after 
            {
                left: auto;
                right: 0;
                width: 100%;
            }
            .btn-16:active 
            {
                top: 2px;
            }
            .custom-btn 
            {
                color: #fff;
                border-radius: 5px;
                width: 200px;
                font-weight: 500;
                background: transparent;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                display: inline-block;
                box-shadow:inset 2px 2px 2px 0px rgba(34, 37, 31, 0.5),
                7px 7px 20px 0px rgba(0,0,0,.1),
                4px 4px 5px 0px rgba(0,0,0,.1);
                outline: none;
            }
            #a1
            {
                font-family: 'Merriweather', serif;
                width:20%;
                height: 40%;
                float:left;
                background-color:#a1c362 ;
                border-radius: 30px;
                margin: 5%;
                padding: 20px;
                padding-left: 30px;
                box-shadow: 9px 9px 18px 1px rgba(58, 58, 58, 0.83);
                border: 4px solid #181311;
            }
            #a2
            {
                font-family: 'Merriweather', serif;
                width:20%;
                height: 40%;
                float:left;
                margin: 5%;
                padding: 20px;
                padding-left: 30px;
                background-color:#a1c362 ;
                border-radius: 30px;
                border: 4px solid #181311;
                box-shadow: 9px 9px 18px 1px rgba(58, 58, 58, 0.83);
            }
            #a3 
            {
                font-family: 'Merriweather', serif;
                width:20%;
                height: 40%;
                float:right;
                margin: 5%;
                padding: 20px;
                padding-left: 30px;
                background-color:#a1c362 ;
                border-radius: 30px;
                border: 4px solid #181311;
                box-shadow: 9px 9px 18px 1px rgba(58, 58, 58, 0.83);
            }
            #aftercontent 
            {
                width: 100%;
                margin-top: 500px;
            }
            .my-element1 
            {
                animation: fadeInUp; /* referring directly to the animation's @keyframe declaration */
                animation-duration: 0.9s; /* don't forget to set a duration! */
            }
            #selected
            {
                color:white !important;
            }
            input 
            {
                margin-top: 2%;
                margin-left: 3%;
                width: 17%;
                height: 45%;
                border-radius: 10px;
                opacity: 70%;
                border: 1px solid
            }
            input:hover
            {
                opacity: 100%;
                background-color: #7a7a7aa9;
                color:rgb(0, 0, 0);
            }
            input:focus
            {
                background-color: #f8f8f8;
                color: black;
            }
            .button 
            {
                width: 100%;
                height: 40%;
                border-radius: 10px;
                background-color:darkolivegreen;
                text-align: center;
                padding: 5px;
                border: 2px solid black;
                font-size: 20px;
                font-family: 'Itim', cursive;
            }
            .button:hover
            {
                background-color:#141D0E;
                color:white;
                border: 2px solid white;
            }
            .formarea
            {
                margin-top: 28px;
                margin-right: 50px;
                float:right;
                width: 18%;
            }
            input::placeholder
            {
                font-family: 'Merriweather', serif;
                text-align: center;
                color:black;
                font-weight: 30px;
            }
            /* .flex-container 
            {
                border: 1px #a1c362 solid;
                padding: 10px;
                border-radius: 10px;
                width: 50%;
                display: flex;
                flex-direction: column;
                margin-top: 80px;
                margin-left: 10%;
                /* margin-right: 600px; */
            }

            /*.flex-container > tr 
            {
                margin-bottom: 50px;
                font-size: 20px;
                padding: 20px;
                padding-top: 5px !important;
                border-radius: 10px;
                background-color: #8c8a6846;
                font-family: 'Merriweather', serif;
                color:white;
            }
            .flex-container > tr > td
            {
                float:right;
                font-size: 20px;
                font-style: bold;
                margin-right: 50px;
            }
            .flex-container > tr > td
            {
                float:left;
                font-size: 20px;
                font-style: bold;
            } */
            #button
            {
               
                float:center;
                width: 100%;
                height: 50px;
                border-radius: 5px;
                border: 2px solid black;
                font-size: 20px;
                background-color: #6673499a;
            }
            #button:hover
            {
               
                float:center;
                width: 100%;
                height: 50px;
                border-radius: 5px;
                border: 2px solid black;
                font-size: 20px;
                background-color: #8b9b68;
            }
            #available_results{
                position: absolute;
                top: 40%;
                margin: 30px;
                right: 38%;
                padding: 20px;
                width: 50%;
                border: 1px #a1c362 solid;
                font-size: 16px;
                border-radius: 5px;
            }
            #bor{
                border: none;
                text-align: center;
            }
            #flex_box{
                border: none;
                background-color: #8c8a6846;
                font-family: 'Merriweather', serif;
                color:white;
                font-size: 20px;
                padding: 20px;
                padding-top: 5px !important;
            }
            #date_flex_box{
                position: relative;
                top: 1%;
            }
            #turf_name_flex_box{
                position: relative;
                top: 1%;
            }
            #time_available_flex_box{
                position: relative;
                top: 1%;
            }
            #available_slots_flex_box{
                position: relative;
                top: 1%;
            }
            tr{
                margin: 10px;
                padding: 10px;
            }
       </style>
    </head>
    <body>
        <section id = 'topbar'>  
            <article id = 'headingspace'>
                <a href = 'landing.html'>
                <em>Fast Fut</em>
                </a>
            </article>
            <article id = 'navbar'>
                <ul>
                    <a href = 'bookturf.html'>
                    <li>
                            Book A Turf
                    </li>
                    </a>
                    <li id = 'selected'>
                        Team Up
                    </li>
                    <li>
                        Tournaments
                    </li>
                    <li>
                        About
                    </li>
                    <li>
                        Contact
                    </li>
                </ul>
            </article>
        </section>
        <section>
        <article id = 'content'>
            <form action="" method="POST" name="form_1" id="form_1">
                <input placeholder="Number of players" name="Num_players" id="Num_players" class="Num_players" type="text" required/>

                <input placeholder="dd-mm-yyyy" name="Date" id="Date" class="Date" type="text" required/>

                <input placeholder="Turf name" name="name_of_turf" id="name_of_turf" class="name_of_turf" type="text" required/>
                <article class="formarea"><input id="submit" class="button" name="submit" type="submit" value="Search"/></article>
                
            </form>
        </article>
        </section>
        <!-- <table class="flex-container">
            <div>
                <p>
                    Name of Court
                 <br/>
                 <br/>
                    Date
                </p>
                <h4>
                    Player Count
                    <br/>
                    <br/>
                    Time
                </h4>
                <br/>
                <button>
                    Join
                </button>
            </div>  
        </table> -->
        <br/>        
    </body>
</html>


<!-- <span class="data_flex_box" id="number_of_players_flex_box">Number of players:<br>'.$row['number_of_players'].'<br></span> -->
