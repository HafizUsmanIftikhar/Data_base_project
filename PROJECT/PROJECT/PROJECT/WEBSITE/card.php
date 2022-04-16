<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$ID = $_SESSION['USER_ID'];
function session_out(){
    session_destroy();
  
  }

try {
    $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $ID = $_SESSION['USER_ID'];
    $QUERY = "SELECT * FROM CARD WHERE CUSTOMER_ID=$ID";
    $STMT = $conn->prepare($QUERY);
    $STMT->execute();
    $data = $STMT->fetch(PDO::FETCH_ASSOC);
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
    <div>

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
            <p style="font-size: 30px;font-weight:bold; text-align:center;padding-top:4%;" > CARD NO : <?PHP echo $data['CARD_NUMBER']?> </P>
            <P style="font-size: 30px;font-weight:bold; text-align:center;padding-top:4%;"> ISSUE DATE : <?PHP echo  $data['START_date']?></P>
            <P style="font-size: 30px;font-weight:bold; text-align:center;padding-top:4%;"> EXPIRE DATE : <?PHP echo  $data['END_DATE']?></P>
        </div>
        </div>
</body>
</html>