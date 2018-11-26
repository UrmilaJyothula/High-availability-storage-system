<?php
$to = $_SESSION['user'];
$subject = "Account Confirmation";
$code = rand(100000,999999);
$name = $_SESSION['first_name']." ".$_SESSION['lastname'];
$message = "
<html>
<head>
<title>Account Confirmation!</title>
<body>
<h1>Hello, $name </h1><br\>
<h3>Yeah...! Account for you in SDrive has been successfully created...</h3><br\>
<h4> Your Login details:<br\>Username: $_SESSION['user']<br \>Password: $_SESSION['user_password']<br\><h4>
<h5>Your Account Activation code is $code</h5>
</body>
</head>
</html>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: noreply.SDrive@storage.com"."\r\n";
if (! mail($to,$subject,$message,$headers)){
echo "Error while sending email...\n";}
else{
header("Location:http://localhost/success.php");}
?> 
