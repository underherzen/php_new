
<?php
    require 'connectdb.php';
    if(isset($_POST['sub'])) {
        if(!empty($_POST['login_auth']) &&
            !empty($_POST['password_auth'])) {
            $login = $_POST['login_auth'];
            $password = $_POST['password_auth'];
            $mysqli_auth = connectdb::getInstance()->connect();
            $result = $mysqli_auth->query("SELECT 
									 login,
									 password
									 FROM users_auth"
            );
            $rows = $result->fetch(PDO::FETCH_ASSOC);
            do {
                if(($login == $rows['login']) && ($password == $rows['password']) && ($_SESSION['secpic']==strtolower($_POST['sec']))) {
                    $_SESSION["auth"] = "ok";
                    $_SESSION["user"] = $login;
                    header('Location: ../index.php');
                    exit;
                }

            } while($rows = $result->fetch(PDO::FETCH_ASSOC));
        }
    }
    ?>