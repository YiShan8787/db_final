<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>註冊</title>
</head>
<body>
    <div class = "container">
            <form name="login" action="register.php" method="post">
                <div class = "row justify-content-center border border-gray rounded mx-auto p-5" style = "margin-top:100px;">
                <div class="row align-items-center justify-content-center">
                    <div class = "col-md-auto">
                        <h1>註冊</h1>
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                            <input type=text class = "form-control" id="account_id" name="account" placeholder = "使用者名稱">
                           
                        </div>
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                            <input type=password class = "form-control" name="password" placeholder = "密碼">
                        </div>
                    </div>
                     <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                            <input type=password class = "form-control" name="repassword" placeholder = "請再次輸入密碼">
                        </div>
                    </div>
                     <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                            <input type=text class = "form-control" name="name" placeholder = "姓名">
                        </div>
                    </div>
                     <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                             <input type=text class = "form-control" name="school" placeholder = "學校">
                        </div>
                    </div>
                    <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                             <input type=text class = "form-control" name="field" placeholder = "領域">
                        </div>
                    </div>
                    <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                             <label>
                                <input type = checkbox name = "checkbox">我已詳閱<a href="">條款細則</a>
                            </label>
                        </div>
                    </div>
                    <div class = "col-md-10">
                        <div class = "m-3 input-group">
                            
                             <input class = "btn btn-primary" type="submit" name="submit" value="註冊">
                        </div>
                    </div>


                    
                   <!-- <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=password name="password" placeholder = "密碼">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=password name="repassword" placeholder = "請再次輸入密碼">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=text name="name" placeholder = "姓名">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=text name="school" placeholder = "學校">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input type=text name="field" placeholder = "領域">
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                    <label>
                        <input type = checkbox name = "checkbox">我已詳閱<a href="">條款細則</a>
                    </label>
                    </div>
                    <div class = "w-100"></div>
                    <div class = "col-md-auto">
                        <input class = "btn btn-primary" type="submit" name="submit" value="註冊">
                    </div>
                -->
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
                $query = ("insert into student (ID,name,school,field, password, is_online,status) values ('$account','$name','$school','$field', '$password', 1,0)");
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