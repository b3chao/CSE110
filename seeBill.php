<?php
$username1 = $_POST['username'];
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'UserInfo';

//create connection
$conn =  @mysqli_connect($servername, $username, $password, $dbname) or die('Cannot connect to server');
$total = 0;
$sql = "SELECT * FROM Info";
$sql2 = "SELECT name,price FROM ServiceList";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$price = 0;
if ($result->num_rows>0) {
        //ouput data of each row
        while ($row = $result->fetch_assoc()) {
          $rowname = $row["username"];
          $fines = $row["fines"];
          while($row2 = $result2->fetch_assoc()) {
            $name = $row2["name"];
                if ($row[$row2["name"]] != 0) {
                        $price = $row2["price"];
                        $row[$name] = $price;
                        $total = $total + $price;
                }
          }
          $total = $total + $fines;
          $balance = "UPDATE Info SET balance=$total WHERE username='$rowname'";
          $conn->query($balance);
          $total = 0;
        $result2 = $conn->query($sql2);
        }

  }

$total = 0;
$sql = "SELECT * FROM Info";
$sql2 = "SELECT name,price FROM ServiceList";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
echo "<p style=\"text-decoration:underline;\">Bill</p>";
$price = 0;
if ($result->num_rows>0) {
	//ouput data of each row
	while ($row = $result->fetch_assoc()) {
	if ($username1 ==$row["username"]){
	echo "FINES : ";
	$fines = $row["fines"];
	echo $fines;
	echo "<br>";  
	while($row2 = $result2->fetch_assoc()) {	
		$name = $row2["name"];
		if ($row[$row2["name"]] != 0) {
			$price = $row2["price"];	
                        $row[$name] = $price;
			$total = $total + $price;
                }
	echo $name;
	echo ": ";
	echo $price;
	$price = 0;
	echo "<br> ";
	  }
	}
	$result2 = $conn->query($sql2);
		
	}
	$total = $total + $fines;
	echo "TOTAL: ";
	echo $total;
} 
?>
