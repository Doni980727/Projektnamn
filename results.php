<!doctype html>
<html lang="sv">

<head>
    
    <meta charset="utf-8">
    <title>Projektnamn</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/results.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Montserrat" rel="stylesheet">
    <script src="js/action_page.js"></script>
    
</head>
    
<body>
    
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
    
        //Updaterar databasen varje gång man trycker på vote, och plussar på en etta i votes.
        if(isset($_GET["vote"])) {

        $filterId = filter_var($_GET["vote"], FILTER_VALIDATE_INT);

        $stmt = $conn->prepare("UPDATE namnin SET votes = votes + 1 WHERE id = (?)");
        $stmt->bind_param("i", $filterId);
        $stmt->execute();

        }

        $sql = "SELECT * FROM namnin";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        echo "<table>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td class='font'>" . mysqli_real_escape_string($conn, $row["namn"]) . "</td>
            <td class='font'>" . $row["votes"] . "</td>
            <td class='font'>
            <a href='results.php?vote=" . $row["id"] . "'>
            <button type='submit' class='btn btn-default' name='submit'>Vote</button>
            </a>
            </form>
            </td>
            </tr>";
        }
        echo "</table>";
        }
        else {
            
        echo "0 results";
        }
        
        
        
        $conn->close();
    ?>
    
</body>
    
</html>
