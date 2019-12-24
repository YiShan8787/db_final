<?php
    include_once "db_conn.php";
$old_ID=$_GET["ID"];
$ID=$_GET["m_ID"];
$name=$_GET["m_name"];
$school=$_GET["m_school"];
$field=$_GET["m_field"];

//$inputs = array(':m_date' => $m_date,':time' => $time,':description' => $description,':duration' => $duration);
//$sql = "UPDATE meeting_info SET m_date=':m_date' ,time=':time' ,description=':description' , duration=':duration' WHERE m_date='$old_date' AND time='$old_time'";
$inputs = array($ID, $name, $school, $field,$old_ID);
$sql = "UPDATE teacher SET ID=? ,name=? ,school=? , field=? WHERE ID=? ";
$stmt=$db->prepare($sql);
$stmt->execute($inputs);



  
header('Location:teacher.php')
?>