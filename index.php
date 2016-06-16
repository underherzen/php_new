<!DOCTYPE html>
<html>
<head>
    <title>База данных!</title><meta charset="utf-8">
    <meta name="author" content="Arthur Ulyashev">
    <meta charset="utf-8"><link rel="stylesheet" href="css/bootstrap.min.css">
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({cache: false});
            $("#load_php").load("connectdb/show_users.php", 'r='+Math.random());
        })
    </script>
    <style>
        #posting{
            width:25%;
        }
        body {
            
        }

    </style>
</head>
<body>
<?php
error_reporting(0);
session_start();
$user = $_SESSION["user"];
$stat = $_SESSION["auth"];

if(($stat == "ok") && !is_null($user))
{
    $name = $user;
    echo "Вы вошли как <strong> " .$user . " <button id ='exit' name='exit' class='btn btn-primary btn-xs' value = 'Выйти'>Выйти</button><br>    </strong> ";

}
else
    echo '<form method="post">
    <input type="text" name="login_auth" id="login_auth" placeholder="Login" />
    <input type="password" name="password_auth" id="password_auth" placeholder="Пароль" />
    <input type="submit" name="sub" id="sub" value="Войти" class="btn btn-primary btn-xs"/>
    <br>
    <img src="connectdb/secpic.php" alt="защитный код">
    <br>
    <input type="text" name="sec" id="sec" placeholder="Введите текст с картинки" />
    </form><div id="info">
    <br>Только авторизованные могут удалять и изменять базу данных(далее бд)!<br>
    Но у вас есть право добавлять в бд данные<br></div>
    <h4>Логин: arthur12 Пароль: 1gf1hj1km</h4>
    <script>
        $("#info").delay(3000).fadeOut(300);
    </script>';


?>
<?php
require_once 'connectdb/auth2.php';

?>
<div id="load_php"></div>
<h1>Add user:</h1>
<p><form method='post' id="posting">
    <input type="text" name="user_name" placeholder="Полное имя" class="form-control"/><br>
    <input type="text" name="user_login" placeholder="Login" class="form-control"/><br>
    <input type="text" name="user_password" placeholder="Пароль" class="form-control"/><br>
    <input type="text" name="user_password_repeat" placeholder="Повторите пароль" class="form-control"/><br>
    <input type="submit" id="add_user" name="add_user" value="Добавить" class="btn btn-primary btn-xs"/>
</form>
</p>
<script>

    $(document).ready(function () {
        $('#exit').click(function() {
            console.log(1);
            var exit = "exit";

            $.ajax({
                method: "POST",
                url: "connectdb/destroy_session.php",
                data: {exit: exit}
            })
            //$.ajaxSetup({cache:false});
            window.location.replace("../index.php");
        })
        $(document).delegate('#delete', 'click', function(){
            var login = $(this).val();
            console.log(login);
            $.get("connectdb/delete_users.php",
                {
                    login: login
                },
                onAjaxSuccess
            );
            function onAjaxSuccess(data) {
                console.log(data);
            }
            $.ajaxSetup({cache: false});
            $("#load_php").load("connectdb/show_users.php", 'r='+Math.random());
        });
        $("#posting").submit(function(event) {event.preventDefault();});
        $("#add_user").click(function() {
            var name = $("input[name='user_name']").val();
            var login = $("input[name='user_login']").val();
            var password = $("input[name='user_password']").val();
            var password_repeat = $("input[name='user_password_repeat']").val();
            // console.log(1);
            $.ajax({
                method: "POST",
                url: "connectdb/add_user.php",
                data:  {user_name: name,
                    user_login: login,
                    user_password: password,
                    user_password_repeat: password_repeat}
            })
                .done(function(msg) {
                    console.log( "Data Saved: " + msg );
                })
            $.ajaxSetup({cache: false});
            $("#load_php").load("connectdb/show_users.php", 'r='+Math.random());
        });
        $(document).delegate('#update', 'click', function() {
            console.log($(this).val());
            var id = $(this).val();
            console.log(id);
            var name = $('input[id=' + id + '][name="full_name" ]').val();
            var login = $('input[id=' + id + '][name="login_user" ]').val();
            var password = $('input[id=' + id + '][name="password_user" ]').val();
            console.log(name);
            console.log(login);
            console.log(password);
            // var name = this.full_name.val();
            // var login = this.login.val();
            //  var password = this.user_password_showing.val();
            $.ajax({
                method: "POST",
                url: "connectdb/update_user.php",
                data: {
                    update_user_name: name,
                    update_user_login: login,
                    update_user_password: password,
                    id: id
                }
            })
                .done(function (msg) {
                    console.log("Data Saved: " + msg);
                });
        });
    });
</script>



</body>
</html>
