<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MÚCBANG</title>

    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jquery.zoom.min.js"></script>

    <style>
        .well
        {
            background: rgba(255, 255, 255 , 0.7);
            border: none;
    
        }
		body
		{
			background-image: url('img/background1.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
            background-size: 100% 100%;
		}
		p
		{
			font-size: 13px;
            color: #FF1493;
		}
    </style>
</head>

<body>  
    <div class="container">

        <!-- Header -->
        <?php include ('modules/mAdminHeader.php'); ?>

        <!-- Photo box -->
        <div class="w3-content w3-section" style="width:100%;">
            <img class="photoSlides" src="img/food1.jpg" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/drink1.jpg" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/food2.jpg" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/drink2.jpg" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/food3.jpg" style="width:100%; height:100%;">
        </div>

        <!-- About us box -->
        <hr>
        <div class="row" style="color: #FF1493">
            <div class="col-md-12 well" >
                <h4><strong>About</strong></h4><br>
                <p>MÚCBANG is a food and drinks destination rating website, developed by MÚCGANG.</p>
                <p>The amusing destinations on this website are rated based on your comments.</p>
                <p>This site serves as a communication system between those who seek for places to meet up and those who give feedbacks based on their experience.</p>
                <br>
                <h4><strong>For more information, please kindly contact MÚCGANG via:</strong></h4>
                <p>Email: mucbang.bymucgang@gmail.com</p>
                <p>Phone: +84 070 228 400</p>
                <p>QR Code:</p>
                <img src="img/qrcode.png" style="width:20%; height:20%;">
            </div>  
        </div>
    </div>

    <!-- Photo box algorithm -->
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("photoSlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 3000); // Change image every 3 seconds
        }
    </script>
</body>
</html>