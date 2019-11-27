<?php
	include_once "db_conn.php";

	echo 
	"<table border = '1'>
	<tr>
	<th>ID</th>
	<th>name</th>
	<th>school</th>
	<th>field</th>
	</tr>";

	$query = ("select * from teacher");
	$stmt = $db->prepare($query);
	$stmt -> execute();
	$result = $stmt -> fetchAll();
	for($i=0;$i<count($result); $i++)
	{
		echo "<tr>";
		echo "<td>".$result[$i]['ID']."</td>";
		echo "<td>".$result[$i]['name']."</td>";
		echo "<td>".$result[$i]['school']."</td>";
		echo "<td>".$result[$i]['field']."</td>";
		echo "</tr>";
	}
	echo "</table>";

?>