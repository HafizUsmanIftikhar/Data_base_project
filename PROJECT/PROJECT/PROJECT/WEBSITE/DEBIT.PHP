<?PHP
session_start();
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
        <a href="home.html" ><button class="LOG">LOGOUT</button><a>
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
        <div class="sty">
           
            <form class="fo" method="post" > 
            <labeL>  NAME</label>
            <input  name="NAME" ID="NAME" required="required">
            <br>
            <labeL>  AMOUNT</label>
            <input  name="AMOUNT" required="required">
            <br>
            <labeL>  ACCOUNT NO</label>
            <input  name="ACCOUNT" required="required">
            <input font-size:40px;width: 130px;" type="submit" name="submit">
            </form>
        </div>
        </div>
    </div>
</body>

</html>
<?PHP
if(isset($_POST['submit']))
{
    
    
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
    if($ACCOUNT_NO!=$_SESSION['acc'])

    {
        $CACC=$_SESSION['acc'];
    $QUERY="insert INTO deposit values(CURRENT_DATE(),$ACCOUNT_NO,$CARD,$AMOUNT,'$NAME');";
    $conn->exec($QUERY);
    $QUERY1="select ACCOUNT_BALANCE from account where account_no=$ACCOUNT_NO";

  $stmt= $conn->prepare($QUERY1);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $u_Am=$data['ACCOUNT_BALANCE'];
    $u_Am=$u_Am+$AMOUNT;
    $QUERY2="UPDATE ACCOUNT SET ACCOUNT_bALANCE=$u_Am WHERE ACCOUNT_NO=$ACCOUNT_NO;";
    $conn->exec($QUERY2);
    $QUERY1="select ACCOUNT_BALANCE from account where account_no=$CACC";

    $stmt= $conn->prepare($QUERY1);
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      $u_Am=$data['ACCOUNT_BALANCE'];
    $u_Am=$u_Am-$AMOUNT;
    $QUERY2="UPDATE ACCOUNT SET ACCOUNT_bALANCE=$u_Am WHERE ACCOUNT_NO=$;";
    $conn->exec($QUERY2);
    
    echo '<script>alert("TRANSACTION SUCEEFULLY DONE");</script>';
} 
else
{
    echo '<script>alert("TRANSACTION UNSUCEEFULL");</script>';
    

}

} catch (PDOException $e) {
    echo "WRONG ACCOUNT_NO";

}
}
?>
