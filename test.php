<!DOCTYPE html>
<html>
<title>LOGIN PAGE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="new.css">
<link rel="stylesheet" href="new.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}

</style>
<body style="background-image: url('image.jpg'); background-size: cover;">

<h2>
  DELTA PAINTS
  <p>
    Paints Done Right.
  </p>

</h2>









</body>
</html>

<?php
session_start();
include('server.php');

$id = "";
$Password = "";

if (isset($_POST['login_user'])) {
    $id = $_POST['id'];
    $Password = $_POST['Password'];

  if (empty($id)) {
     echo "User ID is required";
  }
 else
 {

    
    $query = "SELECT * FROM USER_13082  WHERE id='$id' AND Password='$Password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['id'] = $id;
      header('location: HomePage.php');
    }else {
        echo "Wrong username/password combination";
    }
  
}
}

?>

<html>
<head>
  <title>LOGIN PAGE</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
</head>
<body>
  
  <form method="post" action="test.php">
    <div class="input-group">
        <label>User ID</label>
        <input type="text" name="id" >
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="Password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>

  </form>



</body>
</html>