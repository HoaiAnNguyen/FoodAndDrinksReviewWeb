<?php
    function checkingID($connection ,$id){
        $sqlID = 
        "SELECT postID 
        FROM post 
        WHERE postID = '$id'";
        $resultID = mysqli_query($connection, $sqlID) or die(mysqli_connect_errno()."Query ID Doesn't run");

        return $resultID;
    }

    function checkingUser($connection ,$username){
        $sqlUser = 
        "SELECT username 
        FROM account 
        WHERE username = '$username'";
        $resultUser = mysqli_query($connection, $sqlUser) or die(mysqli_connect_errno()."Query User Doesn't run");

        return $resultUser;
    }

    function checkingName($connection ,$name){
        $sqlName = 
        "SELECT name 
        FROM account 
        WHERE name = '$name'";
        $resultName = mysqli_query($connection, $sqlName) or die(mysqli_connect_errno()."Query Name Doesn't run");

        return $resultName;
    }
?>