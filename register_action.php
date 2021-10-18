<?php 

if (isset($_POST['submit'])) {

$userName =$_POST['userName'];
$email=$_POST['email'];
$password=$_POST['password'];
$cPassword=$_POST['passwordConfirmation'];


	

   if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) 
    {
	
      echo '<script>alert("Invalid name")</script>';

       exit();
    }

      else if ($password!== $cPassword)

     {

      echo '<script>alert("Password does not match")</script>';
   
    
      

        exit();
     }
     include('db.php');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mydatabase";


// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// // sql to create table
// /*$sql = "CREATE TABLE  tbl_User  (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// userName VARCHAR(30) NOT NULL,
// email VARCHAR(30) NOT NULL,
// passwordConf VARCHAR(50)NOT NULL
// )";
 
// if ($conn->query($sql) === TRUE) {
//   echo "Table  tbl_User  created successfully";
// } else {
//   echo "Error creating table: " . $conn->error;



// }
// 
$sql = "SELECT * FROM  users where userName=? AND passwordConfirmation =?;" ;

$statement=mysqli_stmt_init($con);

if (!mysqli_stmt_prepare($statement,$sql)) {
  echo '<script>alert("Error - something went wrong")</script>';
  exit();
  }
else{
   
   mysqli_stmt_bind_param($statement,"ss",$userName ,$cPassword);
    mysqli_stmt_execute($statement);
  
     mysqli_stmt_store_result($statement);

      $result=mysqli_stmt_num_rows($statement);

      if ($result>0) {
        echo '<script>alert("Username Taken")</script>';
    

   }
     else{

$sql = "INSERT INTO  users  (userName, email,password,passwordConfirmation)VALUES (?,?,?,?)";

$statement=mysqli_stmt_init($con);



if (!mysqli_stmt_prepare($statement,$sql)) {
	echo '<script>alert("Error - something went wrong")</script>';
 
}
else
	mysqli_stmt_bind_param($statement,"ssss",$userName ,$email,$cPassword,$password);
    mysqli_stmt_execute($statement);


echo '<script>alert("Succesfully Registered")</script>';
 exit();

 
 

}
}

}

 ?>