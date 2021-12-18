<div id = query>
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
}
.querytable{
    width: 100%;
    border-collapse: collapse;
    border: 3px solid black;
    margin-left:auto;
    margin-right:auto;
}
</style>
</head>

<body>  
    <?php include ('modules/mAdminHeader.php'); ?>
    <br>
    <div id = query>
    <table style="margin-left:auto;margin-right:auto;" width="370" height="20">
        <tr>
      <td>Query:</td>
                <form style = "margin-left:auto" action="Query.php" method="POST" >
                  <td>
                      <textarea cols="50" rows="4" name="query" placeholder="Type your query here" autofocus required></textarea>
                  </td>
                  <td><button type="submit" name="Run">Run</button></td>
                </form>
        </tr>
    </table>
</div>

<div id="displayResultQuery">
    
<table style="margin-left: auto, margin-right: auto, width:100%" >  
    <tr>
            <?php
                 include_once "lib/config.php";
                 include_once "lib/DataProvider.php";
                 global $db_host, $db_username, $db_password, $db_name;
             
                 $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
                 /* check connection */
                 if ($connection->connect_error) {      
                     die("Failed to connect: " . $connection->connect_error);
                   }
                
                if(isset($_POST["query"]) && ($_POST["query"] != "")){
                    $sql ="";
                    $sql .=$_POST['query'];

                    $result = DataProvider::executeQuery($sql);
                    
                    if($result)
                    {
                        echo "<table style='width:100%' border = '1' cellspacing ='0' cellpadding = '0'>
                        <tr color ='#5D9951'>";
                        
                        if(mysqli_num_rows($result)>0)
                        {
                            while($property = mysqli_fetch_field($result))
                            {   
                                echo "<th align='left'><b>".$property->name."</th></b>";   
                            }
                            echo "</tr>";
                            
                            while($rows=$result->fetch_array(MYSQLI_ASSOC))
                            {
                                    echo "<tr>";

                                    foreach ($rows as $data)
                                    {
                                        echo "<td align='center'>".$data. "</td>";
                                    }
                                    $color=2;
                                    echo "</tr>"; 
                            }  
                        }
                        else 
                        {
                            echo"no results found";
                            echo "</table>";
                        }
                    }
                    else
                    {
                        echo "error running query!";
                    }
                }
            ?>
        <tr>
            <p><center><b>ReSult of Query: <?php if(isset($_POST["query"]) && ($_POST["query"] != "")){ echo $sql; }?></b></center></p>
        </tr>
    </tr>
</table>

</div>
</body>
