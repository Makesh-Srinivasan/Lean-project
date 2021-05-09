<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:lean_login.php");
} else {
?>
<!doctype html>
<html>
<head>
    <title>Welcome page</title>
    <link rel="stylesheet" href="nav_bar.css" type="text/css"/>
    <link rel="stylesheet" href="footer.css" type="text/css"/>

    <style>
        .module{
            width: 500px;
            height: 600px;
            text-align: center;
            margin:auto;
            box-shadow: 8px 8px 16px 8px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        table{
            padding:10px;
            border: 0px solid black;
        }
        #contentsq{
            padding-top: 20px;
            margin:auto;
            font-family: monospace;
            color: white;
            width:64%;
            font-size: 16px;
            text-align: center;
            border: 0px black solid;
            width: 98%;
            box-shadow: 8px 8px 16px 8px rgba(0,0,0,0.2);
            background-color: #121212;
            border-radius: 6px;
        }
        #hi{
            color: white;
            position: absolute;
            top:67%;
            left:28%;
            font-size: 20px;
            font-family: monospace;
            font-weight: bold;
        }
        .darksq{
            width:88%;
            margin:5%;
            height:500px;
            position:absolute;
            background-color: #121212;
            border-radius: 6px;
            box-shadow: 8px 8px 16px 8px rgba(0,0,0,0.2);
            padding:10px;
        }
        h1{
            text-align: center;
            color:white;
            padding-top: 100px;
            font-size: 60px;
            font-family:inherit;
        }

        body{
            margin:0px;
        }
        .box-circle-transform{
          margin:auto;
          width:200px;
          background-color: #121212;
          outline: 1px solid transparent;

          position: absolute;
          top: 60%;
          left:24%;
        }
        #square{
            position: absolute;
            top:100%;
            width:99%;
        }
        img{
            width:100%;
        }
        .boxed{
            margin:5px;
            padding: 5px;
            box-shadow: 8px 8px 16px 8px rgba(0,0,0,0.2);
            border-radius:4px;
        }
    </style>


    </head>
<body>
<!-- <h2>Welcome, <?=$_SESSION['sess_user'];?>!</h2> -->
<ul id = "navbar">
    <li id = "navbar_button"><a id = "content" href="http://192.168.64.2/lean J component/dashboard.php">Home</a></li>
    <li id = "navbar_button"><a id = "content" href="http://192.168.64.2/lean J component/Simulator.php">Simulator</a></li>
    <li id = "navbar_button"><a id = "content" href="http://192.168.64.2/lean J component/sentiment_analysis.php">Sentiment analysis</a></li>
    <li id = "navbar_button"><a id = "content" href="http://192.168.64.2/lean J component/news.php">News</a></li>
    <li id = "navbar_button"><a id = "content" href="http://192.168.64.2/lean J component/main_forum.php">Forum</a></li>
    <li style="float:right" class="dropdown" id = "navbar_button">
        <a class="dropbtn">More</a>
        <div class="dropdown-content">
            <a id = "drop" href="feedback.php">Feedback</a>
            <a id = "drop" href="lean_about us.html">About us</a>
            <a id = "drop" href="lean_logout.php">Log out</a>
        </div>
    </li>

</ul>

<div class = "darksq">
    <h1>Welcome, <?=$_SESSION['sess_name'];?>!</h1>
</div>
</body>
</html>
<?php
}
?>
