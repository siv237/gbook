<?php
$city=exec("grep city /var/lib/aststat/jde/data.txt|grep -v '^#'|tail -n 1|awk -F '=' '{print $2}'");
$pref=exec("grep pref /var/lib/aststat/jde/data.txt|grep -v '^#'|tail -n 1|awk -F '=' '{print $2}'");
$ftpaddress=exec("grep ftpaddress /var/lib/aststat/jde/data.txt|grep -v '^#'|tail -n 1|awk -F '=' '{print $2}'");
$ftplogin=exec("grep ftplogin /var/lib/aststat/jde/data.txt|grep -v '^#'|tail -n 1|awk -F '=' '{print $2}'");
$ftppass=exec("grep ftppass /var/lib/aststat/jde/data.txt|grep -v '^#'|tail -n 1|awk -F '=' '{print $2}'");
$dir ='/var/lib/aststat/jde/';
$file=$city.'.csv';
//$dirtmp=$dir.'tmp/';
include 'astuser.php';
//mkdir($dirtmp);
//echo "$ftpaddress";
exec("cd /var/lib/aststat/jde/");
$conn_id = ftp_connect("$ftpaddress","21","100");
ftp_login($conn_id, $ftplogin, $ftppass);
ftp_put($conn_id, 'EIC.csv', $file, FTP_BINARY);
$buff = ftp_rawlist($conn_id, '/');
$contents = ftp_nlist($conn_id, ".");
//exec("cd /var/lib/aststat/jde/tmp/");
//ftp_close($conn_id); 
$handle = fopen($dir.'jde.csv', 'w');
foreach ( $contents as $one_file)
{
//echo $one_file;
//exec("cd /var/lib/aststat/jde/tmp/");

ftp_fget($conn_id, $handle, $one_file, FTP_BINARY);
}
ftp_close($conn_id);

?>

