<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
include_once "db_conn.php";

$account = $_SESSION['account'];
unset($_SESSION['account']);
$query = ("update admin set is_online = 0 WHERE account = $account");
$stmt = $db -> prepare($query);
$stmt->execute();
echo $account;
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>