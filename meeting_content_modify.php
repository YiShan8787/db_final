<?php
    include_once "db_conn.php";
$old_date=$_GET["m_date"];
$old_time=$_GET["time"];
$m_date=$_GET["m_m_date"];
$time=$_GET["m_time"];
$detail=$_GET["m_detail"];
$place=$_GET["m_place"];
echo "<script>console.log('Debug 0Objects: " . $old_date . "' );</script>";
echo "<script>console.log('Debug 0Objects: " . $old_time . "' );</script>";
echo "<script>console.log('Debug Objects: " . $m_date . "' );</script>";
echo "<script>console.log('Debug Objects: " . $time . "' );</script>";
echo "<script>console.log('Debug Objects: " . $place . "' );</script>";
echo "<script>console.log('Debug Objects: " . $detail . "' );</script>";
//$inputs = array(':m_date' => $m_date,':time' => $time,':description' => $description,':duration' => $duration);
//$sql = "UPDATE meeting_info SET m_date=':m_date' ,time=':time' ,description=':description' , duration=':duration' WHERE m_date='$old_date' AND time='$old_time'";
$inputs = array($m_date, $time, $place, $detail,$old_date,$old_time);
$sql = "UPDATE meeting_content SET m_date=? ,time=? ,place=? , detail=? WHERE m_date=? AND time=?";
$stmt=$db->prepare($sql);
$stmt->execute($inputs);



  
header('Location:meeting_content.php')
?>