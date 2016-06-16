
<?php
require 'connectdb.php';
	if(
        !empty($_POST['update_user_name']) &&
        !empty($_POST['update_user_login']) &&
        !empty($_POST['update_user_password'])
    ) {
        $mysqli_update_user = connectdb::todb();
        $name = $_POST['update_user_name'];
        $login = $_POST['update_user_login'];
        $password = $_POST['update_user_password'];
        $mysqli_update_user->query("
		UPDATE users SET
			full_name = '$name',
			password =  '$password',
			login = '$login'
		WHERE id = '$_POST[id]'
		");
    }
 echo $_POST['update_user_name'] . "</br>";
 echo $_POST['update_login_remember'] . "</br>";
 echo $_POST['update_user_password'] . "</br>";
?>