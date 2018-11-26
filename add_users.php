# High-availability-store-system
<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:admin_login.php");  
 }
 else
 {
  if(!isset($_SESSION["addusers"]))
  {
   $_SESSION["addusers"]=True;
   header("Location:add_users.php");  
  }
 } 
 
 $servername = "192.168.0.3";
 $username = "root";
 $password = "123456";
 $dbname = "SDrive";
 $lastname = $_SESSION["lastname"];
 
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 if(!$conn)
 {
  #die("Couldn't connect to database:".mysqli_connect_error());
 }
 else
 {
  #echo "Connected to database successfully"."<br>";
 }
 $userids = array();
 
 $sql = "SELECT * FROM SignUp_Info";
 $result = mysqli_query($conn, $sql);
 if($result)
 {
  if(mysqli_num_rows($result) > 0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
	$id = $row["Id"];
    $userids[$id] = $row["Email_Id"];	
   }	   
  }	  
 }
 
 $sql = "SELECT * FROM SignUp_Info ORDER BY Id DESC LIMIT 1";
 $result = mysqli_query($conn,$sql);
 if($result)
 {
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
    $_SESSION["lastid"] = $row["Id"];
   }
  }
  else
  {
   #echo "Last Id:0 results"."<br>";
  }
 }
?>

<html>
 <head>
  <title>
    Delete-Users
  </title>
  <link rel="stylesheet" type="text/css" href="css/deleteusers.css">
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
    <div class="ownfiles">
     <h2>Share your own files</h2>
     <form method="POST" class="floatset">
     <select name="Option">
      <option value="select user">Select user</option>;
      <?php
       $lastid=$_SESSION["lastid"];
	   if(!empty($lastid))
	   {
        for($n=1;$n<=$lastid;$n++)
        {
         if(!empty($userids[$n]))
         {
          echo "<option value=$n>$userids[$n]</option>";
         }
        }
	   }	
      ?>
     </select>
     <br><br>
     <br><input type="submit" name="delete_user" value="Delete User">
     </form>
    </div>
   <!-- -->
  </main>
  <footer>
      <p>&copy;2016 Secure Drive,Gryffindors Inc.</p>
  </footer>
 </body>
</html>

<?php
  if(isset($_POST["delete_user"]))
  {
   $_SESSION["Option"] = $n = $_POST["Option"];
   $emailid = $userids[$n];
   if(!empty($emailid)&& ($emailid!=="select user"))
   {	   
    $sql = "DELETE FROM SignUp_Info WHERE Email_Id='$emailid'";
    $result = mysqli_query($conn,$sql);
    if($result)
	{
     $_SESSION["delete_users_output"] = "User with Email_Id:".$emailid." has been deleted successfully";
     $_SESSION["deleteuser_output.php"] = True;
     header("Location:deleteuser_output.php");	 
	}
   }
  } 
  ################################################################  
  elseif(isset($_POST["submit_logout"]))
  {
   unset($_SESSION["loggedin"]);
   session_destroy();
   header("Location:admin_login.php");
  }
  
  else
  {
	  
  }
?>
