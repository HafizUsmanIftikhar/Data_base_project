<?php
session_start();
$NAME=$_POST['NAME'];
$AMOUNT=$_POST["AMOUNT"];
$ACCOUNT_NO=$_POST['ACCOUNT'];
$CARD=$_SESSION['CARD'];
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $QUERY="insert INTO deposit values(CURRENT_DATE(),$ACCOUNT_NO,$CARD,$AMOUNT,'$NAME');";
    $conn->exec($QUERY);


} catch (PDOException $e) {
    echo "WRONG ACCOUNT_NO";
}

?>