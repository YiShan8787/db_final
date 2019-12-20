<?php
    include_once "db_conn.php";
$old_date=$_GET["m_date"];
$old_time=$_GET["time"];
$m_date=$_GET["m_m_date"];
$time=$_GET["m_time"];
$description=$_GET["m_description2"];
$duration=$_GET["m_duration"];
echo "<script>console.log('Debug 0Objects: " . $old_date . "' );</script>";
echo "<script>console.log('Debug 0Objects: " . $old_time . "' );</script>";
echo "<script>console.log('Debug Objects: " . $m_date . "' );</script>";
echo "<script>console.log('Debug Objects: " . $time . "' );</script>";
echo "<script>console.log('Debug Objects: " . $description . "' );</script>";
echo "<script>console.log('Debug Objects: " . $duration . "' );</script>";
//$inputs = array(':m_date' => $m_date,':time' => $time,':description' => $description,':duration' => $duration);
//$sql = "UPDATE meeting_info SET m_date=':m_date' ,time=':time' ,description=':description' , duration=':duration' WHERE m_date='$old_date' AND time='$old_time'";
$inputs = array($m_date, $time, $description, $duration,$old_date,$old_time);
$sql = "UPDATE meeting_info SET m_date=? ,time=? ,description=? , duration=? WHERE m_date=? AND time=?";
$stmt=$db->prepare($sql);
$stmt->execute($inputs);



  
header('Location:meeting_info.php')
?>