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
	$safe_username = $db->quote($_POST['username']);
	$safe_firstname = $db->quote($_POST['user_first_name']);
	$safe_surname = $db->quote($_POST['user_last_name']);
	$safe_address = $db->quote($_POST['address']);
	$safe_phoneno = $db->quote($_POST['phone_number']);
	$hashed_password = md5($_POST['password']);
		
	//insert the entry into the database
	$query = "INSERT INTO user VALUES (default, $safe_username, '$hashed_password', $safe_firstname, $safe_surname,$safe_address,$safe_phoneno)";

	$db->exec($query);	

	//get the ID
	$id = $db->lastInsertId();
	
	//Output success or the errors
	echo "Congratulations! You are now registered. Your ID is: $id";
}
	
	//Defining the variables
	$username = $password = $firstname = $surname = $address = $phoneno /*= $email*/ = $usertype = "";
	$usernameErr = $passwordErr = $firstNameErr = $surNameErr = $numErr = $addressErr = "";
	
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
  $hash = md5($_POST['passw']);
  if (trim($_POST["passw"]) == "") {
    $passwordErr = "Invalid Syntax. please enter a valid password as it is required!";
  } else {
    $password = test_input($_POST["passw"]);
	if (!preg_match("/^(?=.*\d).{6,20}$/",$password)) {
      $passwordErr = "Incorrect syntax. Password must be between 6 and 20 digits long and include at least one numeric digit.";
	}
  }
  
  if (empty($_POST["firstname"])) {
    $firstNameErr = "please enter a valid first name as it is required!";
  } else {
    $firstname = test_input($_POST["firstname"]);
  }
  
  
  if (empty($_POST["surname"])) {
    $surNameErr = "Invalid Syntax. please enter a valid surname as it is required!";
  } else {
    $surname = test_input($_POST["surname"]);
	
  }
  
  if (empty($_POST["address"])) {
    $addressErr = "";
  } else {
    $address = test_input($_POST["address"]);
  }
  
  if (empty($_POST["phoneno"])) {
    $numErr = "Invalid Syntax. please enter a valid phone number as it is required!";
  } else {
    $phoneno = test_input($_POST["phoneno"]);
	if (!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/",$phoneno)) {
      $numErr = "Incorrect syntax should be in 000-0000-0000 form";
	}
  }
	}
	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  



}
?>
<html>
<head>
<title>Find-The-Lost</title>
</head>
<body>
<body style="background-color:#F5F3EE">
<h2>Filo:Registration Form</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  First name:<input type="text" name="first name" value="<?php echo $firstname;?>">
  <span class="error">* <?php echo $firstNameErr;?></span>
  <br><br>
  Surname:<input type="text" name="surname" value="<?php echo $surname;?>">
  <span class="error">* <?php echo $surNameErr;?></span>
  <br><br>
  Username:<input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  Password:<input type="password" name="passw" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <!--E-mail: <input type="text" name="email" value="<?php// echo $email;?>">
  <span class="error">* <?php //echo $emailErr;?></span>
  <br><br> -->
  Address: <textarea name="comment" rows="5" cols="40"><?php echo $address;?></textarea>
  <br><br>
  Phone no:<input type="text" name="phoneno" value="<?php echo $phoneno;?>">
  <span class="error">* <?php echo $numErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <input type="reset" value="clear"/><br></br>
  <input type="hidden" name="submitted" value="TRUE" />
  <a href="loginpage.html">Already a Registered User? Login here</a>
</form>
&copy; 2010-<?php echo date("Y"); ?> 
</body>
</html>