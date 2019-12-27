<?php
    include_once "db_conn.php";

    echo 
	"
	<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
     
  	<script src='//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js'></script>

  	<link href='air-datepicker-master/air-datepicker-master/dist/css/datepicker.min.css' rel='stylesheet' type='text/css'>
    <script src='air-datepicker-master/air-datepicker-master/dist/js/datepicker.min.js'></script>
    <!-- Include English language -->
    <script src='air-datepicker-master/air-datepicker-master/dist/js/i18n/datepicker.en.js'></script>



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
	
		<div class='row'>
			<div class='col'>
				<form action='meeting_addsave.php' method='post'>
					<label for='date'>時間</label></br>
				<input type='text'
				name='time'
					data-range='true'
					data-multiple-dates-separator=' - '
					data-language='en'
					data-timepicker='true' data-time-format='hh:ii aa'
					class='datepicker-here'
				autocomplete='off'/>
				
				<div class='form-group'>
			    <label for='place'>地點</label></br>
			    <input type='text' name='place' class='form-control col-sm-2' />

			  </div>
			  <div class='form-group'>
			  	<label for='place'>主辦人</label></br>
			  	<button type='button' class='btn btn-primary dropdown-toggle btn-sm  '' id='droptxt' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' >主講人</button>
				  <div class='dropdown-menu'>
				  ";
				  $query=("select * from teacher ");
					$stmt = $db->prepare($query);
					$stmt -> execute();
					$result = $stmt -> fetchAll();
					foreach($result as $this_row)
					{
						$ID=$this_row['ID'];
						$name=$this_row['name'];
						echo"<a href='javascript:func1(".$ID.",".$name.");' class='dropdown-item' type='get' name='selectName' value='' >".$name."</a>";	
						
						
					}	
				echo"<script>
						function func1(ID,tname)
						{
							$('#droptxt').html(tname);$('#teacherName').val(ID);
							
						}
					</script>";					
				 echo"
				  </div>
			  </div>
			  <div class='form-group'>
			    <label for='description'>標題</label></br>
			    <textarea name='description' class='form-control' aria-label='With textarea'></textarea>

			  </div>
			  <div class='form-group'>
			    <label for='detail'>描述</label></br>
			    <textarea name='detail' class='form-control' aria-label='With textarea'></textarea>

			  </div>
			  <div class='form-group'>
			    <label for='description'>時間長度</label></br>
			    <input type='text' name='duration' class='form-control col-sm-2' />

			  </div>
			  <input type='hidden' name='teacherName' id='teacherName' value=''>
				<button type='submit' class='btn btn-primary'>Submit</button>
				</form>
			</div>
		</div>
	</div>
	<script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
	

 ";
?>