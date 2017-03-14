<html>
<head>
    <title>Attendance Confirmation</title>
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


<?php

$pass = 'ThisIsGospel';
$algo = 'AES-128-CBC';

if (!isset($_GET['id'])) {
    die('You should not be seeing this.');
}
$id = str_replace(' ', '+', $_GET['id']);
//echo '"' . $id . "\"\n";
$data = openssl_decrypt($id, $algo, $pass);
//echo '"' . $data . "\"\n";
$data = explode(' ', $data);
?>

    <br><br>
I, <?php echo $data[0] . ' ' . $data[1]; ?>, hereby still plan to attend PolyHacks during March 25th-26th.
<br><br>
<form method=post action=accept.php>
    <input type=hidden name=fname value="<?php echo $data[0]; ?>">
    <input type=hidden name=lname value="<?php echo $data[1]; ?>">
    <input type=hidden name=email value="<?php echo $data[2]; ?>">
    <input type=submit value="I do">
</form>

<!--
<?php
echo @openssl_encrypt('Gabriel Hutchison ghutchison2600@flpoly.org', $algo, $pass) . "\n";
echo @openssl_encrypt('Frank Calas frankcalas0193@flpoly.org', $algo, $pass) . "\n";
echo @openssl_encrypt('Zachary Weingarten zacharyweingarten06@flpoly.org', $algo, $pass) . "\n";
?>
-->
        
        
</body>
</html>