<!DOCTYPE html>
<html>
<body>

<?php
echo "<table style='border: solid 2px black;'>";
  echo "<tr><th>Item ID</th><th>Name</th><th>Category</th><th>Time Found</th><th>Place Found</th><th>Colour</th><th>Photo</th><th>Description</th></tr>";

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
     $stmt = $conn->prepare("SELECT item_id, item_name, item_category, found_time, found_user, found_place, item_colour, item_photo, item_description FROM item"); 
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