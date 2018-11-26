<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {
  if(!isset($_SESSION["delete_output"]))
  {
   header("Location:delete_user.php");  
  }
 } 
 
 
 if(isset($_SESSION["delete_output"]))
 {
  $fileid = $_SESSION["value"];
  $filetype = $_SESSION["filetype"];
  $lastname = $_SESSION["lastname"];
  $sharedforme = $lastname."_shared";
  
  $servername = "193.11.184.249";
  $username = "root";
  $password = "123456";
  $dbname = "SDrive";
  
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {
   #die("Couldn't connect to database:".mysqli_connect_error());	  
  }
  else
  {
   #echo "Connected to database successfully<br>";	  
  }
  
  if($filetype === "root_file")
  {
   $sql = "SELECT * FROM $lastname WHERE Id='$fileid'";
   $result = mysqli_query($conn,$sql);
   if($result)
   {
	if(mysqli_num_rows($result)>0)
    {
	 while($row = mysqli_fetch_assoc($result))
     {
	  $ownfilename = $row["File_name"];
      $ownfilelocation = $row["File_location"];	  
	 }		 
	}
    else
    {
	 #echo "0 results<br>";	
	}		
   }
   if(unlink($ownfilelocation))
   {
	$sql = "DELETE FROM $lastname WHERE Id='$fileid'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
	 $output = $ownfilename." has been successfully deleted<br>";	
	}
    else
    {
	 $output = "There is a problem with deleting ".$ownfilename.":".mysqli_error($conn);	
	}		
   }	   	  
  }
  elseif($filetype === "shared_file")
  {
   $sql = "SELECT * FROM $sharedforme WHERE Id='$fileid'";
   $result = mysqli_query($conn,$sql);
   if($result)
   {
	if(mysqli_num_rows($result)>0)
    {
	 while($row = mysqli_fetch_assoc($result))
     {
	  $sharedfilename = $row["File_name"];
      $sharedfilelocation = $row["File_linked_location"];	  
	 }		 
	}
    else
    {
	 #echo "0 results<br>";	
	}		
   }
   if(unlink($sharedfilelocation))
   {
	$sql = "DELETE FROM $sharedforme WHERE Id='$fileid'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
	 $output = $sharedfilename." has been successfully deleted<br>";	
 	}
    else
    {
	 $output = "There is a problem with deleting ".$sharedfilename.":".mysqli_error($conn);	
 	}		
   }	   
  }
  
  else
  {
  	  
  }
  unset($_SESSION["delete"]);
  unset($_SESSION["delete_output"]);
 } 
?>

<html>
 <head>
  <title>
    Delete-Output
  </title>
  <link rel="stylesheet" type="text/css" href="css/share_error.css">
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
     <?php echo "<h3>".$output."</h3>"; ?>
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
