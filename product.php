<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['design_ID']) && isset($_POST['p_type']) &&
        isset($_POST['p_description']) && isset($_POST['fabrics_type']) && isset($_POST['GSM'])) {

        $design_ID = $_POST['design_ID'];
        $p_type = $_POST['p_type'];
        $p_description = $_POST['p_description'];
        $fabrics_type = $_POST['fabrics_type'];
        $GSM = $_POST['GSM'];
        
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "dbmsproject";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {

            $Select = "SELECT design_ID FROM Product WHERE design_ID = ? LIMIT 1";
            $Insert = "INSERT INTO Product(design_ID, p_type, p_description, fabrics_type, GSM) values(?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("i", $design_ID);
            $stmt->execute();
            $stmt->bind_result($resultdesign_ID);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("isssi",$design_ID, $p_type, $p_description, $fabrics_type, $GSM);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
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
