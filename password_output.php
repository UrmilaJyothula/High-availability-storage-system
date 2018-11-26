<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {
  if(!isset($_SESSION["password_output"]))
  {
   header("Location:password_user.php");	 
  }
 } 
 
 if(isset($_SESSION["password_output"]))
 {
  $email_owner = $_SESSION["email_login"];
  $lastname = $_SESSION["lastname"];
  $password = $_SESSION["password"];
  $confirm_password = $_SESSION["confirm_password"]; 
   
  if($password !== $confirm_password)
  {
   $output = "Your passwords do not match, please enter your passwords again";  
  }
  else
  {	 
   $servername = "193.11.184.249";
   $username = "root";
   $passworddb = "123456";
   $dbname = "SDrive";
   
   $conn = mysqli_connect($servername, $username, $passworddb, $dbname);
   if(!$conn)
   {
    #die("Couldn't connect to database:".mysqli_connect_error());
   }
   else
   {
    #echo "Connected to database successfully"."<br>";
   }
    
   $sql = "UPDATE SignUp_Info SET Password='$password' WHERE Email_Id='$email_owner'";
   $result = mysqli_query($conn,$sql);
   if($result)
   {
    unset($_SESSION["password_page"]);	  
    unset($_SESSION["password_output"]);
    $output = "Your password has been updated";
   }
  }
 }  
?>

<html>
 <head>
  <title>
    Password Output
  </title>
  <link rel="stylesheet" type="text/css" href="css/password_output.css">
 </head>
 <body>
   <header>
	  <div id="logo">
		<a href="profile.php"><h1>SDrive</h1></a>
	  </div>
	  <div class="innertube">
	   <form class="logout" method="POST">
          <button type="submit" class="button logout_button" name="submit_logout" value="Logout">Logout</button>
        </form>
	  </div>
	  <div class="nametube">
	   <?php echo "<h3>".$lastname."</h3>";?>
	  </div>
	</header>
   <main>
     <?php echo "<h3>".$output."</h3>";?>
   </main>
   <footer>
      <p>&copy;2016 Secure Drive,Gryffindors Inc.</p>
  </footer>
 </body>
</html>

<?php
 if(isset($_POST["submit_logout"]))
 {
  unset($_SESSION["loggedin"]);
  session_destroy();
  header("Location:login.php");
 }
?>
