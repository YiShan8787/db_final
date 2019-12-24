<?php
    include_once "db_conn.php";
    $m_date = $_GET['m_date'];
    $time=$_GET['time'];

    echo "<script>console.log('Debug Objects: 1' );</script>";
    //$db_link=mysqli_connect("localhost","root","",'db_meeting') or die("無法連接".mysqli_error());
    echo "<script>console.log('date:" . $m_date . "' );</script>";
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

    $query=("DELETE FROM meeting_info WHERE m_date='$m_date' AND time='$time'" );
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll();
    //$sql_query = "DELETE FROM 'meeting_info' WHERE 'meeting_info'.'duration'=2";
    //$del = mysqli_query($db_link,$query)or die ("無法刪除".mysqli_error($db_link));
    //echo "<script>console.log('Debug Objects: date:" . $del . "' );</script>";

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
    //mysqli_close($db_link);

    header("Location: meeting_edit.php");
?>