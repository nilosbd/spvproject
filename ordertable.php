<?php

require('connection.php');

$sql = "SELECT * FROM Product, Customer, c_login WHERE Product.ID=Customer.ID AND c_login.email = Customer.email";
$result = $conn->query($sql);

if($result) {
    while($data = mysqli_fetch_assoc($result)) {

    $name = $data['name'];
    $id = $data['design_ID'];
    $type = $data['p_type'];
    $gsm = $data['GSM'];
    

    echo '<strong>' .$id. '</strong><br>';
    echo '<strong>' .$name.  '</strong><br>';
    echo $type. '<br>';
    echo $gsm. '<br>';
    echo '<br><br>';

    
    }

}

?>