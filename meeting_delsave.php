<?php
    include_once "db_conn.php";
	$date = $_POST['m_date'];
	$time=$_POST['time'];

	echo "<script>console.log('Debug Objects: 1' );</script>";
	$db_link=mysqli_connect("localhost","root","") or die("無法連接".mysqli_error());
    echo "<script>console.log('date:" . $date . "' );</script>";
    echo "<script>console.log('time:" . $time . "' );</script>";
    $query=("select * from meeting_info");
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    for($i=0;$i<count($result);$i++)
    {
    	echo "<script>console.log('Debug Objects: date:" . $result[$i]["m_date"] . "' );</script>";
    	echo "<script>console.log('Debug Objects: time:" . $result[$i]["time"] . "' );</script>";
    }

	$query=("DELETE FROM meeting_info WHERE m_date='2019-12-03'" );
    $stmt=$db->prepare($query);
    $stmt->execute();
    //$result=$stmt->fetchAll();
    //$sql_query = "DELETE FROM meeting_info WHERE date = $date AND time=$time";
    //mysqli_query($db_link,$sql_query)or die ("無法刪除".mysqli_error());


	echo "<script>console.log('after delete' );</script>";
	 $query=("select * from meeting_info");
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    for($i=0;$i<count($result);$i++)
    {
    	echo "<script>console.log('Debug Objects: date:" . $result[$i]["m_date"] . "' );</script>";
    }
	
	//echo"刪除成功";
    mysqli_close($db_link);

    //header("Location: meeting_edit.php");
?>