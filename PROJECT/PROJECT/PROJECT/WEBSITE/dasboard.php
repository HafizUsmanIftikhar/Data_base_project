<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $ID = $_SESSION['USER_ID'];

  $QUERY = "SELECT * FROM CUSTOMERS WHERE CUSTOMER_ID=$ID";
  $stmt = $conn->prepare($QUERY);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['CUST_FNAME'] = $data['CUST_FNAME'];
  $LNAME = $data['CUST_LNAME'];
  $EMAIL = $data['CUST_EMAIL'];
  $CITY = $data['CUST_CITY'];
  $COUNTRY = $data['CUST_COUNTRY'];
  $BANK = $data['BANK_CODE'];
  $BRANCH = $data['BRANCH_NAME'];
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
    <p class="para">WELCOME,<?php echo  $data['CUST_FNAME']; ?>!!!</p>
    <a href="home.html"><button  class="LOG">LOGOUT</button><a>
  </div>
  <br><br><br><br><br>
  <div style="display: flex;" >
    <div class="leftpanel">
    
      <a href="dasboard.php"><button class="daleft">HOME</button></a>
      <a href="DEBIT.PHP"> <button class="daleft">DEBIT</button></a>
      <a href="TRANSACTION.PHP"><button class="daleft">TRANSACTION</button></a>
      <a href="ACCOUNT.PHP"> <button class="daleft">ACCOUNT</button></a>
      <a href="card.php"> <button class="daleft">CARD INFO</button></a>
      <a href="about.php"><button class="daleft">ABOUT US</button></a>
    </div>


    <div style="margin-left:1.4%;margin-top:-1.7%;" class="inform">
      <p style="font-size: 40px; font-position:center;text-align: center; font-family:SERIF;"> WELCOME,<?php echo  $data['CUST_FNAME'], ' ', $LNAME; ?> !</p>
      <p style="font-size: 30px; margin-top:-2%; font-position:center;text-align: center; font-family:SERIF;"> CARD NUMBER: <?php echo $_SESSION['CARD'] ?> </p>
      <div class="AGAIN" style="margin-left:1%;">
      <br>
        <p>EMAIL :<?php echo $EMAIL; ?></P>
        <br>
        <p class="AL">COUNTRY: <?php echo $COUNTRY; ?></p>
        <p>BANK CODE :<?PHP echo $BANK; ?></P>
        <p class="AL">CITY: <?php echo $CITY; ?></p>
        <p>BRANCH :<?PHP echo $BRANCH; ?></P>
        <p class="AL">STREET :<?PHP echo $data['STREET_NO']; ?></P>
      </div>
    </div>
  </div>
</body>

</html>