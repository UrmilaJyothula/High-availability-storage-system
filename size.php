<?php
session_start();
?>

<?php
$_SESSION['user'] = "kksrikasyap@gmail.com";
$folder_path = "/home/sdp/drive/".$_SESSION['user'];
$used = 0;
if (is_dir($folder_path)) {
    if ($dh = opendir($folder_path)) {
        while (($file = readdir($dh)) !== false) {
	    $file_path = $folder_path."/".$file;
	    $size = filesize($file_path);
            $used = $used + $size;}
        closedir($dh);}}
$remaining = (5*(10**9)) - $used;
$units = explode(' ', 'B KB MB GB');
function calculate_size($remaining) {
    global $units;
    $mod = 1024;
    for ($i = 0; $remaining > $mod; $i++) {
        $remaining /= $mod;}
    $endIndex = strpos($remaining, ".")+3;
    return substr( $remaining, 0, $endIndex).$units[$i];}
$_SESSION['remaining'] = calculate_size($remaining);
$_SESSION['storage'] = "Remaining storage space: (".$_SESSION['remaining']." of 5GB)\n";
echo $_SESSION['storage'];
?>
