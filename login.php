
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>登入</title>
</head>
<body>
<form name="login" action="login.php" method="post">
<p>使用者名稱<input type=text name="account"></p>
<p>密 碼<input type=password name="password"></p>
<p><input type="submit" name="submit" value="登入"></p>
</form>
</body>
</html>

<?php session_start(); ?>
<?PHP

include_once "db_conn.php";

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
    exit("請按下登入");
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