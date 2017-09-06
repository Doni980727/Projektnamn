<?php 
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projektnamn";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (!($stmt = $conn->prepare("INSERT into namnin(namn) values (?)"))) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

$filtered = filter_input(INPUT_POST, "namn", FILTER_SANITIZE_SPECIAL_CHARS);
$filtered = trim($filtered);

if (!$stmt->bind_param("s", $filtered)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

/*$sql = "INSERT INTO namnin (namn) VALUES ('$_POST[namn]')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close(); */
?>