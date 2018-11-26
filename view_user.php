<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 
 $servername = "193.11.184.249";
 $username = "root";
 $password = "123456";
 $dbname = "SDrive";
 $lastname = $_SESSION["lastname"];
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 $ownfiles = array();
 $sql = "SELECT * FROM $lastname";
 $result = mysqli_query($conn,$sql);
 if($result)
 {
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
	 $id = $row["Id"]; 
     $ownfiles[$id] = $row["File_name"];
   }
  }
  else
  {
   #echo "0 results"."<br>";
  }	  
 }
 
 $sql = "SELECT * FROM $lastname ORDER BY Id DESC LIMIT 1";
 $result = mysqli_query($conn,$sql);
 if($result)
 {
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
    $total = $_SESSION["total"] = $row["Id"];
   }
  }
  else
  {
   #echo "0 results"."<br>";
  }
 }
 
 $sharedforme = $lastname."_shared";
 $sharedfiles = array();
 
 $sql = "SELECT * FROM $sharedforme";
 $result = mysqli_query($conn,$sql);
 if($result)
 {
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
	 $id_share = $row["Id"]; 
     $sharedfiles[$id_share] = $row["File_name"];
   }
  }
  else
  {
   #echo "0 results"."<br>";
  }	  
 }
 
 $sql = "SELECT * FROM $sharedforme ORDER BY Id DESC LIMIT 1";
 $result = mysqli_query($conn,$sql);
 if($result)
 {
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
    $total_share = $row["Id"];
   }
  }
  else
  {
   #echo "0 results"."<br>";
  }
 }
?>

<html>
 <head>
  <title>
   View-Files-User
  </title>
  <link rel="stylesheet" type="text/css" href="css/view_user.css">
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
	   <h2>Your own files</h2>
       <form method="post">
	    <?php
		 if(!empty($total))
		 {	 
          for($i=1;$i<=$total;$i++)
          { 
           if(!empty($ownfiles[$i]))
           {
            echo "<button class=\"button viewfiles\"type=\"submit\" name=$i>$ownfiles[$i]</button>"."<br>";
           }
          }
		 }
         else
         {
		  echo "<h3>You do not have any files to view</h3>";  
	     }		 
        ?>
       </form>
      </div>
	  <div class="sharedfiles">
	   <h2>Your shared files</h2>
	   <form method="post">
	   	<?php
		 if(!empty($total_share))
		 { 	 
          for($i=1;$i<=$total_share;$i++)
          { 
           if(!empty($sharedfiles[$i]))
           {
		    $j = -$i;
            echo "<button class=\"button viewfiles\"type=\"submit\" name=$j>$sharedfiles[$i]</button>"."<br>";
           }
          }
		 }
         else
         {
		  echo "<h3>You do not have any shared files to view</h3>";  
	     }		 
        ?>
		</form>
	  </div>
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
  header("Location:login.php");
 }
 if(!empty($total))
 {
  for($i=1;$i<=$total;$i++)
  {
   if(isset($_POST[$i]))
   {
    $_SESSION["file_type"] = "own";
    $_SESSION["file_num"] = $i;
    header("Location:view_output.php");
   }
  }
 } 
 #############################
 if(!empty($total_share))
 {
  for($i=1;$i<=$total_share;$i++)
  {
   $j = -$i;
   if(isset($_POST[$j]))
   {
    $_SESSION["file_type"] = "shared";
    $_SESSION["file_num"] = $i;
    header("Location:view_output.php");
   }
  }
 }
?>
