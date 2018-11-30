<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>
<?php 



	session_start();
	$db = mysqli_connect('localhost', 'hashsham', 'khewb69', 'project1');


	if (isset($_POST['savecust'])) {

		$id = $_POST['id'];
		$SHOPNAME = $_POST['name'];
		$ADDRESS = $_POST['address'];
		$CONTACT = $_POST['contact'];
		$CONTACTNUM = $_POST['contactnum'];
		$AREA = $_POST['area'];
		$COORDINATES = $_POST['coordinates'];
		$CREATED_BY = $_POST['created_by'];

		if ($id == '0' || $id == '' || $SHOPNAME == ''|| $ADDRESS == ''|| $CONTACT == ''|| $CONTACTNUM == ''|| $AREA == ''
			|| $COORDINATES == ''|| $CREATED_BY == '') 
		{
		$_SESSION['message'] = "ENTER COMPLETE DATA FIRST!!"; 
		}

		else
		{
		mysqli_query($db, "INSERT INTO CUSTOMERS
			VALUES ('$id','$SHOPNAME', '$ADDRESS', '$CONTACT', '$CONTACTNUM', '$AREA', 
			'$COORDINATES', '$CREATED_BY')"); 
		
		
		$_SESSION['message'] = "SAVED!"; 
		}
				header('location: index.php');
	}

	if (isset($_POST['updatecust'])) {
		$id = $_POST['id'];
		$SHOPNAME = $_POST['name'];
		$ADDRESS = $_POST['address'];
		$CONTACT = $_POST['contact'];
		$CONTACTNUM = $_POST['contactnum'];
		$AREA = $_POST['area'];
		$COORDINATES = $_POST['coordinates'];
		$CREATED_BY = $_POST['created_by'];


		mysqli_query($db, "UPDATE CUSTOMERS SET SHOPNAME = '$SHOPNAME', ADDRESS = '$ADDRESS', CONTACT = '$CONTACT', CONTACTNUM = '$CONTACTNUM', AREA = '$AREA', COORDINATES = '$COORDINATES', CREATED_BY = '$CREATED_BY' WHERE id=$id");
		$_SESSION['message'] = "UPDATED"; 
		header('location: index.php');
	}

if (isset($_GET['delcust'])) {
	$id = $_GET['delcust'];
	mysqli_query($db, "DELETE FROM CUSTOMERS WHERE id=$id");
	$_SESSION['message'] = "DELETED!"; 
	header('location: index.php');
}



if (isset($_POST['saveprod'])) {

		$id = $_POST['id'];
		$Brand = $_POST['Brand'];
		$Type = $_POST['Type'];
		$Shade = $_POST['Shade'];
		$Size = $_POST['Size'];
		$Salesprice = $_POST['Salesprice'];

		if ($id == '0' || $id == '' || $Brand == ''|| $Shade == ''|| $Size == ''|| $Salesprice == '') 
		{
		$_SESSION['message'] = "ENTER COMPLETE DATA FIRST!!"; 
		}

		else
		{

		mysqli_query($db, "INSERT INTO PRODUCTS_13082 
			VALUES ('$id','$Brand', '$Type', '$Shade', '$Size', '$Salesprice')"); 
		
		
		$_SESSION['message'] = "SAVED!"; 
		}
				header('location: products.php');
	}

	if (isset($_POST['updateprod'])) {
	
		$id = $_POST['id'];
		$Brand = $_POST['Brand'];
		$Type = $_POST['Type'];
		$Shade = $_POST['Shade'];
		$Size = $_POST['Size'];
		$Salesprice = $_POST['Salesprice'];


		mysqli_query($db, "UPDATE PRODUCTS_13082 SET Brand = '$Brand', Type = '$Type',  Shade = '$Shade', Size = '$Size', Salesprice = '$Salesprice' WHERE id=$id");
		$_SESSION['message'] = "UPDATED"; 
		header('location: products.php');
	}

if (isset($_GET['delprod'])) {
	$id = $_GET['delprod'];
	mysqli_query($db, "DELETE FROM PRODUCTS_13082 WHERE id=$id");
	$_SESSION['message'] = "DELETED!"; 
	header('location: products.php');
}


if (isset($_POST['saveuser'])) {

		$id = $_POST['id'];
		$Username = $_POST['Username'];
		$ContactNum = $_POST['ContactNum'];
		$Active = $_POST['Active'];
		$SalespersonID = $_POST['SalespersonID'];
		$Password = $_POST['Password'];
		$Admin = $_POST['Admin'];

		if ($id == '0' || $id == '' || $Username == '' || $ContactNum == '' || $Active == ''|| $Password == '' 
			|| $Admin == '') 
		{
		$_SESSION['message'] = "ENTER COMPLETE DATA FIRST!!"; 
		}

		else
		{
			if ($SalespersonID == '')
			{
		mysqli_query($db, "INSERT INTO USER_13082
			VALUES ('$id','$Username', '$ContactNum', '$Active', '$SalespersonID', '$Password', '$Admin')"); 		
			}

			else 
			{
			mysqli_query($db, "INSERT INTO USER_13082
			VALUES ('$id','$Username', '$ContactNum', '$Active', '$SalespersonID', '$Password', '$Admin')"); 
				mysqli_query($db, "INSERT INTO SALESPERSON_13082
			VALUES ('$SalespersonID', '$Username',  '$ContactNum', '')");
			}

		$_SESSION['message'] = "SAVED!"; 

		}
				header('location: user.php');
	}

	if (isset($_POST['updateuser'])) {
	
		$id = $_POST['id'];
		$Username = $_POST['Username'];
		$ContactNum = $_POST['ContactNum'];
		$Active = $_POST['Active'];
		$SalespersonID = $_POST['SalespersonID'];
		$Admin = $_POST['Admin'];


		mysqli_query($db, "UPDATE USER_13082 SET Username = '$Username', ContactNum = '$ContactNum',  Active = '$Active', SalespersonID = '$SalespersonID'
		, Admin = '$Admin' WHERE id=$id");
		$_SESSION['message'] = "UPDATED"; 
		header('location: user.php');
	}

if (isset($_GET['deluser'])) {
	$id = $_GET['deluser'];
	mysqli_query($db, "DELETE FROM USER_13082 WHERE id=$id");
	$_SESSION['message'] = "DELETED!"; 
	header('location: user.php');
}

if (isset($_POST['savesales'])) {

		$id = $_POST['id'];
		$SName = $_POST['SName'];
		$ContactNum = $_POST['ContactNum'];
		$ListCust = $_POST['ListCust'];

		if ($id == '0' || $id == '' || $SName == '' || $ContactNum == ''|| $ListCust == '') 
		{
		$_SESSION['message'] = "ENTER COMPLETE DATA FIRST!!"; 
		}

		else
		{

	mysqli_query($db, "INSERT INTO SALESPERSON_13082
			VALUES ('$id','$SName', '$ContactNum', '$ListCust')"); 		
		$_SESSION['message'] = "SAVED!"; 

		}
				header('location: salesperson.php');
	}

	if (isset($_POST['updatesales'])) {
	
		$id = $_POST['id'];
		$SName = $_POST['SName'];
		$ContactNum = $_POST['ContactNum'];
		$ListCust = $_POST['ListCust'];


		mysqli_query($db, "UPDATE SALESPERSON_13082 SET SName = '$SName', ContactNum = '$ContactNum', ListCust = '$ListCust' WHERE id=$id");
		$_SESSION['message'] = "UPDATED"; 
		header('location: salesperson.php');
	}

if (isset($_GET['delsales'])) {
	$id = $_GET['delsales'];
	mysqli_query($db, "DELETE FROM SALESPERSON_13082 WHERE id=$id");
	$_SESSION['message'] = "DELETED!"; 
	header('location: salesperson.php');
}
	
	if(isset($_GET["do"]) && $_GET["do"] == "create"){
	$o = $_POST['orderNum'];
	$c = $_POST['customID'];
	$d = $_POST['date'];
	$p = $_POST['pcode'];
	$q = $_POST['quant'];
	$r = $_POST['rate'];
	$a = $_POST['amount'];
	mysqli_query($db, "INSERT INTO invoice_13082(CustID, Date, PCode, Quantity, Rate, Amount) VALUES($c, '$d', $p, $q, $r, $a)");
	$lastOrder = mysqli_fetch_assoc(mysqli_query($db, "SELECT Max(OrderNum) ORN FROM INVOICE_13082"));
	echo strip_tags($lastOrder["ORN"]);
}

	else if(isset($_GET["do"]) && $_GET["do"] == "delete"){
		
	$orderID = $_GET["delID"];
	mysqli_query($db, "DELETE FROM invoice_13082 WHERE OrderNum='$orderID'");
	echo "Successfully Deleted Order# ".$_GET["delID"];
}
else if(isset($_GET["do"])){
	$o = $_POST['orderNum'];
	$c = $_POST['customID'];
	$d = $_POST['date'];
	$p = $_POST['pcode'];
	$q = $_POST['quant'];
	$r = $_POST['rate'];
	$a = $_POST['amount'];
	if($_GET["do"] == "update"){
	mysqli_query($db, "UPDATE invoice_13082 SET Date='$d', PCode='$p', Quantity='$q', Rate='$r', Amount='$a' WHERE OrderNum='$o'");
	echo "Successfully Updated";
}
}

if(isset($_GET["customID"])){
	$customID = $_GET["customID"];
	$finalResult = array();
	$result = mysqli_query($db, "SELECT * FROM CUSTOMERS WHERE id='$customID'");
	$result = mysqli_fetch_assoc($result);
	array_push($finalResult, json_encode($result));

	$result = mysqli_query($db, "SELECT * FROM invoice_13082 WHERE CustID=$customID");
	$result = mysqli_fetch_all($result,MYSQLI_ASSOC);
	array_push($finalResult, json_encode($result));

	$result = mysqli_query($db, "SELECT * FROM PRODUCTS_13082");
	$result = mysqli_fetch_all($result,MYSQLI_ASSOC);

	array_push($finalResult, json_encode($result));

	echo json_encode($finalResult);
}

?>