<?php session_start(); ?>
<!doctype html>
<html lang="zn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel='stylesheet' href='style.css'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>meetingDB</title>
  </head>

  <style>
.table th
{
width: 30vw;
}
.btn
{
margin: 5px;
}
body
{

	background-image: url('bg.jpg');
	 background-repeat: no-repeat;
	  background-attachment: fixed;
  background-size: cover;
  background-blend-mode: lighten;
  background-color: rgba(255,255,255,0.5);
    
}
.container
{
}
</style>

  <body >
  	<div class="container" >
  		<div class="row align-items-center justify-content-center" >
            <div class="col-auto ">
			    <form action="meeting_info.php" method="get">
					<input class = "btn btn-outline-info btn-sm" type="submit" name="開會資訊" value="開會資訊">
				</form>
			</div>
			<div class="col-auto ">
				<form action="teacher.php" method="get">
					<input class = "btn btn-outline-info btn-sm" type="submit" name="老師資訊" value="老師資訊">
				</form>
			</div>
			<div class="col-auto mr-auto">
				<form action="student.php" method="get">
					<input class = "btn btn-outline-info btn-sm" type="submit" name="學生資訊" value="學生資訊">
				</form>
			</div>
			
			<?php
			include_once "db_conn.php";
			echo'<div class="col-auto">';
				echo "<p>目前登入人數:";
					$query = "select count(*) from student where is_online=1";
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchALL(PDO::FETCH_COLUMN, 0);
					echo "$result[0]";
					//print_r($result);
					//echo "$result[0][count(*)][0]";
				echo "</p>
				</div>";
			
			if(!isset($_SESSION['account'])) //若不存在此變數，代表沒登入 
			{
				echo'
				<div class="col-auto">
					<a class="btn btn-primary" href="login.php" >登入</a>
				</div>
				<div class="col-auto">
					<a class="btn btn-primary" href="register.php" >註冊</a>
				</div>';
			}
			else if(isset($_SESSION['account'])==null)
			{
				echo'
				<div class="col-auto">
					<a class="btn btn-primary" href="login.php" >登入</a>
				</div>
				<div class="col-auto">
					<a class="btn btn-primary" href="signup.php" >註冊</a>
				</div>';
			}

			else{
				echo'
				<div class="col-auto">
					<a class="btn btn-primary" href="logout.php" >登出</a>
				</div>';
			}
			
			?>
			
		</div>
		<div class="row align-items-center justify-content-center" style="margin-top: 10px;">
			<form action="" method="get" >
				<div class="col-auto"style="display:inline-block;" style="margin: 5px">
					<div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle btn-sm  " id="dropsearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
						    選擇資訊
						  </button>
						  <div class="dropdown-menu">
						    <a href="javascript:func1(0);" class="dropdown-item" type="get" name="searchfor" value="All" >全部資訊</a>	
							<a href="javascript:func1(1);" class="dropdown-item" type="get" name="searchfor" value="meetingInfo" >開會資訊</a>
							<a href="javascript:func1(2);" class="dropdown-item" type="get" name="searchfor" value="teacherInfo" >老師資訊</a>			
							<a href="javascript:func1(3);" class="dropdown-item" type="get" name="searchfor" value="studentInfo" >學生資訊</a>				
						  </div>
					</div>
				</div>
				
				<div class="col-auto " style="margin-left: -20px;display:inline-block;">
					    <input type="hidden" name="searchfor" id="searchfor" value="">
						<input type="text" name="keywords" >
						<input type="submit" name="searchButton" value="search">
					
				</div>
				<br/>
			</form>
			<?php 
				include_once "db_conn.php";
				if(isset($_GET['searchButton']) && $_GET['searchButton'] == 'search')
				{	
					echo "<script>console.log('searchButton is clicked' );</script>";
					$searchfor=$_GET["searchfor"];
					echo "<script>console.log('".$searchfor."');</script>";
					$searchvalue=$_GET["keywords"];
					//echo "<script>console.log('$searchfor:".$searchfor."' );</script>";
					//echo "<script>console.log('$searchfor:".$searchvalue."' );</script>";
					echo"
						<table class='table table-striped table-responsive'>
			    		<thead>
				    	<tr>";
					if($searchfor=='All')
					{
						echo "<script>console.log('0' );</script>";
						$query=("select * from meeting_info as a LEFT JOIN student as b on a.announcer = b.ID where m_date Like '%".$searchvalue."%' OR time Like '%".$searchvalue."%' OR description Like '%".$searchvalue."%' OR duration Like '%".$searchvalue."%' OR ID Like '%".$searchvalue."%' OR name Like '%".$searchvalue."%' OR school Like '%".$searchvalue."%' OR field Like '%".$searchvalue."%'");
				      	echo"<th scope='col'>Date</th>";
				      	echo"<th scope='col'>Time</th>";
				      	echo"<th scope='col'>Description</th>";
				      	echo"<th scope='col'>Duration</th>";
				      	echo"<th scope='col'>Announcer ID</th>";
				      	echo"<th scope='col'>Announcer name</th>";
				      	echo"<th scope='col'>Announcer school</th>";
				      	echo"<th scope='col'>Announcer field</th>";
					}
					else if($searchfor=='meetingInfo')
					{
						echo "<script>console.log('1' );</script>";
						$query=("select * from meeting_info where m_date Like '%".$searchvalue."%' OR time Like '%".$searchvalue."%' OR description Like '%".$searchvalue."%' OR duration Like '%".$searchvalue."%' OR announcer Like '%".$searchvalue."%'");
				      	echo"<th scope='col'>Date</th>";
				      	echo"<th scope='col'>Time</th>";
				      	echo"<th scope='col'>Description</th>";
				      	echo"<th scope='col'>Duration</th>";
				      	echo"<th scope='col'>Announcer ID</th>";
					}
					else if($searchfor=='teacherInfo')
					{
						echo "<script>console.log('2' );</script>";
						$query=("select * from teacher where name Like '%".$searchvalue."%' OR ID Like '%".$searchvalue."%' OR school Like '%".$searchvalue."%' OR field Like '%".$searchvalue."%'");
						echo"<th scope='col'>ID</th>";
				      	echo"<th scope='col'>Name</th>";
				      	echo"<th scope='col'>School</th>";
				      	echo"<th scope='col'>Field</th>";
					}
					else if($searchfor=='studentInfo')
					{
						echo "<script>console.log('3' );</script>";
						$query=("select * from student where name Like '%".$searchvalue."%' OR ID Like '%".$searchvalue."%' OR school Like '%".$searchvalue."%' OR field Like '%".$searchvalue."%'");
						echo"<th scope='col'>ID</th>";
				      	echo"<th scope='col'>Name</th>";
				      	echo"<th scope='col'>School</th>";
				      	echo"<th scope='col'>Field</th>";
					}
			      	echo"</tr>";
			      	echo"</thead>";

					$stmt = $db->prepare($query);
					$stmt -> execute();
					$result = $stmt -> fetchAll();
					echo"<tbody>";
					foreach($result as $this_row)
					{
						if($searchfor=='meetingInfo')
						{		
							echo"<tr>";
					      	echo"<th scope='row'>".$this_row['m_date']."</th>";
					      	echo"<td >".$this_row['time']."</td>";
					      	echo"<td >".$this_row['description']."</td>";
					      	echo"<td >".$this_row['duration']."</td>";
					      	echo"<td >".$this_row['ID']."</td>";
					    	echo"</tr>";				    	
						}
						else if($searchfor=='All')
						{
							echo "<tr>";
							echo "<th scope = 'row'>".$this_row['m_date']."</th>";
							echo "<td >".$this_row['time']."</td>";
							echo "<td >".$this_row['description']."</td>";
							echo "<td >".$this_row['duration']."</td>";
							echo "<td >".$this_row['ID']."</td>";
							echo "<td >".$this_row['name']."</td>";
							echo "<td >".$this_row['school']."</td>";
							echo "<td >".$this_row['field']."</td>";
					    	echo"</tr>";
						}
						else if($searchfor=='teacherInfo')
						{	
							echo"<tr>";
					      	echo"<th scope='row'>".$this_row['ID']."</th>";
					      	echo"<td >".$this_row['name']."</td>";
					      	echo"<td >".$this_row['school']."</td>";
					      	echo"<td >".$this_row['field']."</td>";
					    	echo"</tr>";	
						}
						else if($searchfor=='studentInfo')
						{	
							echo"<tr>";
					      	echo"<th scope='row'>".$this_row['ID']."</th>";
					      	echo"<td >".$this_row['name']."</td>";
					      	echo"<td >".$this_row['school']."</td>";
					      	echo"<td >".$this_row['field']."</td>";
					    	echo"</tr>";    	
						}
					}
					echo"</tbody>";
					echo"</table>";
			}
			else
			{
				echo "<script>console.log('!!searchButton is NOT clicked' );</script>";
				echo "</div>";
				
				echo"
				<table class='table table-striped table-responsive'>
					
			    	<thead>
				    	<tr>
					      	<th scope='col'>Date</th>
					      	<th scope='col'>Time</th>
					      	<th scope='col'>Description</th>
					      	<th scope='col'>Duration</th>
					      	<th scope='col'>Announcer</th>
				    	</tr>
			  		</thead>";
		  			$query = ("select * from meeting_info");
				    $stmt = $db->prepare($query);
				    $stmt -> execute();
				    $result = $stmt -> fetchAll();
				    echo"<tbody >";
				    foreach($result as $this_row)
				    {
				  	/*switch($this_row['importance'])//邱:不要刪
				    	{
				    		case 0:echo"<tr style='background-color:#ff8a8a'>";break;
				    		case 1:echo"<tr style='background-color:#faf8b6'>";break;
				    		case 2:echo"<tr style='background-color:#cbffbf'>";break;
				    		case 3:echo"<tr style='background-color:#9eecff'>";break;
				    		case 4:echo"<tr style='background-color:#9eecff'>";break;
				    	}
				    */
				    	echo"<tr>";
				      	echo"<th scope='row'>".$this_row['m_date']."</th>";
				      	echo"<td >".$this_row['time']."</td>";
				      	echo"<td >".$this_row['description']."</td>";
				      	echo"<td >".$this_row['duration']."</td>";
				      	echo "<td >".$this_row['announcer']."</td>";
				    	echo"</tr>";
				    }
				    echo"</tbody>";
				echo"</table>";
				//echo "<div>";
			}
			?>
			
				
			
			

	
	<script>
		function func1(searchfor)
		{
			console.log(searchfor);
			switch(searchfor)
			{
				case 0:$("#dropsearch").html('全部資訊');$("#searchfor").val('All');break;
				case 1:$("#dropsearch").html('開會資訊');$("#searchfor").val('meetingInfo');break;
				case 2:$("#dropsearch").html('老師資訊');$("#searchfor").val('teacherInfo');break;
				case 3:$("#dropsearch").html('學生資訊');$("#searchfor").val('studentInfo');break;
			}
			
		}
	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>