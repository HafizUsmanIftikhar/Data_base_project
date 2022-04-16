<?php
$firstname=$_POST['first_name'];
$lastname=$_POST['last_name'];
$country=$_POST['COUNTRY'];
$CITY=$_POST['CITY'];
$STREET=$_POST['STREET'];
$BRANH=$_POST['BRANCH'];
$PASSWORD=$_POST['PASSWORD'];
$GENDER=$_POST['gender'];
$EMAIL=$_POST['email'];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->beginTransaction();
  $query="INSERT INTO CUSTOMERS VALUES(NULL,'$firstname','$lastname','$CITY','$country','$STREET','$GENDER','$EMAIL',4200,'$BRANH')";
  $conn->exec($query);
  $last_id = $conn->lastInsertId();
  $query1="INSERT INTO ACCOUNT VALUES($last_id,NULL,0)";
  $conn->exec($query1);
  $query2="SELECT CARD_NUMBER FROM CARD ORDER BY CARD_NUMBER desc LIMIT 1";
  $stmt=$conn->prepare($query2);
  $stmt->execute();
  $CARD_NUM=$stmt->fetch(PDO::FETCH_ASSOC);
  $id=$CARD_NUM['CARD_NUMBER'];
  
  
$conn->exec("INSERT INTO CUSTOMERS_LOGIN VALUES('$id','$PASSWORD','$last_id')");
  $conn->commit(); 
   
   echo "<script>alert('SUBMITED  SUCEEFULLY YOUR CARD NUMBER IS '+ $id + '  Its required at login time');";
   echo " location.replace('home.html');";
   echo '  </script>';
   
 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

