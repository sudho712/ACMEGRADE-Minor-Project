<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ecom";
$port = 3306;

// Create connection
$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Secure query using prepared statements to avoid SQL injection
$query = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
$stmt->execute();
$sql_result = $stmt->get_result();

if ($sql_result->num_rows > 0) {
    echo "Login Success";
    $dbrow = $sql_result->fetch_assoc();

    // Redirect based on user type
    if ($dbrow["usertype"] == "seller") {
        header("Location: /ecom/ACMEGRADE-Minor-Project/Seller/home.html");
    } elseif ($dbrow["usertype"] == "buyer") {
        header("Location: /ecom/ACMEGRADE-Minor-Project/Buyer/home.html");
    }
    exit(); // Ensure script stops after header redirection
} else {
    echo "Invalid username/password";
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();
?>
