<html>
<head>
    <title>Confirmation</title>
    <link rel=stylesheet href=styles.css>
    <link rel=stylesheet href=../styles.css>
    <style>
         body {
             color: white;
             text-align: center;
         }
    </style>
</head>
<body>
    <br><br>
    
<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'polyhacks';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Failed to connect to the database.");
}

$fname = '';
if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $fname = $conn->escape_string($fname);
}
$lname = '';
if (isset($_POST['lname'])) {
    $lname = $_POST['lname'];
    $lname = $conn->escape_string($lname);
}
$email = '';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $email = $conn->escape_string($email);
}

if ($fname == '' || $lname == '' || $email == '') {
    echo 'Failed to confirm; please manually email '
        . '&lt;POLYHACKS EMAIL HERE&gt; to confirm you still '
        . 'want to go.';
}

$sql = "SELECT * FROM confirmed WHERE email='$email';";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    echo "You have been succesfully registered, $fname $lname!";
} else {

    $sql = 'INSERT INTO confirmed (fname, lname, email) VALUES ("'
        . $fname . '", "' . $lname . '", "' . $email . '");';

    if (!($res = mysqli_query($conn, $sql))) {
        echo 'Failed to confirm; please manually email '
            . '&lt;POLYHACKS EMAIL HERE&gt; to confirm you still '
            . 'want to go.';
    } else {
        echo "You have been succesfully registered, $fname $lname!";
    }
}

?>
    <br><br><br>
    Go to <a href="https://www.polyhacks.com/">PolyHacks.com</a>
    </body>
</html>