
<?php

$tes = $_POST["ncarta"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skipass";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "DELETE FROM ltl";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$sql = "INSERT INTO ltl values ('" . $tes . "');";
echo ($sql);
$conn->query($sql);
echo ($conn->error);

$sql = "INSERT INTO performance values ('" . $tes . "', '" . date("Y-m-d") . "', '" . date("H:i:s") . "','1');";
echo ($sql);
$conn->query($sql);
echo ($conn->error);

$conn->close();

?>