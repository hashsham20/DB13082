  <?php
include('server.php');

  if (!isset($_SESSION['id'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: test.php');
  }

			$id = "";
			$SName = "";
			$ContactNum = "";
			$ListCust = "";
			$update = "";

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
                  <button onclick="location.href='invoice.php'" type="button">
                  INVOICE</button>
                  <button onclick="location.href='HomePage.php?logout'" type="del" class="
                  del_btn">LOGOUT</button>
                  </ul>
            </div>
      </div>  


    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide"></span></h5>




</body>
</html>


<?php 



	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM SALESPERSON_13082 WHERE id=$id");

		while ($row = mysqli_fetch_array($record)) 
		{
			//$n = mysqli_fetch_array($record);
			$id = $row[0];
			$SName = $row[1];
			$ContactNum = $row[2];
			$ListCust = $row[3];
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
	<title>SALESPERSONS</title>
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

<?php $results = mysqli_query($db, "SELECT * FROM SALESPERSON_13082"); ?>
<div id="container">
<table>
	<thead>
		<tr>

			<h3> SALES PERSONS INFORMATION </h3>


			<th>SALESPERSON ID</th>
			<th>NAME</th>
			<th>CONTACT NUMBER</th>
			<th>CUSTOMERS ASSIGNED</th>
										<?php
if ($check == '1')
{?>
			<th>ACTIONS</th>
		<?php }?>

	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['SName']; ?></td>
			<td><?php echo $row['ContactNum']; ?></td>
			<td><?php echo $row['ListCust']; ?></td>
			

											<?php
if ($check == '1')
{?>				
				<td>
				<a href="salesperson.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			
				<a href="salesperson.php?delsales=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>

		<?php }?>
		</tr>
	<?php } ?>
</table>
	
		<?php
if ($check == '1')
{?>

<form method="post" action="salesperson.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">

	<div class="input-group">
		<label>SalesPerson ID</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>User Name</label>
		<input type="text" name="SName" value="<?php echo $SName; ?>">
	</div>
	
	<div class="input-group">
		<label>ContactNum</label>
		<input type="text" name="ContactNum" value="<?php echo $ContactNum; ?>">
	</div>

	<div class="input-group">
		<label>ListCust</label>
		<input type="text" name="ListCust" value="<?php echo $ListCust; ?>">
	</div>


	<div class="input-group">



		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="updatesales" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="savesales" >Save</button>
		<?php endif ?>
	</div>
</form>
</div>


<?php } ?>

<?php 
// initialize variables
	$SName = "";
	$ContactNum = "";
	$ListCust = "";
	$id = 0;
	$update = false;

	

	$results = mysqli_query($db, "SELECT * FROM SALESPERSON_13082");


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