<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";


try {
  $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $ID = $_SESSION['EMP_ID'];

  $QUERY = "SELECT * FROM EMPLOYEES WHERE EMP_ID=$ID";
  $stmt = $conn->prepare($QUERY);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['EMP_FNAME'] = $data['EMP_FNAME'];
  $LNAME = $data['EMP_LNAME'];
  $CITY = $data['EMP_CITY'];
  $COUNTRY = $data['EMP_COUNTRY'];
  $BANK = $data['BANK_CODE'];
  $BRANCH = $data['BRANCH_NAME'];
  $SALARY=$data['EMP_SALARY'];
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
    <p class="para">WELCOME,<?php echo  $data['EMP_FNAME']; ?>!!!</p>
    <a href="emp.html"><button onclick="session_out()" class="LOG">LOGOUT</button><a>
  </div>
   <br><br><br><br><br>
  <div style="display: flex;" >
    <div class="leftpanel">
      <a href="EMP_dashboard.php"><button class="daleft">HOME</button></a>
      <a href="emp_search.php"> <button class="daleft">SEARCH ACCOUNT</button></a>
      <a href="update.php"><button class="daleft">ACCOUNT UPDATION</button></a>
      <a href="emp_depost.php"><button class="daleft">DEBIT </button></a>
    </div>


    <div style="margin-left:1.4%;margin-top:-1.7%;" class="inform">
      <p style="font-size: 40px; font-position:center;text-align: center; font-family:SERIF;"> WELCOME,<?php echo  $data['EMP_FNAME'], ' ', $LNAME; ?> !</p>

      <div class="AGAIN" style="margin-left:2%;">
      <p>SALARY :<?php echo $SALARY; ?></P>
      <br>
       
    <p style=" margin-top:-6%;" class="AL">COUNTRY: <?php echo $COUNTRY; ?></p>
    
        <p>BANK CODE :<?PHP echo $BANK; ?></P>

        <p class="AL">CITY: <?php echo $CITY; ?></p>
        <p>BRANCH :<?PHP echo $BRANCH; ?></P>
        <p class="AL">STREET :<?PHP echo $data['STREET_NO']; ?></P>
      </div>
    </div>
  </div>
</body>

</html>