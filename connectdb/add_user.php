
<?php
require 'connectdb.php';
$mysqli = connectdb::getInstance()->connect();
	if(
        !empty($_POST['user_name']) &&
        !empty($_POST['user_login']) &&
        !empty($_POST['user_password']) &&
        !empty($_POST['user_password_repeat'])
    ) {
        if($_POST['user_password'] == $_POST['user_password_repeat']) {
            $name = trim(stripcslashes(htmlspecialchars($_POST['user_name'])));
            $login = trim(stripcslashes(htmlspecialchars($_POST['user_login'])));
            $password = trim(stripcslashes(htmlspecialchars($_POST['user_password'])));
            $result_answer = addUsers($name, $login, $password);
        }
        else {
            echo "Wrong password";
        }


    }

function addUsers($name = "", $login="", $pass="") {
    $mysqli = $GLOBALS['mysqli'];
    $date = date("Y-m-d");
    $description = "V BETKE";
    $result = $mysqli->query("INSERT INTO users
							 (login, password, full_name, date_of_registration, about_myself)							 
							VALUES
							('$login', '$pass', '$name', '$date', '$description')
							");
}
echo "SOMETHING";
?>