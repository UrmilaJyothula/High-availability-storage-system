<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {
  if(!isset($_SESSION["edit_original"]))
  {
   $_SESSION["edit_original"] = True;	  
   header("Location:edit_original.php");	 
  }
 } 
 $usertype = $_SESSION["usertype"];
 $id = $_SESSION["Option"];
 $lastname = $_SESSION["lastname"];
 $sharedforme = $lastname."_shared"; 
 
 $servername = "193.11.184.249";
 $username = "root";
 $password = "123456";
 $dbname = "SDrive";
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 if(!$conn)
 {
  #die("Couldn't connect to database:".mysqli_connect_error());
 }
 else
 {
  #echo "Connected to database successfully"."<br>";
 }
 
 if($usertype === "root_user")
 {
  $sql = "SELECT * FROM $lastname WHERE Id='$id'";
  $result = mysqli_query($conn,$sql);
  if($result)
  {
   if(mysqli_num_rows($result)>0)
   {
	while($row = mysqli_fetch_assoc($result))
    {
	 $_SESSION["filename"] = $filename = $row["File_name"];
	 $_SESSION["filepath"]= $filepath = $row["File_location"];	  
	}
   }		
  }
  else
  {
   #echo "0 results";   
  }	   
 }
 elseif($usertype === "share_user")
 {
  $sql = "SELECT * FROM $sharedforme WHERE Id='$id'";
  $result = mysqli_query($conn,$sql);
  if($result)
  {
   if(mysqli_num_rows($result)>0)
   {
	while($row = mysqli_fetch_assoc($result))
    {
	 $_SESSION["filename"] = $filename = $row["File_name"];
	 $_SESSION["filepath"] = $filepath = $row["File_linked_location"];
	}		
   }
   else
   {
	#echo "0 results";   
   }	   
  }	  	 
 }
 else
 {
	 
 }
 $data = file_get_contents($filepath);
?>

<html>
  <head>
    <title>
      Edit-File-Original
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
	  <form method="POST">
	   <fieldset>
       <legend><?php echo " ".$filename." "; ?></legend>
	   <textarea name="filedata" class="area">
        <?php
         echo $data;
        ?>
       </textarea>
       <br>
       <input type="submit" name="save_file" value="Save File">  
       </fieldset>
	  </form>
	  </center>
	</main>
	<footer>
	 <p>&copy;2016 SDrive,Gryffindors Inc.</p>
	</footer>
  </body>
</html>  

<?php
 if(isset($_POST["save_file"]))
 {
  $_SESSION["edit_output"] = True;
  $_SESSION["totaldata"] = $_POST["filedata"];
  header("Location:edit_output.php");  
 }
 elseif(isset($_POST["submit_logout"]))
 {
  unset($_SESSION["loggedin"]);
  session_destroy();
  header("Location:login.php"); 
 }
 else
 {
	 
 }
?>
