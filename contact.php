<?php
$name = $_POST['name'];
$emailid = $_POST['emailid'];
$message = $_POST['message'];

if (!empty($name) || !empty($emailid) || !empty($message)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "fernwehtechnologies";

    // Create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() .')'. mysqli_connect_error());
    } else {
        $INSERT = "INSERT INTO contactus (name, emailid, message) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $emailid);
        $stmt->execute();
        $stmt->bind_result($emailid);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $name, $emailid, $message);
            $stmt->execute();

            echo "New record inserted successfully";
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required!";
    die();
}
?>
