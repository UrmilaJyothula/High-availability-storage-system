<?php
 session_start();
 if(!isset($_SESSION["loggedin"]))
 {
  header("Location:login.php");  
 }
 else
 {
  if(!isset($_SESSION["edit_user"]))
  {
   $_SESSION["edit_user"] = True;	 
   header("Location:edit_user.php");	 
  }
 }
