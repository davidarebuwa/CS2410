<html >
<head>
<title>Filo: Report Item</title>
</head>
<body>
<body style="background-color:#F5F3EE">
<?php

	 // Start the session
     session_start();
	 
	 $dbusername = "bosunard";
     $dbpassword = "inti99olds";
	 //if the form has been submitted
     if (isset($_POST['submitted'])){
	//create a database connection
	$db = new PDO("mysql:dbname=bosunard_db; host=bosunard.eas-cs2410-1617.aston.ac.uk", $dbusername, $dbpassword);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 echo "Connected successfully"; 
	//get and sanitise the inputs, we don't need to do this with the password as we hash it anyway
	$safe_itemname = $db->quote($_POST['item_name']);
	$safe_category = $db->quote($_POST['item_category']);
	$safe_foundtime = $db->quote($_POST['found_time']);
	$safe_user = $db->quote($_POST['found_user']);
	$safe_place = $db->quote($_POST['found_place']);
	$safe_colour = $db->quote($_POST['item_colour']);
	$safe_description = $db->quote($_POST['item_description']);
	$safe_photo = $db->quote($_POST['item_photo']);

		
	//insert the entry into the database
	$query = "INSERT INTO user VALUES (default, $safe_itemname, $safe_category, $safe_foundtime, $safe_user,$safe_place,$safe_colour, $safe_description, $safe_photo)";

	$db->exec($query);	

	//get the ID
	$id = $db->lastInsertId();
	
	//Output success or the errors
	echo "Congratulations! The item has been registered. Item ID is: $id";
}
	//Defining the variables
	$itemname = $itemcategory = $timefound = $addressfound = $itemcolour = $itemphoto = $itemdescription = "";
	$itemnameErr = $itemcategoryErr = /**$timeErr*/  $addressErr = /**$colourErr*/  $photoErr = $itemDescriptionErr = "";
	
	//Validation
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["itemname"])) {
    $itemnameErr = "Invalid Syntax. Please input a valid item name as it is required!";
  } else {
    $itemname = test_input($_POST["itemname"]);
	if (!preg_match("/^[\p{L}\s'.-]+$/",$itemname)){
      $itemnameErr = "Incorrect syntax";
	}
  }
  
  
  if (empty($_POST["itemcategory"])) {
    $itemcategoryErr = "Invalid Syntax. please enter a valid category as it is required!";
  } else {
    $itemcategory = test_input($_POST["itemcategory"]);
	if (!preg_match("/^[\p{L}\s'.-]+$/",$itemcategory)) {
      $itemcategoryErr = "Incorrect syntax";
	}
  }
  
  if (empty($_POST["addressfound"])) {
    $addressErr = "Invalid Syntax. please enter a valid address as it is required!";
  } else {
    $address = test_input($_POST["address"]);
	if (!preg_match("/^[\p{L}\s'.-]+$/",$address)) {
      $addressErr = "Incorrect syntax";
	}
  }
  
  
  if (empty($_POST["itemdescription"])) {
    $itemDescriptionErr = " please enter a valid description as it is required!";
  } else {
    $itemdescription = test_input($_POST["itemdescription"]);
  }
	}
	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  
  


}
?>
	
<h2>Filo:Found Item Form</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Item name:<input type="text" name="item name" value="<?php echo $itemname;?>">
  <span class="error">* <?php echo $itemnameErr;?></span>
  <br><br>
  Item Category:<input type="text" name="item category" value="<?php echo $itemcategory;?>">
  <span class="error">* <?php echo $itemcategoryErr;?></span>
  <br><br>
  Time Found:<input type="datetime-local" name="foundtime" value="<?php echo $timefound;?>">
  <span class="error">* 
  <br><br>
  Address: <textarea name="comment" rows="5" cols="40"><?php echo $addressfound;?></textarea>
  <br><br>
  Colour:<input type="color" name="itemcolour" value="#ff0000">
  <span class="error">* 
  <br><br> 
  Description: <textarea name="comment" rows="5" cols="40"><?php echo $itemdescription;?></textarea>
  <br><br>
  <span class="error">* <?php echo $itemDescriptionErr;?></span>
  <br><br>
  </form>
  
  <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
	<input type="submit" name="submit" value="Submit">  
  <input type="reset" value="clear"/><br></br>
</form>
  
 
  
  <a href="applicationform.php">Claiming a Lost item? Apply here</a> <br /><br />
  <a href="loggedout.php"> Log out?</a>
</form>
&copy; 2010-<?php echo date("Y"); ?> 
</body>
</html>
