
<!DOCTYPE html>
<html>
<title>HOME PAGE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="new.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<style>
body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}

</style>
<body style="background-image: url('image.jpg'); background-size: cover;">
<header>

 <div class = "wrapper">
            <div class = "nav">
                  <uk>
                  <button onclick="location.href='HomePage.php'" type="button">
                  HOME</button>
                  </uk>
                  <ul>
                  <button onclick="location.href='user.php'" type="button">
                  USERS</button>
                  <button onclick="location.href='salesperson.php'" type="button">
                  SALESPERSON</button>
                  <button onclick="location.href='products.php'" type="button">
                  PRODUCTS</button>
                  <button onclick="location.href='index.php'" type="button">
                  CUSTOMERS</button>
                  <button onclick="location.href='HomePage.php?logout'" type="del" class="
                  del_btn">LOGOUT</button>
                  </ul>
            </div>
      </div> 

    </header>
    



    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide" ></span></h5>
   



</body>
</html>


<?php 
  session_start(); 

  if (!isset($_SESSION['id'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: test.php');
  }
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['id'])) : ?>
      <div id="container">
      <div class="bg-text">
      <h4>WELCOME USER NUMBER <?php echo $_SESSION['id']; ?> </h4>
      <p>Explore The Management System, Thank you For Visiting.</p>
    </div>
  </div>
      
    <?php endif ?>

    <?php 
    if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    header("location: HomePage.php");
   }
    ?>

</div>  

<footer id="footer">
  <h4>
    CONTACT US
  </h4>
  <p>
    <a class="fab fa-facebook fa-lg" href="#"></a>
    <a class="fab fa-whatsapp fa-lg" href="#"></a>
    <a class="fab fa-skype fa-lg" href="#"></a>
    <a class="fab fa-google fa-lg" href="#"></a>
  </p>
</footer>
		
</body>
</html>