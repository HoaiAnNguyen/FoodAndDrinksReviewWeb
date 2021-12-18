<?php
    include_once "lib/config.php";
    include_once 'lib/DataProvider.php';
    include_once "checkID.php";
    $totalWeightComment = (int) NULL;
    session_start();

    global $db_host, $db_username, $db_password, $db_name;
    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
    /* check connection */
    if ($connection->connect_error) {      
        die("Failed to connect: " . $connection->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MÚCBANG</title>

    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jquery.zoom.min.js"></script>

    <style>
		body
		{
			background-image: url('img/background1.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
            background-size: 100% 100%;
		}
        p{
            text-align: left;
            margin-bottom: 4px;
            font-size: 19px;
            color: #f584b5;
            display: block;
        }
		.p1
		{
            text-align: center;
			font-size: 19px;
            color: #ffd1dc;
		}
        .p2{
            text-align: center;
            font-size: 19px;
            color: white;
        }
        .title{
            text-align: center;
            margin-bottom: 4px;
            font-size: 19px;
            color: #ffd1dc;
            display: block;
        }

        .food-and-drink-title{
            margin-top: 0px;
            margin-bottom: 10px;
            text-align: center;
            text-transform: uppercase;
            font-size: 35px;
            letter-spacing: 2.5px;
            font-weight: 800;
            color: #e0607b;
            display: block;
        }
        .name{
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 35px;
            color: #f5699f;
            text-align: left;
            display: block;
        }
        .user{
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 25px;
            color: #f5699f;
            text-align: left;
            display: block;
        }

        .time-right {
            float: right;
            color: #ecb0b8;
        }

        .container_chat {
            background-color: rgba(255, 255, 255 , 0.7);
            padding: 10px;
            margin: 10px 0;
        }
        .container_chat::after {
            content: "";
            clear: both;
            display: table;
        }

        .container_chat img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }
    </style>
</head>

<body>  
    <div class="container">
        <div class="container">
            <!--Header box-->
            <div class="container">
                <table>
                    <tr style = "width: 100%">
                        <th>
                        <a href="index.php">
                            <img src="img/MucBanglogo.png" alt="image not found" class="logo">
                        </a>
                            <img src="img/MucBangslogan.png" alt="image not found" class="logo">
                        </th>

                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>

                        <th class ="w3-right-align">
                        
                            <?php
                            if(isset($_SESSION["username"]))
                            {
                                include ("modules/mAccountInfor.php");
                            }
                            else
                            {
                                include ("modules/mAccountLogin.php");
                                include ("modules/mAccountSignUp.php");
                            }
                            ?>
                        </th>
                    </tr>
                </table>
            </div>


            <!--Nav bar-->
            <?php
                
                
                //Get the ID of the Stall
                $id = intval($_GET['id']);
                $validID = checkingID($connection, $id);
                $getID = mysqli_fetch_array($validID);
                $ID = $getID["postID"];

                //Get the username of the user
                $USER = $_SESSION["username"];

                echo"
                <div class='w3-container'>
                    <div class='w3-bar w3-pale-red w3-border w3-padding w3-round-large'>
                        <a href='index.php'>
                            <button href='#' class='w3-bar-item w3-button w3-mobile w3-round-large'>Home</button></a>
                        <a href='Food.php?username=".$USER."'>
                            <button href='#' class='w3-bar-item w3-button w3-mobile w3-round-large'>Food</button></a>
                        <a href='Drink.php?username=".$USER."'>
                            <button href='#' class='w3-bar-item w3-button w3-mobile w3-round-large'>Drinks</button></a>
                        <a href='Query.php?username=".$USER."'>
                            <button href='#' class='w3-bar-item w3-button w3-pink w3-mobile w3-right w3-round-large'>Query</button></a>
                    </div>
                </div>
                ";
            ?>
        </div>
        <!-- Header -->
        <?php
            function append_string ($str1, $str2) {
                // Using Concatenation assignment
                // operator (.=)
                $str1 .= $str2;
                $str1 .= ", ";
                
                // Returning the result str1 + str2
                return $str1;
            }
            
            //add comment and word into database
            if(isset($_POST["txtComment"])){
                $content = $_POST["txtComment"];
                $validWord = (string) NULL;
                $weightTotal = 0;
                $index = 0;

                $sqlComment = "INSERT into comment SET
                commentID = NULL,
                username = '$USER',
                content = '$content',
                word = NULL,
                point = NULL,
                time = DEFAULT";

                $addComment = mysqli_query($connection, $sqlComment) or die (mysqli_connect_errno()."Cannot insert comment");;
                $sqlSentementalWordFromSentimentalWord = "SELECT word FROM sentimentalword";
                $resultSentementalWordFromSentimentalWord = mysqli_query($connection, $sqlSentementalWordFromSentimentalWord);

                while($arraySentimetalWord = mysqli_fetch_array($resultSentementalWordFromSentimentalWord)){
                    $sentimentalWord = $arraySentimetalWord["word"];
                    $HASsentimentalWordFromComment = strpos($content, $sentimentalWord);

                    if ($HASsentimentalWordFromComment !== false){
                        $validWord = append_string($validWord, $sentimentalWord);
                        $sqlComment = "UPDATE comment 
                        SET word = '$validWord'
                        WHERE content = '$content'";
                        $addComment = mysqli_query($connection, $sqlComment) or die (mysqli_connect_errno()."Cannot insert word");;
                        
                        $weightOfWord = mysqli_query($connection, "select weight from sentimentalword where word = '$sentimentalWord'");

                        while ($array_weightOfEachWord = mysqli_fetch_array($weightOfWord)){
                            $string_weightOfEachWord = $array_weightOfEachWord['weight']; 
                            $float_weightOfEachWord = floatval($string_weightOfEachWord);
                            $weightTotal = floatval($weightTotal + $float_weightOfEachWord);
                        }
                        $index = $index + 1;
                    }
                }
                if ($index == 0){
                    $point = mysqli_query($connection, "SELECT rating FROM post WHERE postID = '$ID'");
                    while ($array_point = mysqli_fetch_array($point)){
                        $weightComment = $array_point['rating'];
                    }
                }
                else if ($index != 0){
                    $weightComment = $weightTotal/$index;
                }
                                
                $UpdatePoint = mysqli_query($connection,
                "UPDATE comment 
                SET point = '$weightComment'
                WHERE content = '$content'");


                $commentID = mysqli_query($connection, "select max(commentID) from comment");
                $getCommentID = mysqli_fetch_array($commentID);
                $COMMENTID = $getCommentID[0];

                $addPreferences = mysqli_query($connection, "insert into preferences(postID, username, commentID) values ('$ID', '$USER', '$COMMENTID')");
                $countComment = mysqli_query($connection, "SELECT COUNT(comment.commentID) FROM comment, preferences, post WHERE comment.commentID = preferences.commentID AND post.postID = preferences.postID AND post.postID = '$ID'");

                while ($array_countComment = mysqli_fetch_array($countComment)){
                    $string_counComment = $array_countComment[0];
                    $float_countComment = intval($string_counComment);
                    
                    if ($float_countComment == 0){
                        $TotalWeight = 0;
                    }
                    else{
                        $totalRating = mysqli_query($connection, "SELECT AVG(comment.point) FROM comment, preferences, post WHERE comment.commentID = preferences.commentID AND post.postID = preferences.postID AND post.postID = '$ID'");
                        while ($array_totalRating = mysqli_fetch_array($totalRating)){
                            $string_totalRating = $array_totalRating[0];
                            $float_totalRating = floatval($string_totalRating);
                        }
                    }
                }
                $postRating = mysqli_query($connection, "update post set rating = '$float_totalRating' where postID = $ID");
                $foodRating = mysqli_query($connection, "update food set rating = '$float_totalRating' where postID = $ID");
                $drinkRating = mysqli_query($connection, "update drink set rating = '$float_totalRating' where postID = $ID");
            
            }
            
            //Take data from database and show on the web
            if ($ID){
                //If food, show detail of Food
                $sqlFood = "SELECT * FROM food, foodstalltype 
                WHERE food.postID = '$ID'
                AND food.postID = foodstalltype.postID";
                $resultFood = mysqli_query($connection, $sqlFood) or die(mysqli_connect_errno()."weeeeeee");;
                if ($resultFood){
                    if(mysqli_num_rows($resultFood) > 0){
                        while ($showFood = mysqli_fetch_array($resultFood)){
                            echo"
                                <div class='container' >
                                    <div class = 'w3-container'>
                                        <div class='w3-container' style='position:relative; background-color: #ffd1dc'>
                                            <h1 class='food-and-drink-title w3-margin-top w3-margin-bottom' style='text-shadow:1px 1px 0 #444'>".$showFood['foodStallType']."</h1>
                                        </div>
                        
                                        <!-- picture and name, rating -->
                        
                                        <div class='w3-animate-zoom' style='padding:20px 30px; background-size:cover; background-color: #ffdbe1'>
                                            <div class='w3-section w3-row-padding'>
                                                <div class='w3-twothird'>
                                                    <div class='w3-card-4'>
                                                        <div class='w3-display-container'>
                                                            <img src=".$showFood['image']." alt='Car' style='width:100%'>
                                                        </div>
                        
                                                        <div class='w3-container w3-light-grey'>
                                                            <p class = 'name'>".$showFood['foodName']."</p>
                                                            <p>Rating point: ".$showFood['rating']."</p>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <!-- information -->
                        
                                                <div class='w3-third w3-container w3-center'>
                                                    <div class='w3-card-4'>
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <i class='fas fa-map-marker-alt w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title' style='color: white'>Address</p>
                                                        </div>
                        
                                                        <div class='w3-container w3-white'>
                                                            <p class='p1'>".$showFood['address']."</p>
                                                        </div>
                                                    </div>
                        
                                                    <div class='w3-card-4 w3-section'>
                                                        <div class='w3-container w3-white'>
                                                            <i class='glyphicon glyphicon-earphone w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title'>Phone Number</p>
                                                        </div>
                        
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <p class='p2'>".$showFood['phoneNumber']."</p>
                                                        </div>
                                                    </div>
                        
                                                    <div class='w3-card-4'>
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <i class='fas fa-dollar-sign w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title' style='color: white'>Price</p>
                                                        </div>
                        
                                                        <div class='w3-container w3-white'>
                                                            <p class='p1'>".$showFood['priceRange']."</p>
                                                        </div>
                                                    </div>
                        
                                                    <div class='w3-card-4 w3-section'>
                                                        <div class='w3-container w3-white'>
                                                            <i class='far fa-clock w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title'>Working Time</p>
                                                        </div>
                        
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <p class='p2'>".$showFood['workingTime']."</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }
                }

                //If drink, show detail of Drink
                $sqlDrink = "SELECT * FROM drink, drinkstalltype 
                WHERE drink.postID = '$ID'
                AND drink.postID = drinkstalltype.postID";
                $resultDrink = mysqli_query($connection, $sqlDrink) or die(mysqli_connect_errno()."weeeeeee");;
                if ($resultDrink){
                    if(mysqli_num_rows($resultDrink) > 0){
                        while ($showDrink = mysqli_fetch_array($resultDrink)){
                            echo"
                                <div class='container' >
                                    <div class = 'w3-container'>
                                        <div class='w3-container' style='position:relative; background-color: #ffd1dc'>
                                            <h1 class='food-and-drink-title w3-margin-top w3-margin-bottom' style='text-shadow:1px 1px 0 #444'>".$showDrink['drinkStallType']."</h1>
                                        </div>
                        
                                        <!-- picture and name, rating -->
                        
                                        <div class='w3-animate-zoom' style='padding:20px 30px; background-size:cover; background-color: #ffdbe1'>
                                            <div class='w3-section w3-row-padding'>
                                                <div class='w3-twothird'>
                                                    <div class='w3-card-4'>
                                                        <div class='w3-display-container'>
                                                            <img src=".$showDrink['image']." alt='Car' style='width:100%'>
                                                        </div>
                        
                                                        <div class='w3-container w3-light-grey'>
                                                            <p class = 'name'>".$showDrink['drinkName']."</p>
                                                            <p>Rating Point: ".$showDrink['rating']."</p>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <!-- information -->
                        
                                                <div class='w3-third w3-container w3-center'>
                                                    <div class='w3-card-4'>
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <i class='fas fa-map-marker-alt w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title' style='color: white'>Address</p>
                                                        </div>
                        
                                                        <div class='w3-container w3-white'>
                                                            <p class='p1'>".$showDrink['address']."</p>
                                                        </div>
                                                    </div>
                        
                                                    <div class='w3-card-4 w3-section'>
                                                        <div class='w3-container w3-white'>
                                                            <i class='glyphicon glyphicon-earphone w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title'>Phone Number</p>
                                                        </div>
                        
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <p class='p2'>".$showDrink['phoneNumber']."</p>
                                                        </div>
                                                    </div>
                        
                                                    <div class='w3-card-4'>
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <i class='fas fa-dollar-sign w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title' style='color: white'>Price</p>
                                                        </div>
                        
                                                        <div class='w3-container w3-white'>
                                                            <p class='p1'>".$showDrink['priceRange']."</p>
                                                        </div>
                                                    </div>
                        
                                                    <div class='w3-card-4 w3-section'>
                                                        <div class='w3-container w3-white'>
                                                            <i class='far fa-clock w3-margin-top w3-margin-bottom' style='font-size:38px; color:#e0607b'></i>
                                                            <p class='title'>Working Time</p>
                                                        </div>
                        
                                                        <div class='w3-container' style='background-color: #ffd1dc'>
                                                            <p class='p2'>".$showDrink['workingTime']."</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }
                }
            }
        ?>
        <!-- Show comment -->
        <div class='container' >
            <div class = 'w3-container'>
                <?php
                    $sqlComment = "SELECT comment.content, comment.time, account.name
                    FROM post, preferences, comment, account
                    WHERE preferences.postID = post.postID
                    AND post.postID = '$ID'
                    AND	preferences.username = account.username
                    AND account.username = '$USER'
                    AND preferences.commentID = comment.commentID";

                    $resultComment = mysqli_query($connection, $sqlComment) or die(mysqli_connect_errno()."wooooooo");;
                    if ($resultComment){
                        if(mysqli_num_rows($resultComment) > 0){
                            while ($showComment = mysqli_fetch_array($resultComment)){
                                echo"
                                    <div class='container_chat'>
                                        <img src='img/user1.jpg' alt='Avatar' style='width:100%;'>
                                            <p class = 'user'>".$showComment['name']."</p>
                                            <p class = 'w3-margin-top'>".$showComment['content']."</p>
                                        <span class='time-right'>".$showComment['time']."</span>
                                    </div>
                                ";
                            }
                        }
                    }
                ?>
            </div>

            <!-- excommentbox -->
            <form method="POST" onSubmit="return CheckComment()">
                <div class="container">             
                    <tr>
                        <td><input type="text" style="width: 1000px; height: 50px" name="txtComment" id="txtComment" placeholder="Leave your comment here"></td>
                    </tr>
                    <input type="submit" style="width: 100px" name="submit" value="Upload" class="w3-round-large w3-pink">
                </div>
            </form>

            <script type="text/javascript">
                function CheckComment(){
                    if(document.getElementById("txtComment").value == "")
                    {
                        document.getElementById("txtComment").focus();
                        alert("Comment cannot be null");
                        return false;
                    }
                    return true;
                }
            </script>
            <div>
                <h6 style ="text-align: center; color: #e0607b">@Developed by Lam, An, Sarah</h6>
            </div>
        </div>
    </div>
</body>
</html>