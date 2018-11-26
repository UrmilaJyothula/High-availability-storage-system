{\rtf1\ansi\ansicpg1252\cocoartf1504\cocoasubrtf830
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 <?php\
include 'replications.php';\
\
// -> database details\
$dbserver = "localhost";\
$db_username = "root";\
$fs_username = "sdp"\
$passcode = "sdplabb9";\
$dbname = $_SESSION["user"];\
$file_path = "/home/sdp/storage/".$dbname."/".$filename; // check the $filename name and replace it\
\
// -> opening a remote mysql database connection\
$conn = mysqli_connect($db_server, $db_username, $passcode, $dbname);\
\
// -> replicate the file to other servers\
for ($r = 1; $r <= $_SESSION["replicas"]; $r++) \{\
    $table_name = "replica".$r;\
    $replica_ip = $_SESSION['rip_s'][$r];\
    $ssh_conn = ssh2_connect($replica_ip, 22);\
	if (ssh2_auth_password($ssh_conn, $fs_username, $passcode)) \{  \
   if (ssh2_scp_send($connection, $file_path, $file_path, 0777))\{\
   \
   // -> creating tables for the replicas\
   $sql2 = "create table IF NOT EXISTS ".$table_name." (id int AUTO_INCREMENT PRIMARY KEY, filename varchar(50), ip_addr varchar(50))";\
   $result2 = mysqli_query($conn, $sql2);\
   \
   // -> inserting replica info into the mysql database\
   $sql3 = "insert into ".$table_name."(filename, ip_addr) values (".$filename.", ".$replica_ip.")";\
   $result3 = mysqli_query($conn, $sql3);\
   \}\}\
   else\
   \{\
   echo "Replication of file to (".$replica_ip.") is not successful...";\
   \}\
   \}\
\
// -> closing the database connection\
mysqli_close($conn);\
\
?>\
}
