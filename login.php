<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>登陸</title>
</head>
<body>
<form name="login" action="login.php" method="post">
<p>使用者名稱<input type=text name="name"></p>
<p>密 碼<input type=password name="password"></p>
<p><input type="submit" name="submit" value="登入"></p>
</form>
</body>
</html>


<?PHP

include_once "db_conn.php";

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST["submit"])){
exit("錯誤執行");
}//檢測是否有submit操作 
//以下要改
$name = $_POST['account'];//post獲得使用者名稱錶單值
$passowrd = $_POST['password'];//post獲得使用者密碼單值
if ($account && $passowrd){//如果使用者名稱和密碼都不為空
$sql = "select * from user where username = '$account' and password='$passowrd'";//檢測資料庫是否有對應的username和password的sql
$result = mysql_query($sql);//執行sql
$rows=mysql_num_rows($result);//返回一個數值
if($rows){//0 false 1 true
header("refresh:0;url=welcome.html");//如果成功跳轉至welcome.html頁面
//要把is_online 改為1
exit;
}else{
echo "使用者名稱或密碼錯誤";
echo "
<script>
setTimeout(function(){window.location.href='login.html';},1000);
</script>
";//如果錯誤使用js 1秒後跳轉到登入頁面重試;
}
}else{//如果使用者名稱或密碼有空
echo "表單填寫不完整";
echo "
<script>
setTimeout(function(){window.location.href='login.html';},1000);
</script>";
//如果錯誤使用js 1秒後跳轉到登入頁面重試;
}
//mysql_close();//關閉資料庫
?>