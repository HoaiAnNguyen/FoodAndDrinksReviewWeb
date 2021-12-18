<div id = addingdrinks>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Chau Huong -->
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jquery.zoom.min.js"></script>
<style>

/*Form style*/
*{
    box-sizing: border-box
}
input[type=text], select, textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 10px;
  resize: vertical;
}
label {
  padding: 5px 12px 7px 0;
  display: inline-block;
  font-size: 17px;
  color: #FF1493;
}
input[type=submit] {
  background-color: teal;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  float: right;
}
input[type=submit]:hover {
  background-color: pink;
}
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}
.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}
.row:after {
  display: table;
  clear: both;
}
.heading{
  font-size: 100px;
  text-align: center;
  color: #FF1493;
}
.formcontainer{
  max-width: 600px;
  min-width: 320px;
  width: 100%;
  margin: 10px auto;
  top: 0;
  padding: 15px;
} 

/*From index*/
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
.pro_pic
{
  border-radius: 50%;
  height: 50px;
  width: 50px;
  margin-bottom: 15px;
  margin-right: 15px;

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<?php
    
    include_once "lib/config.php";
    include_once "lib/DataProvider.php";
    global $db_host, $db_username, $db_password, $db_name;

    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
    /* check connection */
    if ($connection->connect_error) {      
        die("Failed to connect: " . $connection->connect_error);
      }
           
    if(isset($_POST["name"]) && isset($_POST["image"]) && isset($_POST["address"]) && isset($_POST["workingtime"]) && isset($_POST["pricerange"]) 
      && isset($_POST["phonenumber"]) && isset($_POST["drinkstypes"])){
            $name = $_POST["name"];
            $image = $_POST["image"];
            $address = $_POST["address"];
            $workingtime = $_POST["workingtime"];
            $pricerange = $_POST["pricerange"];
            $phonenumber = $_POST["phonenumber"];
            $drinkstypes = $_POST["drinkstypes"];

            $sql = "insert into post (name, address, image, workingTime, priceRange, phoneNumber)
            values ('$name', '$address', 'img/$image', '$workingtime', '$pricerange', '$phonenumber')";

            if($connection->query($sql) == true)
            {
            }

            $sql_1 = "insert into drink (postID, address, image, drinkName, phoneNumber, priceRange, workingTime)
            select post.postID, post.address, post.image, post.name, post.phoneNumber, post.priceRange, post.workingTime
            from post
            where post.postID = (select max(p1.postID) from post as p1)";
            $sql_2 = "insert into drinkstalltype (postID, drinkStallType)
            values ((select max(postID) from post), '$drinkstypes')";

            if(($connection->query($sql_1) == true) && ($connection->query($sql_2) == true))
            {
            }

            DataProvider::ChangeURL("Admindrink.php");
        }
?>
<body>  
    <?php include ('modules/mAdminHeader.php'); ?>
<!--Adding form-->
<br>
<div class = "heading">
<h1><b>ADD DRINKS</b></h1>
</div>

<div class="formcontainer">
  <form method = "post" action="addingDrinks.php" onSubmit = "return checkNull()">
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" style="height: 60px">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="image">Upload image</label>
    </div>
    <br>
    <input type="file" name="image" id="image">
    </div>
  <div class="row">
    <div class="col-25">
      <label for="address">Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="address" name="address" placeholder="Including city...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="workingtime">Working Time</label>
    </div>
    <div class="col-75">
      <input type="text" id="workingtime" name="workingtime" style="height: 60px">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pricerange">Price Range</label>
    </div>
    <div class="col-75">
      <input type="text" id="pricerange" name="pricerange">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="phonenumber">Phone Number</label>
    </div>
    <div class="col-75">
      <input type="text" id="phonenumber" name="phonenumber" style="height: 60px">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="drinkstypes">Types of drinks</label>
    </div>
    <div class="col-75">
      <select id="drinkstypes" name="drinkstypes">
        <option value="Coffee&Tea">Coffee & Tea</option>
        <option value="Takeaway">Takeaway</option>
        <option value="Lounge">Lounge</option>
      </select>
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Submit">
  </form>
</div>

<script type="text/javascript">
    function checkNull()
    {
        var control = document.getElementById("name");
        if(control.value =="")
        {
            control.focus();
            alert("Name can not null");
            return false;
        }

        control = document.getElementById("address");
        if(control.value == "")
        {
            control.focus();
            alert("Address can not null");
            return false;
        }

        control = document.getElementById("image");
        if(control.value == "")
        {
            control.focus();
            alert("Please upload image");
            return false;
        }

        control = document.getElementById("workingtime");
        if(control.value == "")
        {
            control.focus();
            alert("Working Time can not null");
            return false;
        }

        control = document.getElementById("pricerange");
        if(control.value == "")
        {
            control.focus();
            alert("Price Range can not null");
            return false;
        }

        control = document.getElementById("phonenumber");
        if(control.value == "")
        {
            control.focus();
            alert("Phone Number can not null");
            return false;
        }

        return true;
    }
</script>

</body>

