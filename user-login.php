<?php
    $email = $_POST["email"];
    $password = $_POST["password"];

    echo "Email: ".$email;
    echo "<br>Password: ".$password;

    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "travels";

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT UID, UserName, Pass FROM traveluser WHERE UserName = '$email' AND Pass = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Email: " . $row["UserName"]. " - Password: " . $row["Pass"];
            setcookie('user_id', $row["UID"], time() + (86400 * 30), "/");
        }
        header("Location: index.php");
    } else {
    echo "0 results";
    }
    $conn->close();
?>