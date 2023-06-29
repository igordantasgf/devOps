<?php
// Database connection details
$servername = "db";
$username = "root";
$password = "Senha123";
$dbname = "testedb";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the submitted data
if (isset($_POST['inputString'])) {
    $inputString = $_POST['inputString'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tabela_php_mysql (strings) VALUES ('$inputString')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve all the strings from the database
$sql = "SELECT strings FROM tabela_php_mysql";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Submitted Data</title>
</head>
<body>
  <h2>Submitted Data</h2>
  <form action="submit.php" method="post">
    <input type="text" name="inputString" placeholder="Enter a string" required>
    <button type="submit">Submit</button>
  </form>
  <h3>List of Strings:</h3>
  <ul>
    <?php
    // Display the retrieved strings
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["strings"] . "</li>";
        }
    } else {
        echo "<li>No strings found.</li>";
    }
    ?>
  </ul>
</body>
</html>
