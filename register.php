<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>註冊</title>
</head>
<body>
    <div class = "container">
            <form name="login" action="register.php" method="post">
                <div class="row align-items-center justify-content-center">
                    <div class = "col-md-auto">
                        <input type=text name="account" placeholder = "使用者名稱">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=password name="password" placeholder = "密碼">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=password name="repassword" placeholder = "請再次輸入密碼">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                    <label>
                        <input type = checkbox value>我已詳閱<a href="">條款細則</a>
                    </label>
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input class = "btn btn-primary" type="submit" name="submit" value="註冊">
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
<?php

    include_once "db_conn.php";

    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST["submit"])){
        exit("請按下註冊");
    }//檢測是否有submit操作 

    $account = $_POST['account'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    //判斷帳號密碼是否為空
    //確認密碼輸入的正確性
    if($account != null && $password != null && $repassword != null && $password == $repassword)
    {
        //新增資料進資料庫
        $query = ("insert into admin (account, password, is_online) values ('$account', '$password', 1)");
        $stmt = $db->prepare($query);
        $result = $stmt -> execute();
        if($result)
        {
            echo '註冊成功';
            $_SESSION['account'] = $account;
            echo '<meta http-equiv=REFRESH CONTENT=5;url=index.php>';
        }
        else
        {
            echo '註冊失敗';
            echo "
            <script>setTimeout(function(){window.location.href='register.php';},1000);</script>
            ";//如果錯誤使用js 1秒後跳轉到註冊頁面重試;
            exit();
        }
    }
?>