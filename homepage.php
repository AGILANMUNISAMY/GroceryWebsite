<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center; padding:15%;">
        <p style="font-size:50px; font-weight:bold;">
            Hello  
            <?php 
            if(isset($_SESSION['email'])){
                $email = $_SESSION['email'];

                // Debugging: Display the email from session
                echo "Email from session: " . htmlspecialchars($email) . "<br>";

                $query = mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");

                // Debugging: Check if the query executed successfully
                if (!$query) {
                    die("Query failed: " . mysqli_error($conn));
                }

                
                $num_rows = mysqli_num_rows($query);
                echo "Number of rows returned: " . $num_rows . "<br>";

                if ($num_rows > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                        // Debugging: Check if firstName and lastName keys exist
                        if (isset($row['firstName']) && isset($row['lastName'])) {
                            echo htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']);
                        } else {
                            echo "firstName or lastName key does not exist.";
                        }
                    }
                } else {
                    echo "User not found.";
                }
            } else {
                echo "No email in session.";
            }
            ?>
        </p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
