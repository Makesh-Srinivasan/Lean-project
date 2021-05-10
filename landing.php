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
            #topbar
            {
                height: 80px;
                background-color:#a1c362;
                margin-left: 200px;
                width: 89%;
                position: fixed;
                top: 0;
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
                margin-top: 300px;
                float:right;
                width: 60%;
                margin-right: 50px;
                margin-bottom: 150px;
                height: 550px;
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
            #filler
            {
                margin-top: 300px;
                width: 35%;
                float:left;
                height: 700px;
            }
            .my-element1 
            {
                animation: fadeInUp; /* referring directly to the animation's @keyframe declaration */
                animation-duration: 0.9s; /* don't forget to set a duration! */
            }
            a
            {
                text-decoration: none;
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
                    <a href =  'joining.php'>
                    <li>
                        Team Up
                    </li>
                    </a>
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
            <article id = 'filler'></article>
            <article id = 'content' class = "animate__animated animate__fadeInUp my-element" >
                <p id = 'phead'>
                    The Virus is Out and the Turfs are In!
                </p>
                <p id = 'ppara'>
                    Let's make ourselves healthier during the fight against COVID
                </p>
                <br/>
                <br/>
                <a href = 'bookturf.html'>
                <button class="custom-btn btn-16"><p id = 'ppara'>Book A Turf</p></button>
                </a>
            </article>
        </section>
        <br/>
        <div id = 'aftercontent' class = "animate__animated animate__fadeInUp my-element1">
            <article id = 'a1'>
                <h2>
                    Title 1
                </h2>
                <h4>
                    Content and Hyperlink
                </h4> 
            </article>
            <article id = 'a2'>
                <h2>
                    Title 1
                </h2>
                <h4>
                    Content and Hyperlink
                </h4> 
            </article>
            <article id = 'a3'>
                <h2>
                    Title 1
                </h2>
                <h4>
                    Content and Hyperlink
                </h4> 
            </article>
        </div>
       
        
    </body>
</html>