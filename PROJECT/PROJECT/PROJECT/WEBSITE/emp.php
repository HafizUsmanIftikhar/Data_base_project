<?php
$user=$_POST['email'];
$pass=$_POST['PASSWORD'];
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";



try {
    $conn = new PDO("mysql:host=$servername;dbname=the_banking_system", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT * FROM EMPLOYEE_LOGIN WHERE EMP_EMAIL='$user'  AND PASSWORD='$pass' ";

    
  
    $stmt=$conn->prepare($query);
 
    $stmt->execute();
    $data=$stmt->fetch(PDO::FETCH_ASSOC);

    
    $query1="SELECT EMP_ID FROM EMPLOYEE_LOGIN WHERE EMP_EMAIL='$user' AND PASSWORD='$pass' ";
    
  
    $stmt=$conn->prepare($query1);
    $stmt->execute();
    $ID=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($data))
    {
    $ID=$ID['EMP_ID'];
    
    $duser=$data['EMP_EMAIL'];
 
    $dpass=$data['PASSWORD'];
    if($user==$duser && $pass==$dpass)
    {
      session_start();
      $_SESSION['EMP_ID']=$ID;
      $_SESSION['EMP_EMAIL']=$user;
        header("Location:EMP_dashboard.PHP");
    }
    else
    {
      echo 'something wrong';
    }
  }
   else
  {
    echo '<script>alert("WRONG EMAIL OR PASSWORD");</script>';
echo'<script>window.location.replace("emp.html");</script>';
  }
  
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
    
?>
