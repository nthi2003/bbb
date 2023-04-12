<?php

$host="localhost";
$user="root";
$password="";
$db="user";

$data=mysqli_connect($host,$user,$password,$db);
if($data===false){
    die("connecton error");
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $sql="SELECT * FROM `login` WHERE username='" .$username."' AND password='".$password."'
    ";
    $result=mysqli_query($data,$sql);

    $row=mysqli_fetch_array($result);

  
    if($row["usertype"]=="admin"){
        header("location:admin_page.php");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<center>

<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="text" name="username" required placeholder="enter user" class="box"> 
    
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="submit" name="submit" class="btn" value="login now">
    
   </form>

</div>

</center>

</body>
</html>