<?PHP
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$card=$_SESSION['CARD'];
function session_out(){
    session_destroy();
header("LOCATION:https://www.youtube.com/watch?v=1-xGerv5FOk&list=RDb5BNUa_op2o&index=11&ab_channel=AlbertVishiAlbertVishiVerified");
  }

try {
  $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 $stmt=$conn->prepare("SELECT * from deposit  where card_no=$card order by date desc limit 3");
 $stmt->execute();
  
 


} catch (PDOException $e) {
    echo "Connectin failed: " . $e->getMessage();
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
        <a  href="HOME.html"><button  class="LOG">LOGOUT</button><a>
    </div>
      <br><br><br><br><br>
    <div >
        <div style="display: flex;">
        <div class="leftpanel">
            <a href="dasboard.php"><button class="daleft">HOME</button></a>
            <a href="DEBIT.PHP"><button class="daleft">DEBIT</button></a>
            <a href="TRANSACTION.PHP"><button class="daleft">TRANSACTION</button></a>
            <a href="ACCOUNT.PHP"> <button class="daleft">ACCOUNT</button></a>
           <a href="card.php"> <button class="daleft">CARD INFO</button></a>
           <a href="about.php"><button class="daleft">ABOUT US</button></a>
        </div>
    <div class="sty" >
         <h1 style="color:black; font-size: 40px; text-align: center; font-family:SERIF;"> DEPOSIT CARD DETAILS </h1>
         <?php
         echo "<table style='font-size:40px;padding-left:8%;column-gap:4%;'>";
         echo "<tr>";
         echo  '<th>ACCOUNT</th>','<th>AMOUNT</th>','<th>CUSTOMER NAME</th>','<th>DATE</th>';
         echo '</tr>';
        while($REC=$stmt->fetch(PDO::FETCH_ASSOC)) 
        {
            echo '<tr>';
            echo "<td>$REC[ACCOUNT_NO]</td>";
            echo "<td>$REC[AMOUNT]</td>";
            echo "<td>$REC[CUSTOMER_NAME]</td>";
            echo "<td>$REC[DATE]</td>";
            echo "</tr>";
        }   
        echo "</table>"; 
         
         ?>
   
    </div>
    </div>
 

    </div>