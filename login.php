
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name = "viewport" content = "width = device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>登入</title>
</head>

<style>
   @media screen and (min-width:850px){
       [class = "row justify-content-center border border-gray rounded mx-auto p-5"]{
        width:50%;
       }   
    }
</style>

<body>
    <div class = "container p-3">
        <div class = "row-auto row justify-content-start">
            <div class = "col-md-auto col-sm-auto">
                <a class = "btn btn-md btn-outline-primary" href = "index.php" role = "button">回首頁</a>
            </div>            
        </div>
    <div class = "container p-3">        
        <form name="login" action="login.php" method="post">
            <div class = "row justify-content-center border border-gray rounded mx-auto p-5" style = "margin-top:100px;">
            
                <div class = "col-md-auto">
                    <h1>登入</h1>
                </div>
                <!--<div class = "w-100"></div>
                <div class = "col-md-auto" style = "margin-right:100px;">
                    <span class = "font-weight-light">使用者名稱:</span>
                </div>-->
                <div class = "w-100"></div>
                <div class = "col-md-10">
                    <div class = "m-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "px-0 input-group-text font-weight-light" id = "username">使用者名稱:</span>
                        </div>
                        <input type=text class = "form-control" name="account" aria-label = "username" aria-describedby = "username">
                    </div>
                </div>
                <!--<div class = "w-100"></div>
                <div class = "col-md-auto" style = "margin-right:141px;">
                    <span class = "font-weight-light">密 碼:</span>
                </div>-->
                <div class = "w-100"></div>
                <div class = "col-md-10">
                    <div class = "m-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "px-4 input-group-text font-weight-light" id = "password">密碼:</span>
                        </div>
                        <input type=password class = "form-control" name="password" aria-label = "password" aria-describedby = "password">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto" style = "margin-top:5px;">
                    <input class = "btn btn-primary" type="submit" name="submit" value="登入">
                </div>
            </div>        
        </form>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php session_start(); ?>
<?PHP

include_once "db_conn.php";

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
    //echo "請按下登入";
    exit();
}//檢測是否有submit操作 
//以下要改
if ( !isset($_POST['account']) && !isset($_POST['password']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill both the username and password field!');
}
$account = $_POST['account'];//post獲得使用者名稱錶單值
$passowrd = $_POST['password'];//post獲得使用者密碼單值
if ($account && $passowrd)
{//如果使用者名稱和密碼都不為空
    $query = "select * from student where ID = '$account' and password='$passowrd'";//檢測資料庫是否有對應的account和password的sql
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchALL(PDO::FETCH_ASSOC); //PDO::FETCH_CLASS 返回一個物件，以欄位名稱設定屬性，並把設值給該屬性
    foreach($result as $row)
    {//判斷查到的每組資訊
        foreach($row as $key => $value)
        {
            //echo $key." : ".$value."<br />";
            if($key == "account")
            {
                if($value ==$account)
                    echo "帳號正確<br>";
                else
                {
                    echo "帳號錯誤";
                    echo "
                    <script>
                    setTimeout(function(){window.location.href='login.php';},1000);
                    </script>
                    ";//如果錯誤使用js 1秒後跳轉到登入頁面重試;
                    exit();
                }
            }
            if($key == "password")
            {
                if($value ==$passowrd)
                {
                    echo "密碼正確<br>";
                    
                }
                else
                {
                    echo "密碼錯誤";
                    echo "
                    <script>
                    setTimeout(function(){window.location.href='login.php';},1000);
                    </script>
                    ";//如果錯誤使用js 1秒後跳轉到登入頁面重試;
                    exit();
                }
            }
            if($key == "status")
            {

                $_SESSION['status'] = $value;
                 echo "<script>console.log('Debug status:" . $_SESSION['status'] . "' );</script>";
            }
        }
        //成功就跳轉
        $_SESSION['account'] = $account;
        //is_online =1
        $query = "UPDATE student SET is_online= 1 where ID = $account";
		$stmt=$db->prepare($query);
		$stmt->execute();
        $result=$stmt->fetchALL();
        
        echo "返回主頁中.....";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        if($_SESSION['table'] == 'meeting_info')
        {
            echo '<meta http-equiv=REFRESH CONTENT=5;url=meeting_info.php>';
        }
        else
        {
            //header("location:meeting_info.php/?error=登入成功");
            echo '<meta http-equiv=REFRESH CONTENT=5;url=index.php>';
        }        
    }
}
else
{//如果使用者名稱或密碼有空
    echo "表單填寫不完整";
    echo "
    <script>
    setTimeout(function(){window.location.href='login.php';},5000);
    </script>";
    //如果錯誤使用js 1秒後跳轉到登入頁面重試;
}
?>