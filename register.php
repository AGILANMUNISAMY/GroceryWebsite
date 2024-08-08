<?php 
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signUp'])) {
        $firstName = isset($_POST['fName']) ? $_POST['fName'] : '';
        $lastName = isset($_POST['lName']) ? $_POST['lName'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
            $password = md5($password);

            $checkEmail = "SELECT * FROM users WHERE email='$email'";
            $result = $conn->query($checkEmail);

            if ($result->num_rows > 0) {
                echo "Email Address Already Exists!";
            } else {
                $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
                
                if ($conn->query($insertQuery) === TRUE) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            echo "All fields are required!";
        }
    }

    if (isset($_POST['signIn'])) {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (!empty($email) && !empty($password)) {
            $password = md5($password);
            
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION['email'] = $row['email'];
                header("Location: homepage/index.html");
                exit();
            } else {
                echo "Not Found, Incorrect Email or Password";
            }
        } else {
            echo "Both email and password are required!";
        }
    }
}
?>
