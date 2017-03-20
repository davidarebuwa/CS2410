<html >
<head>
<title>Find-The-Lost: Claim</title>
</head>
<body>
<body style="background-color:#F5F3EE">
<?php

	 // Start the session
     session_start();
	
	//Defining the variables
	$username = $itemname = $itemcategory = $phoneno= $address = $requestreason = "";
	$usernameErr = $itemnameErr = $itemcategoryErr = $numErr = $addressErr  = $reasonErr = "";
	
	//Validation
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $usernameErr = "Invalid Syntax. Please input a valid username as it is required!";
    } else {
      $username = test_input($_POST["username"]);
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)){
        $usernameErr = "Incorrect syntax";
    }
    }
    
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
  if (empty($_POST["phoneno"])) {
    $numErr = "Invalid Syntax. please enter a valid phone number as it is required!";
  } else {
    $phoneno = test_input($_POST["phoneno"]);
	if (!preg_match("^/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/$",$phoneno)) {
      $numErr = "Incorrect syntax";
	}
  }
  
  if (empty($_POST["address"])) {
    $addressErr = "Invalid Syntax. please enter a valid address as it is required!";
  } else {
    $address = test_input($_POST["address"]);
	if (!preg_match("/^[\p{L}\s'.-]+$/",$address)) {
      $addressErr = "Incorrect syntax";
	}
  }
  
  
  if (empty($_POST["requestreason"])) {
    $reasonErr = " please enter a valid reason as it is required!";
  } else {
    $requestreason = test_input($_POST["requestreason"]);
  }
	}
	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  
  


}
?>
	
<h2>Filo:Item Claim Application</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Username:<input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  Item name:<input type="text" name="item name" value="<?php echo $itemname;?>">
  <span class="error">* <?php echo $itemnameErr;?></span>
  <br><br>
  Address: <textarea name="comment" rows="5" cols="40"><?php echo $address;?></textarea>
  <br><br>
  Item Category:<input type="text" name="item category" value="<?php echo $itemcategory;?>">
  <span class="error">* <?php echo $itemcategoryErr;?></span>
  <br><br>
  Reason for Request: <textarea name="comment" rows="5" cols="40"><?php echo $requestreason;?></textarea>
  <br><br>
  <span class="error">* <?php echo $reasonErr;?></span>
  <br><br>
  Phone no:<input type="text" name="phoneno" value="<?php echo $phoneno;?>">
  <span class="error">* <?php echo $numErr;?></span>
  <br><br>
	<input type="submit" name="submit" value="Submit">  
  <input type="reset" value="clear"/><br></br>
</form>
  
 
  
  <a href="reportitemform.php">Reporting a Found item? Apply here</a> 
</form>
&copy; 2010-<?php echo date("Y"); ?> 
</body>
</html>
