<?php
	session_start();
	
	//check if the person is logged in, otherwise redirect to start
	if (! isset($_SESSION['username'])){
		header("Location: userwelcomepage.php");
	}
?>

<html>
<body>
<h1>Hello <?php echo $_SESSION['username']; ?> </h1>

<a href = "logout.php"> Logout </a>

</body>
</html>