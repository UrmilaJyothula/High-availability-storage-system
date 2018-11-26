<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {
  if(!isset($_SESSION["upload_output"]))
  {
   header("Location:upload_user.php");	  
  }	  
 }
 $email = $_SESSION["email_login"];
 $lastname = $_SESSION["lastname"];
 $file_output = $_SESSION["file_output"];
?>

<html>
  <head>
    <title>
      Upload-Output
    </title>
    <link rel="stylesheet" type="text/css" href="css/upload_output.css">
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
	   <?php echo "<h2>".$lastname."</h3>";?>
	  </div>
	</header>
    <main>
      <?php echo "<h3>".$file_output."</h3>"; unset($_SESSION["upload_output"]); unset($_SESSION["fileuploaded"]);?>
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

