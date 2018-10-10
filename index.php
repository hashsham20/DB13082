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



    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide"></span></h5>
  



</body>
</html>


<?php 
include('server.php');
include('process.php');


	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM CUSTOMERS WHERE id=$id");

		while ($row = mysqli_fetch_array($record)) 
		{
			//$n = mysqli_fetch_array($record);
			$id = $row[0];
			$SHOPNAME = $row[1];
			$ADDRESS = $row[2];
			$CONTACT = $row[3];
			$CONTACTNUM = $row[4];
			$AREA  = $row[5];
			$COORDINATES  = $row[6]; 
			$CREATED_BY = $row[7];

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
	<title>CUSTOMERS</title>
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

<?php $results = mysqli_query($db, "SELECT * FROM CUSTOMERS"); ?>


<div id="container">
<table>
	<thead>
		<tr>

			<h3> CUSTOMERS INFORMATION </h3>


			<th>SHOPID</th>
			<th>SHOPNAME</th>
			<th>ADDRESS</th>
			<th>CONTACT</th>
			<th>CONTACTNUM</th>
			<th>AREA</th>
			<th>COORDINATES</th>
			<th>CREATED</th>
				<?php
if ($check != '1')
{?><th>ACTIONS</th><?php } ?>

	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['SHOPNAME']; ?></td>
			<td><?php echo $row['ADDRESS']; ?></td>
			<td><?php echo $row['CONTACT']; ?></td>
			<td><?php echo $row['CONTACTNUM']; ?></td>
			<td><?php echo $row['AREA']; ?></td>
			<td><?php echo $row['COORDINATES']; ?></td>
			<td><?php echo $row['CREATED_BY']; ?></td>
			
							<?php
if ($check != '1')
{?>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			
				<a href="index.php?delcust=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
<?php } ?>
			
		</tr>
	<?php } ?>
</table>
	
	<?php
if ($check != '1')
{?>


<form method="post" action="server.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">

	<div class="input-group">
		<label>Serial ID</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>Shop Name</label>
		<input type="text" name="name" value="<?php echo $SHOPNAME; ?>">
	</div>

	<div class="input-group">
		<label>Address</label>
		<input type="text" name="address" value="<?php echo $ADDRESS; ?>">
	</div>

	<div class="input-group">
		<label>Contact</label>
		<input type="text" name="contact" value="<?php echo $CONTACT; ?>">
	</div>

	<div class="input-group">
		<label>Contact Number</label>
		<input type="text" name="contactnum" value="<?php echo $CONTACTNUM; ?>">
	</div>

	<div class="input-group">
		<label>Area</label>
		<input type="text" name="area" value="<?php echo $AREA; ?>">
	</div>

	<div class="input-group">
		<label>Coordinates</label>
		<input type="text" name="coordinates" value="<?php echo $COORDINATES; ?>">
	</div>

	<div class="input-group">
		<label>Created By</label>
		<input type="text" name="created_by" value="<?php echo $CREATED_BY; ?>">
	</div>

	<div class="input-group">



		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="updatecust" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="savecust" >Save</button>
		<?php endif ?>
	</div>
</form>
</div>
<?php } ?>


<?php 
// initialize variables
	$SNUM = "";
	$SHOPNAME = "";
	$ADDRESS = "";
	$CONTACT = "";
	$CONTACTNUM = "";
	$AREA = "";
	$COORDINATES = "";
	$CREATED_BY = "";

	$id = 0;
	$update = false;



	$results = mysqli_query($db, "SELECT * FROM CUSTOMERS");


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