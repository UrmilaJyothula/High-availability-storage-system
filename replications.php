{\rtf1\ansi\ansicpg1252\cocoartf1504\cocoasubrtf830
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 \
<?php\
// -> database details\
$dbserver = "localhost";\
$db_username = "root";\
$passcode = "sdplabb9";\
$dbname = "admin";\
\
// -> open a remote mysql database connection\
$conn = mysqli_connect($db_server, $db_username, $passcode, $dbname);\
if (!$conn) \{\
    die("Connection failed: " . mysqli_connect_error());\}\
    \
// -> retrieving and storing the choice of number of replicas for each file from database\
$sql1 = "select number from numberofreplicas ORDER BY id DESC LIMIT 1";\
$result1 = mysqli_query($conn, $sql1);\
$_SESSION["replicas"] = mysqli_fetch_array($result1);\
\
// -> retrieving and storing the ips from the server pool\
$sql = "select ip_addr from server_pool"; \
$result = mysqli_query($conn, $sql); \
$ip_s = array(); \
if (mysqli_num_rows($result) > 0) \{\
    while($row = mysqli_fetch_assoc($result)) \{\
        array_push($ip_s, $row["ip_addr"]);\}\} \
        \
// -> removing the local system's ip from the server pool\
$localIP = getHostByName(getHostName());      \
if (($key = array_search("$localIP", $ip_s)) !== false) \{\
unset($ip_s[$key]);\}\
        \
// -> randomly select r number of servers from the server pool\
$random_ip_s = array_rand($ip_s,$_SESSION["replicas"]);\
$_SESSION['rip_s'] = $random_ip_s;\
\
// closing the remote mysql connection\
mysqli_close($conn);\
?>\
}
