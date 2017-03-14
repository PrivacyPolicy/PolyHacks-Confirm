<html>
<head>
    <title>Confirmed for Polyhacks</title>
</head>
<body>
    <table>
        <thead>
            <tr><th colspan=2>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'polyhacks';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Failed to connect to the database.");
}

$res = mysqli_query($conn, 'SELECT * FROM confirmed;');
//echo $res . '**';
while ($row = mysqli_fetch_assoc($res)) {
    addTableRow($row['fname'], $row['lname'], $row['email']);
}

function addTableRow($f, $l, $e) {
    echo "<tr><td>$f</td><td>$l</td><td>$e</td></tr>";
}

?>
        </tbody>
    </table>
</body>
</html>