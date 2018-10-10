  <?php
  session_start(); 

  if (!isset($_SESSION['id'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: test.php');
  }
  
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<body>

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

<!-- Header with image -->



    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide"></span></h5>




</body>
</html>


<?php 
include('server.php');
include('process.php');


	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM USER_13082 WHERE id=$id");

		while ($row = mysqli_fetch_array($record)) 
		{
			//$n = mysqli_fetch_array($record);
			//$id = $row[0];
			$Username = $row[1];
			$ContactNum = $row[2];
			$Active = $row[3];
			$SalespersonID = $row[4];
			$Admin = $row[6];
		}

	}

	$check = 0;
	if (isset($_SESSION['id']))
	{
		$id1 = ($_SESSION['id']);
		$record = mysqli_query($db, "SELECT * FROM USER_13082 WHERE id=$id1");
		$row = mysqli_fetch_array($record);

		$check = $row['Admin'];
	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>USERS</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM USER_13082"); ?>
<div id="container">
<table>
	<thead>
		<tr>

			

			<h3> USERS INFORMATION </h3>


			<th>USER ID</th>
			<th>USER NAME</th>
			<th>CONTACT NUMBER</th>
			<th>ACTIVE</th>
			<th>SALESPERSON ID</th>
			<th>ADMIN</th>
										<?php
if ($check == '1')
{?><th>ACTIONS</th>
<?php }?>

	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['Username']; ?></td>
			<td><?php echo $row['ContactNum']; ?></td>
			<td><?php echo $row['Active']; ?></td>
			<td><?php echo $row['SalespersonID']; ?></td>
			<td><?php echo $row['Admin']; ?></td>
			<td>

											<?php
if ($check == '1')
{?>
				<a href="user.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			
				<a href="user.php?deluser=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>

		<?php }?>
		</tr>
	<?php } ?>
</table>
	

<?php
if ($check == '1')
{?>

<form method="post" action="user.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">

	<div class="input-group">
		<label>User ID</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>User Name</label>
		<input type="text" name="Username" value="<?php echo $Username; ?>">
	</div>

	<div class="input-group">
		<label>Contact Number</label>
		<input type="text" name="ContactNum" value="<?php echo $ContactNum; ?>">
	</div>
	
	<div class="input-group">
		<label>Active</label>
		<input type="text" name="Active" value="<?php echo $Active; ?>">
	</div>

	<div class="input-group">
		<label>Salesperson ID</label>
		<input type="text" name="SalespersonID" value="<?php echo $SalespersonID; ?>">
	</div>

	<div class="input-group">
		<label>Password</label>
		<input type="text" name="Password" value="<?php echo $Password; ?>">
	</div>

	<div class="input-group">
		<label>Admin</label>
		<input type="text" name="Admin" value="<?php echo $Admin; ?>">
	</div>



	<div class="input-group">

	



		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="updateuser" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="saveuser" >Save</button>
		<?php endif ?>
	</div>
</form>
</div>
<?php } ?>

<?php 
// initialize variables
	$Username = "";
	$ContactNum = "";
	$Active = "";
	$SalespersonID = "";
	$Password = "";
	$Admin = "";
	$id = 0;
	$update = false;

	

	$results = mysqli_query($db, "SELECT * FROM USER_13082");


?>

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