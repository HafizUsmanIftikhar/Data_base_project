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
        <p class="para">WELCOME,<?php echo   $_SESSION['EMP_FNAME']; ?>!!!</p>
        <a href="emp.html" ><button class="LOG">LOGOUT</button><a>
    </div>
     <br><br><br><br><br>
    <div >
        <div style="display: flex;">
        <div class="leftpanel">
        <a href="EMP_dashboard.php"><button class="daleft">HOME</button></a>
      <a href="emp_search.php"> <button class="daleft">SEARCH ACCOUNT</button></a>
      <a href="update.php"><button class="daleft">ACCOUNT UPDATION</button></a>
      <a href="emp_depost.php"><button class="daleft">DEBIT </button></a>
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
            <input style="font-size:40px;width: 130px;" type="submit" name="submit">
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
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $QUERY1="select ACCOUNT_BALANCE from account where account_no=$ACCOUNT_NO";
    $stmt= $conn->prepare($QUERY1);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $u_Am=$data['ACCOUNT_BALANCE'];
    $u_Am=$AMOUNT;
    $QUERY2="UPDATE ACCOUNT SET ACCOUNT_bALANCE=$u_Am WHERE ACCOUNT_NO=$ACCOUNT_NO;";
    $conn->exec($QUERY2);
    
    
    echo '<script>alert("TRANSACTION SUCEEFULLY DONE");</script>';
} 
 catch (PDOException $e) {
    echo "WRONG ACCOUNT_NO";
}
}
?>
