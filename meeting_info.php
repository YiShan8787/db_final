<?php session_start(); ?>
<!doctype html>
<html lang="zn">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>meetingDB</title>
</head>
	
<style>
.table th
{
width: 25vh;
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
</style>

<body>
	<div class="container">	
  		<div class="row justify-content-start">

            <div class = "col-md-auto col-sm-auto">
                <a class = "btn btn-md btn-outline-primary" href = "index.php" role = "button">回首頁</a>
            </div>            
       
            <div class="col-auto" style="margin: 5px">
			    <form action="meeting_info.php" method="get">
					<input class = "btn btn-outline-info btn-sm" type="submit" name="開會資訊" value="開會資訊">
				</form>
			</div>
			<div class="col-auto" style="margin: 5px">
				<form action="teacher.php" method="get">
					<input class = "btn btn-outline-info btn-sm" type="submit" name="老師資訊" value="老師資訊">
				</form>
			</div>
			<div class="col-auto" style="margin: 5px">
				<form action="student.php" method="get">
					<input class = "btn btn-outline-info btn-sm" type="submit" name="學生資訊" value="學生資訊">
				</form>
			</div>
			<div class="col-auto mr-auto" style="margin: 5px">
				<form action="" method="get">
					<?php
					if(isset($_GET['keywords']))
					{
						if($_GET["keywords"]!="")
						{
							echo"<input type='text' name='keywords' value='".$_GET["keywords"]."' >";
						}
						else
						{
							echo"<input type='text' name='keywords' value='' >";
						}
					}
					else
						{
							echo"<input type='text' name='keywords' value='' >";
						}
					?>
					
					<input type="submit" name="searchButton" value="search">
				</form>
			</div>
			<?php
			if(isset($_SESSION['account']) && $_SESSION['account'])
			{
				echo '<div class = "col-auto" style="margin: 5px">
					 <a class="btn btn-primary" href="logout.php" >登出</a>
					 </div>';
			}
			if(!isset($_SESSION['account'])) //若不存在此變數，代表沒登入
			{
				echo"<div class = 'row align-items-end'>
						<div class='col-auto' style='margin: 5px'>
						<a class='btn btn-primary' href='login.php' >登入</a>
						</div>
					</div>";
				$_SESSION['table'] = 'meeting_info';
			}
			else if($_SESSION['account'] == null ) 
			{
				echo"
				<div class='row'>
					<div class = 'row align-items-end'>
						<div class='col-auto' style='margin: 5px'>
						<a class='btn btn-primary' href='login.php' >登入</a>
						</div>
					</div>
				</div>";
			}
			?>
		</div>			
	
		<div class="row custom-table-width"style="  ">
	
<?php
    include_once "db_conn.php";

	
	if(!isset($_SESSION['account'])) //若不存在此變數，代表沒登入
	{
		echo"<div class = 'row align-items-end'>
				<div class = 'col-auto text-center' style='margin: 5px'>
				you are not login
				</div>
			</div>";
		$_SESSION['table'] = 'meeting_info';
	}
	else if($_SESSION['account'] != null) 
	{
		echo"
		<div class='row'>
			<div class='col button_meeting_edit'style='width:80%;margin-left:10.85%'>";
		if(isset($_SESSION['status']) && $_SESSION['status']>0)	
			{
				echo"<form  action='meeting_edit.php' method='get'>
						<input class='btn btn-outline-secondary' type='submit' name='edit' value='edit'>
					</form>";
			}
			else
			{
				echo"<form  action='meeting_edit.php' method='get'>
						<input class='btn btn-outline-secondary' disabled type='submit' name='edit' value='edit'>
					</form>";
			}
		echo"	</div>
		</div>";
	}
		
				
		echo"
			<table class='table table-striped table-responsive'>
				
		    	<thead>
			    	<tr>
				      	<th scope='col'>Date</th>
				      	<th scope='col'>Time</th>
				      	<th scope='col'>Discription</th>
						<th scope='col' >Duration</th>
						<th scope='col'>Announcer</th> 
						<th scope='col'>Other</th> 
			    	</tr>
		  		</thead>
		";
	
		if(isset($_GET['searchButton']) && $_GET['searchButton'] == 'search')
				{	
					echo "<script>console.log('searchButton is clicked' );</script>";
					$searchvalue=$_GET["keywords"];
					$query=("select * from meeting_info where m_date Like '%".$searchvalue."%' OR time Like '%".$searchvalue."%' OR description Like '%".$searchvalue."%' OR duration Like '%".$searchvalue."%' OR announcer Like '%".$searchvalue."%'");
					$stmt = $db->prepare($query);
					$stmt -> execute();
					$result = $stmt -> fetchAll();
					echo"<tbody>";
					foreach($result as $this_row)
					{
							
							echo"<tr>";
					      	echo"<th scope='row'>".$this_row['m_date']."</th>";
					      	echo"<td >".$this_row['time']."</td>";
					      	echo"<td >".$this_row['description']."</td>";
							echo"<td >".$this_row['duration']."</td>";
							echo"<td >".$this_row['announcer']."</td>";  
							echo"<td ><form class='form-group ' action='meeting_content.php' method='get'>
					      		<input type='hidden' name='time' value=".$this_row['time'].">
					      		<input type='hidden' name='m_date' value=".$this_row['m_date'].">
								<input class='btn btn-outline-danger btn-sm ' type='submit' name='more' value='更多'>
								</form></td>";
					    	echo"</tr>";				    	
						
				
					}
			}
			else{
				    $query = ("select * from meeting_info");
				    $stmt = $db->prepare($query);
				    $stmt -> execute();
				    $result = $stmt -> fetchAll();
				    echo"<tbody >";
				    foreach($result as $this_row)
				    {
				    	$query2=("select * from student where ID=".$this_row['announcer']."");
						$stmt2 = $db->prepare($query2);
						$stmt2 -> execute();
						$result2 = $stmt2 -> fetchAll();
						foreach($result2 as $this_row2)
						{
							if(isset($this_row2['status']) )	
					  		{
						  		switch($this_row2['status'])//邱:不要刪
						    	{
						    		case 0:echo"<tr style='background-color:#d4feff'>";break;
						    		case 1:echo"<tr style='background-color:#d4feff'>";break;
						    		case 2:echo"<tr style='background-color:#ffdccc'>";break;
						    		case 3:echo"<tr style='background-color:#9eecff'>";break;
						    		case 4:echo"<tr style='background-color:#9eecff'>";break;
						    	}
						    }
						    else
						    {
						    	echo"<tr>";
						    }
						}
					    
					    
					    	//echo"<tr>";
					      	echo"<th scope='row'>".$this_row['m_date']."</th>";
					      	echo"<td >".$this_row['time']."</td>";
					      	echo"<td >".$this_row['description']."</td>";
							echo"<td >".$this_row['duration']."</td>";
							echo"<td >".$this_row['announcer']."</td>";
							echo"<td ><form class='form-group ' action='meeting_content.php' method='get'>
					      		<input type='hidden' name='time' value=".$this_row['time'].">
					      		<input type='hidden' name='m_date' value=".$this_row['m_date'].">
								<input class='btn btn-outline-danger btn-sm ' type='submit' name='more' value='更多'>
								</form></td>";
					    	echo"</tr>";
				    }
				}
				
    		echo"</tbody>";
		echo"</table>";
    echo "</div>";
echo "</div>";
echo"<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>"

?>

</div>
</body>
</html>