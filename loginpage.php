<?php
   session_start();
   
	$servername = "bosunard.eas-cs2410-1617.aston.ac.uk";
	$dbname = "bosunard_db";
    $dbusername = "bosunard";
    $dbpassword = "inti99olds";
	
	if(isset($_POST['submitted'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
	try{
    $db =new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $db-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	/** $stmt = $conn->prepare("SELECT username, password FROM user"); 
    $stmt->execute(); */
	
	//Sanitising
	$safe_username = $db->quote($username);
	
	
	$query = "SELECT * FROM user WHERE username = $safe_username";
	
	$result = $db->query($query);
	
	$firstrow = $result->fetch(); 
	
		if (!empty($firstrow)) {
			
			$hashed_password = md5($password);
			
			if ($firstrow['password'] == $hashed_password){
				$_SESSION['id'] = $firstrow['id'];
				$_SESSION['name'] = $firstrow['username'];
				
				//echo "Success!";
				header("Location: userwelcomepage.php");
				exit();
			} else {
				echo "<h1>Error logging in, password does not match</h1>";
			}
		} else {
			//else display an  error
			echo "<h1>Error logging in, Username not found </h1>";
		}
	}
	catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
	}
$conn = null;
	 ?>
<html>
<head>
<title>FiLo: Find The Lost</title>
</head>
<body style="background-color:#F5F3EE">
<!--<img src="H:\CS2410\Coursework\images\logo.jpg" alt="FiLo" width="104" height="142"> -->
<h1>Welcome to<a href="loginpage.php"> FiLo</a>: Recover....</h1>
<!-- Description -->
<p><strong>Everyday, hundreds and thousands of valuable items are lost from home, trains, and airports etc.<br><br>
Many of those lost items are never returned to their owners because it is just very difficult to link a lost
item to the owner. <br><br>FiLo has been created to provide a database that'll help users find lost items or upload lost items. </strong></p>
<form method = "post" action="loginpage.php">
    <div>
	Username: <input type="text" name="username" ><br /> 
	</div>
	 <div>
	Password: <input type="password" name="password" /><br /><br>
    </div>
	
	<div>
	Please Choose: <br>
		<input type="radio" value="registered_user" name="user_type" checked />Registered User <br> 
		<input type="radio" value="administrator" name="user_type" />Administrator <br /><br />
	</div>
	
	<input type="submit" name="submit" value="Submit" />
	<input type="reset" value="clear"/><br>
	<input type="hidden" name="submitted" value="TRUE" />
	<a href ="userdata.php"> Register?</a><br /><br />
	<a href ="itemdatabase.php"> Just Visiting? Click here to view items right away!</a> 
</form>


<style>
a:link    {color:green; background-color:transparent; text-decoration:none}
a:visited {color:blue; background-color:transparent; text-decoration:none}
a:hover   {color:red; background-color:transparent; text-decoration:underline}
a:active  {color:yellow; background-color:transparent; text-decoration:underline}
</style>




</body>
</html>