  <?php
include('server.php');

  if (!isset($_SESSION['id'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: test.php');
  }

  			$id = "";
			$Brand = "";
			$Type = "";
			$Shade = "";
			$Size = "";
			$Salesprice  = "";
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
		$record = mysqli_query($db, "SELECT * FROM PRODUCTS_13082 WHERE id=$id");

		while ($row = mysqli_fetch_array($record)) 
		{
			//$n = mysqli_fetch_array($record);
			$id = $row[0];
			$Brand = $row[1];
			$Type = $row[2];
			$Shade = $row[3];
			$Size = $row[4];
			$Salesprice  = $row[5];
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
	<title>PRODUCTS</title>
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

<?php $results = mysqli_query($db, "SELECT * FROM PRODUCTS_13082"); ?>
<div id="container">
<table>
	<thead>
		<tr>

			<h3> PRODCUTS INFORMATION </h3>


			<th>PRODUCT CODE</th>
			<th>BRAND</th>
			<th>TYPE</th>
			<th>SHADE</th>
			<th>SIZE</th>
			<th>SALES PRICE</th>
			<th>ACTIONS</th>

	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['Brand']; ?></td>
			<td><?php echo $row['Type']; ?></td>
			<td><?php echo $row['Shade']; ?></td>
			<td><?php echo $row['Size']; ?></td>
			<td><?php echo $row['Salesprice']; ?></td>
			<td>


				<a href="products.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			
				<a href="products.php?delprod=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>

		<?php }?>
		</tr>
</table>
	



<form method="post" action="products.php" >

	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="input-group">

	<div class="input-group">
		<label>Product Code</label>
		<input type="text" name="id" value="<?php echo $id; ?>">
	</div>	

	<div class="input-group">
		<label>Brand</label>
		<input type="text" name="Brand" value="<?php echo $Brand; ?>">
	</div>

	<div class="input-group">
		<label>Type</label>
		<input type="text" name="Type" value="<?php echo $Type; ?>">
	</div>

	<div class="input-group">
		<label>Shade</label>
		<input type="text" name="Shade" value="<?php echo $Shade; ?>">
	</div>

	<div class="input-group">
		<label>Size</label>
		<input type="text" name="Size" value="<?php echo $Size; ?>">
	</div>

	<div class="input-group">
		<label>Sales Price</label>
		<input type="text" name="Salesprice" value="<?php echo $Salesprice; ?>">
	</div>

	<div class="input-group">



		<?php if ($update == true): ?>
			<button class="btn" type="submit" name="updateprod" style="background: #556B2F;" >Update</button>
		<?php else: ?>
			<button class="btn" type="submit" name="saveprod" >Save</button>
		<?php endif ?>
	</div>
</form>
</div>



<?php 
// initialize variables
	$Brand = "";
	$Type = "";
	$Shade = "";
	$Size = "";
	$Salesprice = "";
	$id = 0;
	$update = false;

	

	$results = mysqli_query($db, "SELECT * FROM PRODUCTS_13082");


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