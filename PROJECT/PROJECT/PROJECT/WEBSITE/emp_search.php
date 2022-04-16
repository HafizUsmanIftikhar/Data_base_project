
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
 

      <div class="AGAIN" style="margin-left:1%;">
      <form method="GET">
      <LAbel for="search" >SEARCH BY</LAbel>
      <select  name="search" id="search">
      <option  value="account">ACCOUNT NUMBER</option>
      <option  value="card">CARD NUMBER</option>
      </select>
      <input type="NUMBER" name="NUMBER" required>
      <input style="padding-top:0%;padding-bottom:0%;margin-left:0%;width:10%; background-color:white;color:black;"  type="SUBMIT" value="SEARCH" >
      </form>
      <?php
      if(isset($_GET['search']))
      {
        $number=$_GET['NUMBER'];
        $stype=$_GET['search'];
        $servername = "localhost"; 
         $dbusername = "root";
        $dbpassword = "";
   try {
  $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($stype=='account')
        {
             $QUERY3="select customer_id from account where account_no=$number;";
        }
        if($stype=='card')
        {
             $QUERY3="select customer_id from card where CARD_NUMBER=$number;";
        }
        
             $stmt=$conn->prepare($QUERY3);
             $stmt->execute();
             $data=$stmt->fetch(PDO::FETCH_ASSOC);
             if(!empty($data))
             {
               
             $data=$data['customer_id'];
             $QUERY4="select * from customers where customer_id=$data";
             $stmt=$conn->prepare($QUERY4);
             $stmt->execute();
             $cdata=$stmt->fetch(PDO::FETCH_ASSOC);
  
     echo 'NAME :',$cdata['CUST_FNAME'],' ',$cdata['CUST_LNAME'];
        echo '<br>';
        echo 'EMAIL :',$cdata['CUST_EMAIL'];
        echo '<p CLASS="AL"> COUNTRY: ',$cdata['CUST_COUNTRY'],'</p>';
        echo '<br>';
        echo '<p CLASS="AL"> CITY: ',$cdata['CUST_CITY'],'</p>';
        echo 'BANK CODE :',$cdata['BANK_CODE'];
        echo'  </div>';
            echo '<br>';
     
   } 
   else {
     echo 'INCORRECT NUMBER';
   }
    }
  
      catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
      }
      ?>
      </div>
    </div>
  </div>
</body>

</html>
