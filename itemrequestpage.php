<!DOCTYPE html>
<html>
<body>

<?php
echo "<table style='border: solid 2px black;'>";
  echo "<tr><th>Request ID</th><th>Item Name</th><th>Category</th><th>Username</th><th>Address</th><th>Phone no</th><th>Reason</th><th>Approve?</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
     function __construct($it) { 
         parent::__construct($it, self::LEAVES_ONLY); 
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() { 
         echo "<tr>"; 
     } 

     function endChildren() { 
         echo "</tr>" . "\n";
     } 
} 

$servername = "bosunard.eas-cs2410-1617.aston.ac.uk";
$username = "bosunard";
$password = "inti99olds";
$dbname = "bosunard_db";

try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare("SELECT requestId, Item_Name, Item_Category, Username, Address, Phoneno, Reason, isApproved FROM requests"); 
     $stmt->execute();

     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
         echo $v;
     }
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>  

</body>
</html>