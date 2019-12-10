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
	
	
	<div class='container'>
  		<div class='row '>
            <div class='col-auto '>
			    <form action='meeting_info.php' method='get'>
					<input type='submit' name='開會資訊' value='開會資訊'>
				</form>
			</div>
			<div class='col-auto '>
				<form action='teacher.php' method='get'>
					<input type='submit' name='老師資訊' value='老師資訊'>
				</form>
			</div>
			<div class='col-auto '>
				<form action='student.php' method='get'>
					<input type='submit' name='學生資訊' value='學生資訊'>
				</form>
			</div>
			<div class='col-auto '>
				<form action='inform.php' method='get'>
					搜尋<input type='text' name='關鍵字' >
				</form>
			</div>
		</div>

		<br><br>

			
		</div>
	<div class='col custom-table-width'style='  '>
	
		<table class='table table-striped 'style='width:80%;margin-left:10%  '>
    	<thead>
    	<tr>
      	<th scope='col'>Date</th>
      	<th scope='col'>Time</th>
      	<th scope='col'>Discription</th>
      	<th scope='col'>Duration</th>
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
    	echo"<tr>";
      	echo"<th scope='row'>".$this_row['date']."</th>";
      	echo"<td >".$this_row['time']."</td>";
      	echo"<td >".$this_row['description']."</td>";
      	echo"<td >".$this_row['duration']."</td>";
    	echo"</tr>";
  		

      

       
    }
    echo"</tbody>";
  
		echo"</table>";
    echo "</div>";
echo "</div>";


?>