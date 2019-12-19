<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>使用者註冊頁面</title>
</head>
<body>
<form action="signup.php" method="post">
<p>使用者名稱:<input type="text" name="account"></p>
<p>密 碼: <input type="text" name="password"></p>
<p><input type="submit" name="submit" value="註冊"></p>
</form>
</body>
</html>


<?php 

include_once "db_conn.php";

header("Content-Type: text/html; charset=utf8");
if(!isset($_POST['submit'])){
exit("錯誤執行");
}//判斷是否有submit操作
$name=$_POST['account'];//post獲取表單裡的name
$password=$_POST['password'];//post獲取表單裡的password
//以下要改
$q="insert into user(account,password,is_online) values ('$account','$password',0)";//向資料庫插入表單傳來的值的sql
$reslut=mysql_query($q,$con);//執行sql
if (!$reslut){
die('Error: ' . mysql_error());//如果sql執行失敗輸出錯誤
}else{
echo "註冊成功";//成功輸出註冊成功
}
mysql_close($con);//關閉資料庫
?>