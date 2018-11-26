<?php
 
 session_start();
 if(isset($_SESSION["loggedin"]))
 {
  header("Location:profile.php");  
 }
 ################################################### CONNECTING LOCALHOST IN THE LOGIN PAGE ###################################################
 ################################################## DEFINING A FUNCTION TO VALIDATE USERNAME ##################################################
 function check_username($email,$pwd)
 {
  $servername = "193.11.184.249";
  $username = "root";
  $password = "123456";
  $dbname = "SDrive"; 
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {
   #die("Couldn't to connect to database:".mysqli_connect_error());
  }
  else
  {
   #echo "Connected sucessfully to the database";
  }
  
  $sql = "SELECT * FROM SignUp_Info WHERE Email_Id='$email'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
    $verify_login_pwd = $row["Password"];
    if($pwd != $verify_login_pwd)
    {
     $password_match = "You entered wrong password, please re-enter the password";
     echo "<p class=\"php\">".$password_match."</p>";
    }
    else
    {
     $_SESSION["loggedin"] = True;
     header('Location:profile.php');
    }
   }
  }
  else
  {	  
   $email_exits = "Id does not exists";
   echo "<p class=\"php\">".$email_exits."</p>";
  }
 }
?>

<html>
  <head>
    <title>
      Login-Home
    </title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>
  <body>
    <header>
	  <div id="logo">
		<a href="profile.php"><h1>SDrive</h1></a>
	  </div>
	</header>
    <main>
      <div>
        <center>
        <form method="POST">
          <fieldset class="formstyle">
            <legend>Login</legend>
              <div class="adjust">
                <br><label class="labels">E-mail ID</label><br>
                <input class="floattype" type="text" name="emailid_login" placeholder="E-mail Id" required><br>
                <br><label class="labels">Password</label><br>
                <input class="floattype" type="password" name="password_login" placeholder="Password" required><br>
                <br><button type="submit" name="login_submit" value="Login">Login</button>
              </div>
          </fieldset>
        </form>
        <?php 
         if(isset($_POST["login_submit"]))
         {
          $_SESSION["email_login"] = $eid_login = $_POST["emailid_login"];
          $pwd_login = $_POST["password_login"];
          check_username($eid_login,$pwd_login);
         }
        ?>
        <br><a class="link" href="signup.php">Click here to SignUp</a>
        </center>
      </div>
    </main>
    <footer>
      <p>&copy;2016 SDrive,Gryffindors Inc.</p>
    </footer>
  </body>
</html>
