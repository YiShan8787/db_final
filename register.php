<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>註冊</title>
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
        <div class = "row justify-content-start">
            <div class = "p-2 col-md-auto col-sm-auto">
                <a class = "btn btn-md btn-outline-primary" href = "index.php" role = "button">回首頁</a>
            </div>            
        </div>
    </div>
    <div class = "container">
        <form name="login" action="register.php" method="post">
            <div class = "row justify-content-center border border-gray rounded mx-auto p-5">
                <div class = "my-3 col-mx-auto">
                    <h1>註冊</h1>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto" >
                    <div class = "my-3 input-group">   
                        <div class = "input-group-prepend">
                            <span class = "px-3 input-group-text font-weight-light" id = "username">使用者名稱:</span>
                        </div>
                        <input type=text class = "form-control" id="account_id" name="account" aria-label = "username" aria-describedby = "username" placeholder = "使用者名稱">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto">
                    <div class = "my-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "input-group-text font-weight-light" style = "padding-left:40px;padding-right:40px;" id = "password">密碼:</span>
                        </div>
                        <input type=password class = "form-control" name="password" aria-label = "password" aria-describedby = "password" placeholder = "密碼">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto">
                    <div class = "my-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "px-0 input-group-text font-weight-light" id = "repassword">請再次輸入密碼:</span>
                        </div>
                        <input type=password class = "form-control" name="repassword" aria-label = "repassword" aria-describedby = "repassword" placeholder = "請再次輸入密碼">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto">
                    <div class = "my-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "input-group-text font-weight-light" style = "padding-left:40px;padding-right:40px;" id = "name">姓名:</span>
                        </div>
                        <input type=text class = "form-control" name="name" aria-label = "name" aria-describedby = "name" placeholder = "姓名">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto">
                    <div class = "my-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "input-group-text font-weight-light" style = "padding-left:40px;padding-right:40px;" id = "school">學校:</span>
                        </div>
                        <input type=text class = "form-control" name="school" aria-label = "school" aria-describedby = "school" placeholder = "學校">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-md-auto">
                    <div class = "my-3 input-group">
                        <div class = "input-group-prepend">
                            <span class = "input-group-text font-weight-light" style = "padding-left:40px;padding-right:40px;" id = "field">領域:</span>
                        </div>
                        <input type=text class = "form-control" name="field" aria-label = "field" aria-describedby = "field" placeholder = "領域">
                    </div>
                </div>
                <div class = "w-100"></div>
                <div class = "col-mx-auto">                            
                    <label class = "my-3">
                        <input type = checkbox name = "checkbox">我已詳閱<a href="">條款細則</a>
                    </label>
                </div>
                <div class = "w-100"></div>
                <div class = "my-3 col-mx-auto">                            
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
             $query = ("SELECT ID FROM student WHERE ID=?");
              $stmt = $db->prepare($query);
              $error = $stmt->execute(array($account));
              $result = $stmt->fetchALl();
              if(count($result) > 0){
                echo "<script>document.getElementById('account_id').placeholder = '帳號已存在';</script>";
                echo "<script>document.getElementById('account_id').placeholder = '帳號已存在';</script>";
                echo "<script>document.getElementById('account_id').className += ' border border-danger';</script>";
                $isWrong = 1;
                $isAccountWrong = 1;
              }
                else{
                //新增資料進資料庫
                $query = ("insert into student (ID,name,school,field, password, is_online,status) values ('$account','$name','$school','$field', '$password', 0,0)");
                $stmt = $db->prepare($query);
                $result = $stmt -> execute();
                if($result)
                {
                    echo '註冊成功';
                    //$_SESSION['account'] = $account;
                     $_SESSION['status'] = 0;
                    echo '<meta http-equiv=REFRESH CONTENT=0;url=register_success.php>';
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
    }
    else
    {
        echo "<script>alert('還敢不看條款細則阿冰鳥')
              setTimeout(function(){window.location.href='register.php';},100);
             </script>;";
    }
?>