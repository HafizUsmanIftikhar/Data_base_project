<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$ID = $_SESSION['USER_ID'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>WELCOME</title>

</head>

<body style="background-color:#263230;">
    <div style="background-color:#263238;">
        <div class="logo">
            <img style="position: absolute;" src="images/logo.png">
            <h1> THE BANKING SYSTEM</h1>
        </div>
        <p class="para">WELCOME,<?php echo   $_SESSION['CUST_FNAME']; ?>!!!</p>
        <a href="home.html" ><button onclick="session_out()" class="LOG">LOGOUT</button><a>
    </div>
    <br><br><br><br><br>
    <div style="display: flex;">
        <div class="leftpanel">
            <a href="dasboard.php"><button class="daleft">HOME</button></a>
            <a href="DEBIT.PHP"><button class="daleft">DEBIT</button></a>
            <a href="TRANSACTION.PHP"><button class="daleft">TRANSACTION</button></a>
            <a href="ACCOUNT.PHP"> <button class="daleft">ACCOUNT</button></a>
           <a href="card.php"> <button class="daleft">CARD INFO</button></a>
            <a href="about.php"><button class="daleft">ABOUT US</button></a>
        </div>
        <div class="sty"  > 
            <p style="font-size: 30px;font-weight:bold; text-align:center;padding-top:2%;" > DATA BASE PROJECT </P>
            <P style="font-size: 37px;font-weight:bold; text-align:center;"> THE BANKING SYSTEM</P>
            <P style="font-size: 20px;font-weight:bold; padding-top:1%;padding-left: 1%;"> MEMBERS :</P>
            <P style="font-size: 20px;font-weight:bold;padding-left: 2%; "> MUHAMMAD UMAR ASLAM</P>
            <P style="font-size: 20px;font-weight:bold;padding-left: 2%; "> ABUZAR ZULFIQAR</P>
            <P style="font-size: 20px;font-weight:bold;padding-left: 2%; "> MUHAMMAD USMAN</P>
        </div>
    </div>
</body>
</html>