<?php
    require_once "mainlib.php";
    global $app;
    require_once "authlib.php";
    if(isset($app::$user)) header("Location: ".$app::$mainPage);
    else{
        if(isset($_POST['login'],$_POST['password'])){
            if(!$app::$connection->connect_errno){
                if(isRightLP($_POST['login']) && isRightLP($_POST['password'])){
                    $result=$app::$connection->query("Select * from userstemp where login='".$_POST['login']."' and password='".$_POST['password']."';");
                    if($result->num_rows==1){
                        $tempforid=($result->fetch_array());
                        $uid=$tempforid['id'];
                        $result->close();
                        $ltime=new DateTime();
                        $ltime->setTimestamp(time());
                        $randint=0;
                        do{
                            $randint=mt_rand(0, 99999999999999999);
                            Application::$connection->query("select id from userstemp where ssesionid=".$randint.";");
                        }while($connection->num_rows>0);
                        $querystr="Update userstemp set ssesionid=".$randint.", useragent='".$_SERVER['HTTP_USER_AGENT']."', lasttime='".$ltime->format('Y-m-d H:i:s')."', remoteaddr='".$_SERVER['REMOTE_ADDR']."' where id=".$uid.";";
                        Application::$connection->query($querystr);
                        header("Location: ".$app::$mainPage);
                        setcookie("session_id",$randint,time()+604800);
                        setcookie("freonol",$uid-11,time()+604800);
                        exit();
                    }else $result->close();
                }
            }
        }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Авторизация</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <link rel="stylesheet" href="css/base.css">
        <style type="text/css">
            .center{
                margin-left: auto;
                margin-right: auto;
            }
            .lpath li:after {
                content: "";
            }
            .authority-form .pure-control-group label{
                width:20em;
            }
            .authority-form .pure-button{
                margin-top:20px;
                margin-left:400px;
            }
        </style>
    </head>
    <body style="background-color: #ffffff">
        <div class="container">
            <div class="nav-bar">
                <div class="nav-bar-inner gradient-grey">
                    <ul class="nav-path lpath">
                        <li>САМБО-70</li>
                    </ul>
                    <ul class="right-menu">
                        <li>Регистрация</li>
                    </ul>
                </div>
            </div>
            <div class="page-header">
                <h2 class="head-text">Авторизация</h2>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="pure-form pure-form-aligned authority-form">
                <fieldset>
                    <div class="pure-control-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" placeholder="Email" name="login">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Пароль</label>
                        <input id="password" type="password" placeholder="Пароль" name="password">
                    </div>
                    <button type="submit" class="pure-button pure-button-primary">Войти</button>
                </fieldset>
            </form>
        </div>
    </body>
</html>
<?php
    }
?>