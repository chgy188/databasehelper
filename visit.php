
<?php
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');
 $inputfile=file_get_contents("php://input");
 $str=substr($inputfile,strpos($inputfile,"<column>")+8,strpos($inputfile,"</column>")-(strpos($inputfile,"<column>")+8));
 
 if ($str!="")
 {$str=str_replace(" ","&",$str);
  $str=substr($str,0,60);

//$file=fopen("tbbrowser_log.txt","a") or exit("Unable to open file!");
//fwrite($file,$str." ".date("m-d A g:i")." IP:".$_SERVER["REMOTE_ADDR"]."\n\r");
$strarray=explode(" ",date("Y-m-d A g:i"));
$IP=$_SERVER["REMOTE_ADDR"];
$conn = @mysql_connect('127.0.0.1','root','cmbc.138');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('query_log', $conn);

$sql = "insert into visit(userid,date,ampm,time,ip) values('$str','$strarray[0]','$strarray[1]','$strarray[2]','$IP');";
$result = @mysql_query('SET NAMES UTF8');
$result = @mysql_query($sql);
//if (!$result) {echo ('error'.mysql_error($conn));}
mysql_free_result($result);
mysql_close($conn);
 }


 ?> 