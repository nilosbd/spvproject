<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['mobile']) &&
        isset($_POST['email']) && isset($_POST['address'])) {
        
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "dbmsproject";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM Customer WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO Customer(name, mobile, email, address) values(?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("siss",$name, $mobile, $email, $address);
                if ($stmt->execute()) {
                    header("Location:product.html");
                    exit();
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>