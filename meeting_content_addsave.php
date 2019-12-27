<?php session_start(); ?>
<?php
    include_once "db_conn.php";
$times=$_POST["time"];
$place=$_POST["place"];
$detail=$_POST["detail"];
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
echo "<script>console.log('Debug account: " . $_SESSION['account'] . "' );</script>";
   $query=("insert into meeting_content values(?,?,?,?,?)");
   $stmt=$db->prepare($query);
   $stmt->execute(array($date,$time,$place,$detail,$_SESSION['account']));
header('Location:meeting_content.php')
?>