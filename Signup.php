
<div id = "Signup">
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
/*Form style*/
    *
    {
        box-sizing: border-box
    }
    input[type=text], select, textarea 
    {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        resize: vertical;
    }
    input[type=password]
    {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        resize: vertical;
    }
    label 
    {
        padding: 5px 12px 7px 0;
        display: inline-block;
        font-size: 20px;
        color: #FF1493;
    }
    input[name = Register] 
    {
        background-color: teal;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        float: right;
    }
    input[type=submit]:hover 
    {
        background-color: pink;
    }
    .col-25 
    {
        float: left;
        width: 25%;
        margin-top: 6px;
    }
    .col-75 
    {
        float: left;
        width: 75%;
        margin-top: 6px;
    }
    .row:after 
    {
        display: table;
        clear: both;
    }
    .heading
    {
        font-size: 100px;
        text-align: center;
        color: #FF1493;
    }
    .formcontainer
    {
        max-width: 600px;
        min-width: 320px;
        width: 100%;
        margin: 10px auto;
        top: 0;
        padding: 15px;
    }
    .error{
        font-size: 18px;
        color: red;
    }
    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) 
    {
        .col-25, .col-75, input[type=submit] 
        {
            width: 100%;
            margin-top: 0;
        }
    } 
</style>
</head>
<?php
    
    include_once "lib/config.php";
    include_once "lib/DataProvider.php";
    include_once "function/session.php";
    
    global $db_host, $db_username, $db_password, $db_name;

    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
    /* check connection */
    if ($connection->connect_error) {      
        die("Failed to connect: " . $connection->connect_error);
    }

    if ($checkquery = $connection->prepare("Select * from account where username = ?")){
        $error ='';
        $checkquery->bind_param ('s', $username);
        $checkquery->execute();
        $checkquery->store_result();
        if($checkquery->num_rows > 0){
            $error .= '<p class = "error"> The username is already taken! Please input another one</p>';
        }
    }
    if (empty($error)){
        if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["email"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $email = $_POST["email"];

            $sql = "insert into account (username, password, name, email) 
            values ('$username','$password','$name','$email')";
            if($connection->query($sql) == true)
            {
                $error .= '<p class="error"> Your registration was successful! </p>';
            }
            else{
                $error .= '<p class="error"> Something went wrong! </p>';
            }
            
        }
    }
    
?>
<body>  
<div class="container">
    <!--Header box-->
    <div class="container">
        <table>
            <tr style = "width: 100%">
                <th>
                    <img src="img/MucBanglogo.png" alt="image not found" class="logo">
                    <img src="img/MucBangslogan.png" alt="image not found" class="logo">
                </th>
            </tr>
        </table>
    </div>
    
    <!--Nav bar-->
    <div class="w3-container">
        <div class="w3-bar w3-pale-red w3-border w3-padding w3-round-large">
            <a href="index.php">
                <button href="#" class="w3-bar-item w3-button w3-mobile w3-round-large">Home</button></a>
        </div>
    </div>

    <!--Signup form-->
<br>
<div class = "heading">
<h1><b>SIGN UP</b></h1>
</div>
<?php echo $error; ?>
<div class="formcontainer">
  <form method = "POST", action="Signup.php", onSubmit = " return checkRegister()">
  <div class="row">
    <div class="col-25">
      <label for="username">Username</label>
    </div>
    <div class="col-75">
      <input type="text" id="username" name="username">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="password">Password</label>
    </div>
    <div class="col-75">
    <input type="password" id="password" name="password">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">Email</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email">
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Register" name = "Register">
  </div>
  </form>
</div>

<script type="text/javascript">
    function checkRegister()
    {
        var control = document.getElementById("username");
        if(control.value =="")
        {
            control.focus();
            alert("User name can not null");
            return false;
        }

        control = document.getElementById("password");
        if(control.value == "")
        {
            control.focus();
            alert("Password can not null");
            return false;
        }

        control = document.getElementById("name");
        if(control.value == "")
        {
            control.focus();
            alert("Name can not null");
            return false;
        }

        control = document.getElementById("email");
        if(control.value == "")
        {
            control.focus();
            alert("Email can not null");
            return false;
        }

        return true;
    }
</script>
</body>