<?php 
if (isset($_POST['login'])) {

$userName =$_POST['userName'];
$passwordConf=$_POST['password'];


include('db.php');
$sql = "SELECT * FROM users where userName=? OR passwordConfirmation=?;" ;

$statement=mysqli_stmt_init($con);

if (!mysqli_stmt_prepare($statement,$sql)) {
  echo "eroor";
 
}
else{
   
   mysqli_stmt_bind_param($statement,"ss",$userName ,$passwordConf);
    mysqli_stmt_execute($statement);
    $result=mysqli_stmt_get_result($statement);

    if ($row=mysqli_fetch_assoc($result)) 

      $passwordConf=$_POST['password'];
      //$passwordConf=true;
   
    if ($row['passwordConfirmation']!==$passwordConf) {
    echo "<script type='text/javascript'>alert('wrong password')</script>";
    header('Location: login.php');
     echo "wrong password";
  
}
elseif ( $row['passwordConfirmation']==$passwordConf && $row['userName']==$userName) {
  echo "<script type='text/javascript'>alert('you are logged in');</script>";
  header('Location: product.php');
  echo "you are logged in";
   exit();
}
elseif ( $row['userName']!==$userName) {
  echo "<script type='text/javascript'>alert('you are logged in');</script>";
  echo "you are ";
   exit();
}
else{
 echo "error";
  exit();
}
}
}

 ?>