<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>註冊成功</title>
</head>

<style>
    @media screen and (min-width:850px){
        [class = "row justify-content-center border border-gray rounded mx-auto p-5"]{
            width:65%;
            margin-top:100px;
        }
    }
    @media screen and (max-width:550px){
       [class = "row justify-content-center border border-gray rounded mx-auto p-5"]{
        margin-top:30px;
       }   
    }
</style>

<body>
    <div class = "container">
        <form name="login" action="register.php" method="post">
            <div class = "row justify-content-center border border-gray rounded mx-auto p-5" style = "margin-top:100px;">
                <div class = "my-3 col-mx-auto">
                    <h1>註冊成功</h1>
                </div>
                <div class = "w-100"></div>
                <div class = "my-3 col-mx-auto">             
                   <a class = "btn btn-md btn-outline-primary" href = "index.php" role = "button">回首頁</a>
                </div>
                <div class = "w-100"></div>
                <div class = "w-100"></div>
                <div class = "my-3 col-mx-auto">  
                    <a class = "btn btn-md btn-outline-primary" href = "login.php" role = "button">登入頁面</a>
                </div>
            </div> 
        </form>        
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>


<?php

    include_once "db_conn.php";

    //header("Content-Type: text/html; charset=utf8");
    
    if(!isset($_POST["submit"])){
        exit("");
    }//檢測是否有submit操作 
    
    $account = $_POST['account'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $name = $_POST['name'];
    $school = $_POST['school'];
    $field = $_POST['field'];
    $checkbox = $_POST['checkbox'];
    //判斷帳號密碼是否為空
    //確認密碼輸入的正確性
    if($checkbox)
    {
        if($account != null && $password != null && $repassword != null&& $name != null&& $school != null && $field != null&& $password == $repassword)
        {
            //新增資料進資料庫
            $query = ("insert into student (ID,name,school,field, password, is_online,status) values ('$account','$name','$school','$field', '$password', 1,0)");
            $stmt = $db->prepare($query);
            $result = $stmt -> execute();
            if($result)
            {
                echo '註冊成功';
                //$_SESSION['account'] = $account;
                 $_SESSION['status'] = 0;
                echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
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
    }
    else
    {
        echo "<script>alert('還敢不看條款細則阿冰鳥')
              setTimeout(function(){window.location.href='register.php';},100);
             </script>;";
    }
?>