
<?php
$user=$_POST['CARD_NUMBER'];
$pass=$_POST['PASSWORD'];
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query="SELECT * FROM CUSTOMERS_LOGIN WHERE CARD_NUMBER=$user AND PASSWORD='$pass' ";
  

  $stmt=$conn->prepare($query);
  $stmt->execute();
  $data=$stmt->fetch(PDO::FETCH_ASSOC);
  
  $query1="SELECT CUSTOMER_ID FROM CUSTOMERS_LOGIN WHERE CARD_NUMBER=$user AND PASSWORD=$pass ";
  

  $stmt=$conn->prepare($query1);
  $stmt->execute();
  $ID=$stmt->fetch(PDO::FETCH_ASSOC);
  if(!empty($data))
  {
  $ID=$ID['CUSTOMER_ID'];
 
  $duser=$data['CARD_NUMBER'];
  $dpass=$data['PASSWORD'];
  if($user==$duser && $pass==$dpass)
  {
    session_start();
    $_SESSION['USER_ID']=$ID;
    $_SESSION['CARD']=$user;
      header("Location:dasboard.PHP");
  }
  else
  {
    echo 'something wrong';
  }
}
 else
{
  echo '<script>alert("WRONG EMAIL OR PASSWORD");</script>';
  echo'<script>window.location.replace("HOME.html");</script>';
}
}catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }


  ?>

