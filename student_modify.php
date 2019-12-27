<?php session_start(); ?>
<?php
    include_once "db_conn.php";
$old_ID=$_GET["ID"];


//$inputs = array(':m_date' => $m_date,':time' => $time,':description' => $description,':duration' => $duration);
//$sql = "UPDATE meeting_info SET m_date=':m_date' ,time=':time' ,description=':description' , duration=':duration' WHERE m_date='$old_date' AND time='$old_time'";
if(isset($_GET['modify']))
{
	$ID=$_GET["m_ID"];
	$name=$_GET["m_name"];
	$school=$_GET["m_school"];
	$field=$_GET["m_field"];
	$_SESSION['account']=$_GET["m_ID"];

	$inputs = array($ID, $name, $school, $field,$old_ID);
	$sql = "UPDATE student SET ID=? ,name=? ,school=? , field=? WHERE ID=? ";
	$stmt=$db->prepare($sql);
	$stmt->execute($inputs);
}
if(isset($_GET['up_status']))
{
	$status=$_GET["status"];
	$name=$_GET["name"];
	$school=$_GET["school"];
	$field=$_GET["field"];
	$status++;
	if($status==2)
	{
		$query=("insert into teacher values(?,?,?,?)");
		$stmt=$db->prepare($query);
		$stmt->execute(array($old_ID,$name,$school,$field));
	}
	$inputs = array($status,$old_ID);
	$sql = "UPDATE student SET status=?  WHERE ID=? ";
	$stmt=$db->prepare($sql);
	$stmt->execute($inputs);
}
if(isset($_GET['down_status']))
{
	$status=$_GET["status"];
	$name=$_GET["name"];
	$school=$_GET["school"];
	$field=$_GET["field"];
	if($status==2)
	{
		$query=("DELETE FROM teacher WHERE ID='$old_ID' " );
	    $stmt=$db->prepare($query);
	    $stmt->execute();
	    $result=$stmt->fetchAll();
	}
	$status--;
	$inputs = array($status,$old_ID);
	$sql = "UPDATE student SET status=?  WHERE ID=? ";
	$stmt=$db->prepare($sql);
	$stmt->execute($inputs);
}


  
header('Location:student.php')
?>