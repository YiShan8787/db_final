<?php session_start(); ?>
<?php
    include_once "db_conn.php";
$times=$_POST["time"];
echo "<script>console.log('Debug Objects: *" . $times . "' );</script>";
$description=$_POST["description"];
$duration=$_POST["duration"];
$place=$_POST["place"];
$detail=$_POST["detail"];
$host=$_POST["teacherName"];
$output = explode(" ", $times);
$date=$output[0];
$time=$output[1];
$am_or_pm=$output[2];
$output=explode("/", $date);
$day=$output[1];
$month=$output[0];
$year=$output[2];
$date2=$year.'-'.$month.'-'.$day;
$output=explode(":", $time);
$hour=$output[0];
$minute=$output[1];
//$second=$output[2];
if (preg_match("/pm/i", $am_or_pm))
{
	$hour=$hour+12;
}
$time=$hour.':'.$minute.':'.'00';
echo "<script>console.log('Debug Objects: " . $date2 . "' );</script>";
echo "<script>console.log('Debug Objects: " . $time . "' );</script>";
echo "<script>console.log('Debug Objects place: " . $place . "' );</script>";
echo "<script>console.log('Debug Objects detail: " . $detail . "' );</script>";
echo "<script>console.log('Debug Objects host: " . $host . "' );</script>";
echo "<script>console.log('Debug account: " . $_SESSION['account'] . "' );</script>";
   $query=("insert into meeting_info values(?,?,?,?,?)");
   $stmt=$db->prepare($query);
   $stmt->execute(array($date2,$time,$description,$duration,$_SESSION['account']));
   $query2=("insert into meeting_content values(?,?,?,?,?)");
   $stmt2=$db->prepare($query2);
   $stmt2->execute(array($date2,$time,$place,$detail,$host));
header('Location:meeting_info.php')
?>