<?php
 session_start();
 $filetype = $_SESSION["file_type"];
 $lastname = $_SESSION["lastname"];
 $id = $_SESSION["file_num"];
 
 $servername = "193.11.184.249";
 $username = "root";
 $password = "123456";
 $dbname = "SDrive";
 $sharedforme = $lastname."_shared";
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 if(!$conn)
 {
  #die("Couldn't connect to database:".mysqli_connect_error());
 }
 else
 {
  #echo "Connected successfully";
 }
 
 if($filetype === "own")
 {
  $sql = "SELECT * FROM $lastname WHERE Id='$id'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
    $file_location = $row["File_location"];
    $file_name = $row["File_name"];
   }
  }
  else
  {
   #echo "0 results";
  }
 }
 
 
 elseif($filetype === "shared")
 {
  $sql = "SELECT * FROM $sharedforme WHERE Id='$id'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0)
  {
   while($row = mysqli_fetch_assoc($result))
   {
    $file_location = $row["File_linked_location"];
    $file_name = $row["File_name"];
   }
  }
  else
  {
   #echo "0 results";
  }
 }
 
 else
 {
	 
	
 }
 
 $file_split = explode('.',$file_name);
 $extension = $file_split[1];
 if($extension == "txt")
 {
  header('Content-disposition: inline');
  header('Content-type: text/plain');
  readfile($file_location);
 }
 elseif($extension == "pdf")
 {
  header('Content-disposition: inline');
  header('Content-type: application/pdf');
  readfile($file_location);
 }
 elseif($extension == "html")
 {
  header('Content-disposition: inline');
  header('Content-type: text/html');
  readfile($file_location);
 }
 elseif($extension == "css")
 {
  header('Content-disposition: inline');
  header('Content-type: text/css');
  readfile($file_location);
 }
 elseif($extension == "png")
 {
  header('Content-disposition: inline');
  header('Content-type: image/png');
  readfile($file_location);
 }
 elseif($extension == "jpeg")
 {
  header('Content-disposition: inline');
  header('Content-type: image/jpeg');
  readfile($file_location);
 }
 elseif($extension == "jpg")
 {
  header('Content-disposition: inline');
  header('Content-type: image/jpg');
  readfile($file_location);
 }
 elseif($extension == "mp4")
 {
  header('Content-disposition: inline');
  header('Content-type: video/mp4');	
  readfile($file_location);  
 }
 else
 {
  header("Location:fileopen_error");	 
 }
 
?>
