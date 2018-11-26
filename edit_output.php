<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {
  if(!isset($_SESSION["edit_output"]))
  {
   header("Location:edit_original.php");	 
  }
 } 
 $filepath = $_SESSION["filepath"];
 $filename = $_SESSION["filename"];
 $fulldata = $_SESSION["totaldata"];
 $output = file_put_contents($filepath,$fulldata);
 $lastname = $_SESSION["lastname"];
 
?>
<html>
  <head>
    <title>
      Edit-File-Output
    </title>
    <link rel="stylesheet" type="text/css" href="css/edit_original.css">
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
	  <center>
       <?php
         echo "<h3>"."Your file was saved successfully </br></br>relax, while we redirect you to your page..."."</h3>";
		 unset($_SESSION["edit_output"]);
		 unset($_SESSION["edit_original"]);
		 unset($_SESSION["edit_user"]);
         header("refresh:3,url=edit_original.php");
       ?>
	  </center>
	</main>
	<footer>
	 <p>&copy;2016 SDrive,Gryffindors Inc.</p>
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
