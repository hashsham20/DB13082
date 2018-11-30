<!DOCTYPE html>
<html>
<title>SURVEY FORM</title>
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
<body>
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
                  <button onclick="location.href='invoice.php'" type="button">
                  INVOICE</button>
                  <button onclick="location.href='survey.php'" type="button">
                  SURVEY</button>
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
	require_once('server.php');
	require_once('vendor/autoload.php');

	
    
	if(!isset($_SESSION['id']))
	{
		header("Location: test.php");
	}

	$client = new MongoDB\Client;
	$database = $client->selectDatabase('db');
	$collection = $database->selectCollection('collection');
	if (isset($_POST['create']))
	{
		$target_dir = "./upload/";
		$target_file = $target_dir.$_FILES["image"]["name"]; //Image:<input type="file" id="image" name="image">
		if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
		$data = [
			'coordinates' => $_POST['coordinates'],
			'shopName' => $_POST['shopName'],
			'available' => $_POST['available'],
			'front' => $_POST['front'],
			'competitor' => $_POST['competitor'],
			'timestamp' => new MongoDB\BSON\UTCDateTime,
			'image' => $_FILES['image']['name']
		];
		//$tag = $_REQUEST['username'];
			}
			else
			{
				echo 'FILE NOT MOVED!';
				echo '<br>';
				echo $_FILES['image']['tmp_name'];
				echo '<br>';
			    echo $_FILES['image']['name'];
			    echo '<br>';
			    echo $target_file;
			    echo '<br>';
			}
				
		$result = $collection->insertOne($data);
		if($result->getInsertedCount() > 0)
		{
			$_SESSION['success_msg'] = "Form submitted";
			header('location: survey.php');
		}
		else {
			$_SESSION['error_msg'] = "Failed to submit";
			header('location: survey.php');
		}
	}
	if (isset($_GET['delete']))
	{
		$filter = ['_id' => new MongoDB\BSON\ObjectId($_GET['delete'])];
		$form = $collection->findOne($filter);
		if (!$form)
		{
			$_SESSION['error_msg'] = "Form not found";
			header('location: survey.php');
		}
		$filename = 'upload/'.$form['image'];
		if (file_exists($filename))
		{
			if (!unlink($filename))
			{
				//$_SESSION['error_msg'] = "Unable to delete file";
				//header('location: survey.php');
			}
		}
		$result = $collection->deleteOne($filter);
		if ($result->getDeletedCount() > 0)
		{
			$_SESSION['success_msg'] = "Form Deleted";
			header('location: survey.php');
		}
		else
		{
			$_SESSION['error_msg'] = "An error occurred";
			header('location: survey.php');
		}
	}
	if (isset($_SESSION['success_msg']))
    {
        echo '<br><br><div class="bg bg-success">';
        echo '<b>'; echo $_SESSION['success_msg']; echo '</b>';
        unset($_SESSION['success_msg']);
        echo '
        </div>';
    }
	if (isset($_SESSION['error_msg']))
	{
        echo '<br><br><div class="bg bg-danger">';
        echo '<b>'; echo $_SESSION['error_msg']; echo '</b>';
        unset($_SESSION['error_msg']);
        echo '
        </div>';
	}
	?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
tr:hover {background-color: #f5f5f5;}
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=submit]:hover {
    background-color: #45a049;
}
test {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>


<h3 align = "middle">Paint Shop Survey Form</h3>
<hr>

	
	<?php
	$forms = $collection->find();
	foreach($forms as $key => $form){
		$UTCDateTime = new MongoDB\BSON\UTCDateTime((string)$form['timestamp']);
		$DateTime = $UTCDateTime->toDateTime();

		echo '<br><br><br><hr>
		<div class = "rows">
				<div class = "col-md-12">'.$DateTime->format('d/m/Y H:i:s').'</div>
				<div class = "rows">
					<div class = "col-md-3"><img src="upload/'.$form['image'].'" width="720">
					</div>
					
					<div class ="col-md-8">
						<strong>'.$form['shopName'].'</strong>
            <br>
						<strong>Coordinates: '.$form['coordinates'].'</strong>
            <br>
						<strong>Are my products available in shop? : '.$form['available'].'</strong>
            <br>
						<strong>Are my products positioned in front? : '.$form['front'].'</strong>
            <br>
						<strong>Are competitor products more prominent? : '.$form['competitor'].'</strong>

					</div>
					
					<div class = "col-md-1"><a href ="survey.php?delete='.$form['_id'].'">Delete</a></div>
					</div>
				</div>
				<br><br><br><hr>';
	} 
	?>




<br><br><br><br>

<div class="test">

<form action = "survey.php" method="post" enctype="multipart/form-data">
 	
<hr>
	<h3 align="middle">Fill Shop Survey Form</h3>

	<p><b>Geographical Coordinates</b>: 
	<input type="text" name="coordinates" size="100" value="" >
	</p>

	<p><b>Shop Name</b>: 
	<input type="text" name="shopName" size="50" value="" />
	</p>

	<p><b>Products Available?</b>: <br>
	<input type="radio" name="available" value="Yes">Yes   
	<input type="radio" name="available" value="No"> No
	</p>

	<p><b>Products positioned in front?</b>: <br>
	<input type="radio" name="front" value="Yes">Yes
	<input type="radio" name="front" value="No">No
	</p>

	<p><b>Competitor products more prominent?</b>: <br>
	<input type="radio" name="competitor" value="Yes">Yes
	<input type="radio" name="competitor" value="No">No
	</p>

	<p><b>Picture</b>: 
	<input type="file" name="image" required>
	</p>

	<input type="submit" name="create" value="Insert" />
<?php 
	echo '
	
</form>
</div>
';
?>
