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
		
		

			
	
		<div class='col custom-table-width'style='  '>
			<div class='row'>
				<div class='button_student_add'>
					
						<form  action='student_add.php' method='get'>
							
						</form>
					
				</div>
			</div>
			<table class='table table-striped table-responsive'>
				
		    	<thead>
			    	<tr>
				      	<th scope='col'>ID</th>
				      	<th scope='col'>name</th>
				      	<th scope='col'>school</th>
						<th scope='col'>field</th>
				      	
			    	</tr>
		  		</thead>
		
	
		
	
	</div>
	
	<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
	
	
    ";
    
    $query = ("select * from teacher");
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
    	$id_tmp=$this_row['ID'];
    	$name_tmp=$this_row['name'];
    	$school_tmp=$this_row['school'];
		$field_tmp=$this_row['field'];
    	echo"<tr>";
    	echo"<td><form class='form-group' action='teacher_modify.php' method='get'>";
      	echo"<th scope='row'><input class='form-control form-control-sm' type='text' name='m_ID' value=".$id_tmp." ></th>";
      	echo"<td ><input class='form-control form-control-sm' type='text' name='m_name' value=".$name_tmp." ></td>";
      	echo"<td ><textarea name='m_school' class='form-control'   aria-label='With textarea' >".$school_tmp."</textarea></td>";
		echo"<td ><input class='form-control form-control-sm' type='text' name='m_field' value=".$field_tmp." ></td>";

      	echo"<input type='hidden' name='ID' value=".$this_row['ID'].">";
      	echo"<td><input class='btn btn-outline-warning btn-sm ' type='submit' name='modify' value='修改'></td>";
      	echo"</td></form>";
      	echo"<td ><form class='form-group ' action='teacher_delsave.php' method='get'>

	      		<input type='hidden' name='ID' value=".$this_row['ID'].">
	      		
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