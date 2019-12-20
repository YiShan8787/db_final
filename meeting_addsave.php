<?php
    include_once "db_conn.php";
$times=$_POST["time"];
$description=$_POST["description"];
$output = explode(" ", $times);
$date=$output[0];
$time=$output[1];
$am_or_pm=$output[2];
$output=explode("/", $date);
$day=$output[0];
$month=$output[1];
$year=$output[2];
$date=$year.'-'.$month.'-'.$day;
$output=explode(":", $time);
$hour=$output[0];
$minute=$output[1];
//$second=$output[2];
if (preg_match("/pm/i", $am_or_pm))
{
	$hour=$hour+12;
}
$time=$hour.$minute.'00';
echo "<script>console.log('Debug Objects: " . $date . "' );</script>";
echo "<script>console.log('Debug Objects: " . $time . "' );</script>";
   $query=("insert into meeting_info values(?,?,?,?)");
   $stmt=$db->prepare($query);
   $stmt->execute(array($date,$time,$description,'2'));
header('Location:meeting_info.php')
?>