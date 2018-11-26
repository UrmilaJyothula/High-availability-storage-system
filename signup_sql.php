<?php
 session_start();
 if(!isset($_SESSION["signup_confirm"]))
 {
  $_SESSION["signup"] = True;
  header("Location:signup.php");	 
 }
 
 if(isset($_SESSION["signup_confirm"]))
 {
  $fname = $_SESSION["fname"];
  $lname = $_SESSION["lname"];
  $eid = $_SESSION["eid"];
  $pwd = $_SESSION["pwd"];
  $cfmpwd = $_SESSION["cfmpwd"];
   
  
  if($pwd !== $cfmpwd)
  {
   $pwderror="Password are not matched, please re-enter your password";
  }
  else
  {
   $servername="193.11.184.249";
   $username="root";
   $password="123456"; 
    
   $conn=mysqli_connect($servername,$username,$password);
   if(!$conn)
   {
    #die("Could not connect to server:".mysqli_connect_error());
   }
   else
   {
    #echo "<br>"."Connection Succesfull"."<br>";
   }
   
 ###################################################### CREATING DATABASE IF NOT EXISTS ########################################################
   
   $sql="CREATE DATABASE IF NOT EXISTS SDrive";
   if(mysqli_query($conn,$sql))
   {
    #echo "<br>"."Created database Secure Drive successfully"."<br>";
   }
   else
   {
    #echo "<br>"."Coudn't create database User_Info:".mysql_error($conn)."<br>";
   }
    
   mysqli_close($conn);
##################################################### CONNECTING TO DATABASE SDrive #####################################################
   $dbname="SDrive";
   $conn_db=mysqli_connect($servername,$username,$password,$dbname);
   if(!$conn_db)
   {
    #die("Could not connect succesfull to SDrive:".mysqli_connect_error());
   }
   else
   {
    #echo "<br>"."Connected successfully to SDrive"."<br>";
   }  
    
######################################################### CREATING TABLE  SIGNUP FORM #########################################################
   
   $sql="CREATE TABLE IF NOT EXISTS SignUp_Info(Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,First_name VARCHAR(50),Last_name VARCHAR(50),Email_Id VARCHAR(100),Password VARCHAR(30),reg_date TIMESTAMP)";
   if(mysqli_query($conn_db,$sql))
   {
    #echo "<br>"."Created table SignUp_Info successfully"."<br>";
   }
   else
   {
    #echo "<br>"."Couldn't create table SignUp_Info:".mysqli_error($conn_db)."<br>";
   }
    
########################################################## INSERTING DATA INTO TABLE ##########################################################
   
   $sql="INSERT INTO SignUp_Info (First_name,Last_name,Email_Id,Password) VALUES('$fname','$lname','$eid','$pwd')";
   if(mysqli_query($conn_db,$sql))
   {
    $email_confirm="Your account has been created successfully";
   }
   else
   {
    #echo "<br>"."Data not inserted successfully"."<br>";
   }
    
   if(!file_exists("C:/Users/DELL/Desktop/Uploads/$lname/"))
   {
    if(mkdir("C:/Users/DELL/Desktop/Uploads/$lname/",777))
    { 
     $_SESSION["Uploaddir"]="C:/Users/DELL/Desktop/Uploads/$lname/";
     $namespace="Namespace has been created for you in our database with location:".$lname;
    }
    else
    {
     $namespace="Your namespace cannot be created now, please visit again later";
    }
   }
   else
   { 
    $namespace="Namespace for you already exists in our database with location:".$lname.", please change your lastname"; 
   }
  }  
  unset($_SESSION["signup_confirm"]);
  unset($_SESSION["signup"]);
 }   
?>

<html>
 <head>
  <title>
    SignUp-confirm
  </title>
  <link rel="stylesheet" type="text/css" href="css/signup_output.css">
 </head>
 <body>
   <header>
	  <div id="logo">
		<a href="login.php"><h1>SDrive</h1></a>
	  </div>
   </header>
   <main>
     <?php
       if ($pwd!==$cfmpwd)
       {
        $pwderror="Password are not matched, please re-enter your password";
		echo "<h3>".$pwderror."</h3>"."<br>";
	   }
       else
       {
		echo "<h3>".$email_confirm."</h3>"."<br>";
        echo "<h3>".$namespace."</h3>"."<br>";		
	   }		   
	 ?>
	 <form method="POST">
	   <input type="submit" name="redirect_login" value="Click here to login">
	 </form>
   </main>
   <footer>
      <p>&copy;2016 SDrive,Gryffindors Inc.</p>
  </footer>
 </body>
</html>

<?php
 if(isset($_POST["redirect_login"]))
 {
  header("Location:login.php");	 
 }
?>
