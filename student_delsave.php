<?php
    include_once "db_conn.php";
	$ID = $_GET['ID'];
	

	echo "<script>console.log('Debug Objects: 1' );</script>";
	//$db_link=mysqli_connect("localhost","root","",'db_meeting') or die("無法連接".mysqli_error());
    echo "<script>console.log('ID:" . $ID . "' );</script>";
   
    $query=("select * from student");
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    /*for($i=0;$i<count($result);$i++)
    {
    	echo "<script>console.log('Debug Objects: date:" . $result[$i]["m_date"] . "' );</script>";
    	echo "<script>console.log('Debug Objects: time:" . $result[$i]["time"] . "' );</script>";
    }*/

	$query=("DELETE FROM student WHERE ID = '$ID'" );
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    //$sql_query = "DELETE FROM 'meeting_info' WHERE 'meeting_info'.'duration'=2";
    //$del = mysqli_query($db_link,$query)or die ("無法刪除".mysqli_error($db_link));
	//echo "<script>console.log('Debug Objects: date:" . $del . "' );</script>";

	echo "<script>console.log('after delete' );</script>";
	 $query=("select * from student");
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    /*for($i=0;$i<count($result);$i++)
    {
    	echo "<script>console.log('Debug Objects: date:" . $result[$i]["m_date"] . "' );</script>";
    }*/
	
	//echo"刪除成功";
    //mysqli_close($db_link);

    header("Location: student.php");
?>