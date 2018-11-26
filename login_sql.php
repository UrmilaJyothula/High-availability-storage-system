<?php
$eid_login=$_POST["emailid_login"];
$pwd_login=$_POST["password_login"];
echo "Your E-mail Id is:".$eid_login."<br>";
echo "Your password is:".$pwd_login."<br>";
$servername="localhost";
$username="root";
$password="2537@Nuka";
$dbname="SDrive";
############################################################ CONNECTION TO DATABASE ###########################################################
$conn_db_login=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn_db_login)
{
 echo "<br>";
 die("Could not connect to SDrive database".mysqli_connect_error());
 echo "<br>";
}
else
{
 echo "<br>"."Connected to SDrive database successfully"."<br>";
}
##################################################### CHECKING IF EMAIL  ID EXISTS OR NOT #####################################################
$sql="SELECT * FROM SignUp_Info WHERE Email_Id='$eid_login'";
$result=mysqli_query($conn_db_login,$sql);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $verify_login_pwd=$row["Password"];
 }
}
else
{
 echo "E-mail Id does not exist";
}
##################################################### CHECKING IF  PASSWORD EXISTS OR NOT #####################################################
if($pwd_login==$verify_login_pwd)
{
 echo "<br>"."Password's are correct"."<br>";
}
else
{
 echo "<br>"."Password's are not correct"."<br>";
}
 
$conn_db_login(close);
?>
