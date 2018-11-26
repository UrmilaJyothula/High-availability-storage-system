<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:admin_login.php");  
 }
 
 $servername = "193.11.184.249";
 $username = "root";
 $password = "123456";
 $dbname = "SDrive";
 
 $email = $_SESSION["email_login"];
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 if(!$conn)
 {
  #die("Couldn't connect to SDrive:".mysqli_connect_error());
  #echo "<br>";
 }
 else
 {
  #echo "Connected to database SDrive"."<br>";
 }
 $sql = "SELECT * FROM Admin_Info WHERE Email_Id = '$email'";
 $result = mysqli_query($conn,$sql);
 
 if(mysqli_num_rows($result)>0)
 {
  while($row = mysqli_fetch_assoc($result))
  {
   $_SESSION["lastname"] = $lastname = $row["Last_name"];
  }
 }
 else
 {
  #echo "O results found";
 }
?>

<html>
  <head>
    <title>
      Admin-Profile-Home
    </title>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
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
      <div class="up">
        <h1>Hi <?php echo $lastname;?> ! </h1><br>
        <h2>Welcome to SDrive, here you can delete our customers!</h2><br>
      </div>
      <div class="down">
           <table class="table_style">
                <tr>
                   <th><h2>Delete Users</h2></th> 
                </tr>
                <tr>
                   <td><p>Please delete users here</p></td>
                </tr>
                <tr>
                 <td><form class="input_submit" method="POST"><input type="submit" name="delete_submit" value="Delete Users"></form></td>
                </tr>
           </table>
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
  header("Location:admin_login.php");
 }
 elseif(isset($_POST["delete_submit"]))
 {
  $_SESSION["deleteusers"] = True ;
  header("Location:deleteusers.php");
 }
 else
 {
 }
?>
