<?php session_start(); ?>
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
		
		

			
		
		<div class='row custom-table-width'style='  '>
			
			<table class='table table-striped table-responsive'>
				
		    	<thead>
			    	<tr>
				      	<th scope='col'>ID</th>
				      	<th scope='col'>name</th>
				      	<th scope='col'>school</th>
						<th scope='col'>field</th>
				      	<th scope='col'>status</th>
				      	<th scope='col'></th>
				      	<th scope='col'></th>
				      	<th scope='col'></th>
				      	<th scope='col'></th>
			    	</tr>
		  		</thead>
		
	
		
	
	</div>
	
	<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
	
	
    ";
    
    $query = ("select * from student");
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
		$status=$this_row['status'];
		
    	echo"<tr>";
    	echo"<form class='form-group' action='student_modify.php' method='get'>";
    	if(isset($_SESSION['account']) && $_SESSION['account'])
		{
			echo "<script>console.log('Debug account:" . $_SESSION['account'] . "' );</script>";
			echo "<script>console.log('Debug id:" . $this_row['ID'] . "' );</script>";
			if(isset($_SESSION['status']) && $_SESSION['status'])
			echo "<script>console.log('Debug status:" . $_SESSION['status'] . "' );</script>";
			if(($_SESSION['account']==$this_row['ID']&&$_SESSION['status']!=3)||($_SESSION['status']==3&&$this_row['status']<3))//自己跟管理員可以修改資料
			{
				echo"<th scope='row'><input class='form-control form-control-sm' type='text' name='m_ID' value=".$id_tmp." ></th>";
		      	echo"<td ><input class='form-control form-control-sm' type='text' name='m_name' value=".$name_tmp." ></td>";
		      	echo"<td ><input class='form-control form-control-sm' type='text' name='m_school' value=".$school_tmp."></td>";
				echo"<td ><input class='form-control form-control-sm' type='text' name='m_field' value=".$field_tmp." ></td>";
				switch($this_row['status'])
				{
					case 0:echo"<td >學生</td>";break;
					case 1:echo"<td >討論者</td>";break;
					case 2:echo"<td >老師</td>";break;
					case 3:echo"<td >管理員</td>";break;
				}
				echo"<input type='hidden' name='ID' value=".$this_row['ID'].">";
		      	echo"<td><input class='btn btn-outline-warning btn-sm ' type='submit' name='modify' value='修改'></td>";
		      	//echo"</td>";
		      	

			}
			else
			{
				echo"<th scope='row'>".$id_tmp."</th>";
		      	echo"<td >".$name_tmp."</td>";
		      	echo"<td >".$school_tmp."</td>";
				echo"<td >".$field_tmp."</td>";
				switch($this_row['status'])
				{
					case 0:echo"<td >學生</td>";break;
					case 1:echo"<td >討論者</td>";break;
					case 2:echo"<td >老師</td>";break;
					case 3:echo"<td >管理員</td>";break;
				}
				echo"<td></td>";
				//echo"<td></td>";
			}
			echo"</form>";
			if($_SESSION['status']==3&&$this_row['status']<3)
		      	{
		      		echo"<form class='form-group ' action='student_delsave.php' method='get'>";

		      		echo"<input type='hidden' name='ID' value=".$this_row['ID'].">";
		      		
					echo"<td><input class='btn btn-outline-danger btn-sm ' type='submit' name='X' value='刪除'></td>";
					echo"</form>";
				}
			else
			{
				echo"<td><input class='btn btn-outline-danger btn-sm ' disabled type='submit' name='X' value='刪除'></td>";
			}
			if($_SESSION['status']>0)
				{
					echo"<form class='form-group' action='student_modify.php' method='get'>";
					echo"<input type='hidden' name='ID' value=".$this_row['ID'].">";
					echo"<input type='hidden' name='name' value=".$this_row['name'].">";
					echo"<input type='hidden' name='school' value=".$this_row['school'].">";
					echo"<input type='hidden' name='field' value=".$this_row['field'].">";
					echo"<input type='hidden' name='status' value=".$this_row['status'].">";
					if($_SESSION['status']>$this_row['status'])
						{
							echo"<td><input class='btn btn-outline-success btn-sm ' type='submit' name='up_status' value='升級'></td>";
							if($this_row['status']>0)
							{echo"<td><input class='btn btn-outline-dark btn-sm ' type='submit' name='down_status' value='降級'></td>";}
							else
							{echo"<td><input class='btn btn-outline-dark btn-sm ' disabled type='submit' name='down_status' value='降級'></td>";}
						}
					else
						{
							echo"<td><input class='btn btn-outline-success btn-sm ' disabled type='submit' name='up_status' value='升級'></td>";
							echo"<td><input class='btn btn-outline-dark btn-sm ' disabled type='submit' name='down_status' value='降級'></td>";
						}
					echo"</form>";
					
				}
		}
      	

      	
				
		
      	//echo"<td ><button type='button' class=' btn btn-outline-danger btn-sm '>X</button></td>";
    	echo"</tr>";
  		

      

       
    }
    		echo"</tbody>";
		echo"</table>";
    echo "</div>";
echo "</div>
</div>";


?>