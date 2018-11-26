<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {	 
  if(!isset($_SESSION["fileuploaded"]))
  {
   $_SESSION["fileuploaded"] = True;  
   header("Location:upload_user.php");
  }
 } 
 
 $email = $_SESSION["email_login"];
 $servername = "193.11.184.249";
 $username = "root";
 $password = "123456";
 $dbname = "SDrive";
 
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 
 if(!$conn)
 {
  #die("Couldn't connect to database:".mysqli_connect_error());
  #echo "<br>"; 
 }
 else
 {
  #echo "Connected to database successfully"."<br>";
 }
 $lastname = $_SESSION["lastname"];
 if(!file_exists("C:/Users/DELL/Desktop/Uploads/"."$lastname/"))
 {
	mkdir("C:/Users/DELL/Desktop/Uploads/"."$lastname/");
 }
 function formatSizeUnits($bytes)
 {
  if($bytes >= 1073741824)
  {
   $bytes = number_format($bytes/1073741824, 2) .' GB';
  }
  elseif($bytes >= 1048576)
  {
   $bytes = number_format($bytes/1048576, 2) .' MB';
  }
  elseif($bytes >= 1024)
  {
   $bytes = number_format($bytes/1024, 2) .' KB';
  }
  elseif($bytes>1)
  {
   $bytes = $bytes.' bytes';
  }
  elseif($bytes == 1)
  {
   $bytes = $bytes.' byte';
  }
  else
  {
   $bytes = '0 bytes';
  }
  return $bytes;
 }
 
?>

<html>
  <head>
    <title>
      Upload-User
    </title>
    <link rel="stylesheet" type="text/css" href="css/upload_user.css">
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
         <div class="upload_style">
          <form method="POST" enctype="multipart/form-data">
            <input class="sample" type="file" name="uploadfile" value="uploadfile"><br>
            <br><input type="submit" name="upload_submit" value="Upload File">
          </form>
         </div>
        </center>
    </main>
    <footer>
      <p>&copy;2016 Secure Drive,Gryffindors Inc.</p>
    </footer>
  </body>
</html>


<?php
 $_SESSION["uploadoutput"]=True;
 if(isset($_POST["submit_logout"]))
 {
  unset($_SESSION["loggedin"]);
  session_destroy();
  header("Location:login.php");
  exit;
 } 
 
 
 if(isset($_POST["upload_submit"])&& isset($_FILES["uploadfile"]))
 {
  $_SESSION["uploaddir"] = "C:/Users/DELL/Desktop/Uploads/"."$lastname/";
  $original_name = $_SESSION["original_name"] = $_FILES["uploadfile"]["name"];
  $byte_size = $_FILES["uploadfile"]["size"];
  $final_size = $_SESSION["size"] = formatSizeUnits($byte_size);
  $uploadfile = $_SESSION["uploadfile"] = $_SESSION["uploaddir"].basename($_SESSION["original_name"]);
  $temporary_name = $_SESSION["temporary_name"] = $_FILES["uploadfile"]["tmp_name"];
  $lastname = $_SESSION["lastname"];
  if(move_uploaded_file($_SESSION["temporary_name"], $_SESSION["uploadfile"]))
  {
   $_SESSION["file_output"] = $original_name." has been uploaded successfully";
             
   $sql = "CREATE TABLE IF NOT EXISTS $lastname(Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, File_name VARCHAR(500), File_location VARCHAR(500), File_size VARCHAR(500), reg_date TIMESTAMP)";          
   if(mysqli_query($conn,$sql))
   {
    #echo "Table created successfully:".$lastname_upload_output;
   }
   else
   {
    #echo "couldn't create table successfully:".mysqli_error($conn_db_output_upload);
   }
             
   $sql = "INSERT INTO $lastname(File_name, File_location, File_size) VALUES('$original_name', '$uploadfile', '$final_size')";
   if(mysqli_query($conn,$sql))
   {
    #echo "File information of ".$original_name." is successfully inserted into table:".$lastname_upload_output."<br>";
   }
   else
   {
    #echo "Couldn't enter data successfully:".mysqli_error($conn_db_output_upload);
   }
  }
  $_SESSION["upload_output"] = True;
  header("Location:upload_output.php");
 }
?>
