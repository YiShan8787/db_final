<?php
    include_once "db_conn.php";

    echo 
	"
	<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	<link rel='stylesheet' href='style.css'>
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

    <title>meetingDB</title>
	</head>
	
	<style>
		.col-auto
		{
			margin:5px;
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
	
	<div class='container'>
  		<div class='row align-items-center justify-content-center'>
            <div class='col-auto'> 
			    <form action='meeting_info.php' method='get'>
					<input class = 'btn btn-outline-info btn-sm' type='submit' name='開會資訊' value='開會資訊'>
				</form>
			</div>
			<div class='col-auto'>
				<form action='teacher.php' method='get'>
					<input class = 'btn btn-outline-info btn-sm' type='submit' name='老師資訊' value='老師資訊'>
				</form>
			</div>
			<div class='col-auto '>
				<form action='student.php' method='get'>
					<input class = 'btn btn-outline-info btn-sm' type='submit' name='學生資訊' value='學生資訊'>
				</form>
			</div>
			<div class='col-auto '>
				<form action='inform.php' method='get'>
					搜尋<input type='text' name='關鍵字' >
				</form>
			</div>
		</div>
		
		

			
		
		<div class='col custom-table-width'style='  '>
			<div class='px-3 row'>
				<div class='button_meeting_add'>
					
						<form  action='meeting_add.php' method='get'>
							<input class='btn btn-outline-secondary' type='submit' name='add' value='add'>
						</form>
					
				</div>
			</div>
			<table class='table table-striped table-responsive'>
				
		    	<thead>
			    	<tr>
				      	<th scope='col'>Date</th>
				      	<th scope='col'>Time</th>
				      	<th scope='col'>Description</th>
						<th scope='col'>Duration</th>
						<th scope='col'>Announcer</th>
						<th scope='col'></th>

				      	<th scope='col'></th>
			    	</tr>
		  		</thead>
		
	
		
	
	</div>
	
	<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
	
	
    ";
    
    $query = ("select * from meeting_info");
    $stmt = $db->prepare($query);
    $stmt -> execute();
    $result = $stmt -> fetchAll();
    echo"<tbody >";
    foreach($result as $this_row)
    {
    	//echo"<table class='table table-striped'>";
    	/*echo"<thead>";
    	echo"<tr>";
      	echo"<th scope='col'>".$this_row['date']."</th>";
      	echo"<th scope='col'>".$this_row['time']."</th>";
      	echo"<th scope='col'>".$this_row['description']."</th>";
      	echo"<th scope='col'>".$this_row['duration']."</th>";
    	echo"</tr>";
  		echo"</thead>";*/
  		
  	

  	/*switch($this_row['importance'])//邱:不要刪
    	{
    		case 0:echo"<tr style='background-color:#ff8a8a'>";break;
    		case 1:echo"<tr style='background-color:#faf8b6'>";break;
    		case 2:echo"<tr style='background-color:#cbffbf'>";break;
    		case 3:echo"<tr style='background-color:#9eecff'>";break;
    		case 4:echo"<tr style='background-color:#9eecff'>";break;
    	}
    */
    	$d=$this_row['m_date'];
    	$t=$this_row['time'];
    	$d1=$this_row['description'];
		$d2=$this_row['duration'];
		//$d3=$this_row['announcer'];
		echo"<form class='form-group' action='meeting_modify.php' method='get'>";
    	echo"<tr>";
    	//echo"<td><form class='form-group' action='meeting_modify.php' method='get'>";
      	echo"<td scope='row'><input class='form-control form-control-sm' type='text' name='m_m_date' value=".$d." ></td>";
      	echo"<td ><input class='form-control form-control-sm' type='text' name='m_time' value=".$t." ></td>";
      	echo"<td ><textarea name='m_description2' class='form-control'   aria-label='With textarea' >".$d1."</textarea></td>";
		echo"<td ><input class='form-control form-control-sm' type='text' name='m_duration' value=".$d2." ></td>";
		//echo"<td ><input class='form-control form-control-sm' type='text' name='m_announcer' value=".$d3." ></td>";
      	echo"<input type='hidden' name='m_date' value=".$this_row['m_date'].">";
      	echo"<input type='hidden' name='time' value=".$this_row['time'].">";
      	echo"<td><input class='btn btn-outline-warning btn-sm ' type='submit' name='modify' value='修改'></td>";
		//echo"</td></form>";
		echo"</form>";  
      	echo"<td ><form class='form-group ' action='meeting_delsave.php' method='get'>

	      		<input type='hidden' name='m_date' value=".$this_row['m_date'].">
	      		<input type='hidden' name='time' value=".$this_row['time'].">
				<input class='btn btn-outline-danger btn-sm ' type='submit' name='X' value='刪除'>
				</form></td>";
		
      	//echo"<td ><button type='button' class=' btn btn-outline-danger btn-sm '>X</button></td>";
    	echo"</tr>";
  		

      

       
    }
    		echo"</tbody>";
		echo"</table>";
    echo "</div>";
echo "</div>
</div>";


?>