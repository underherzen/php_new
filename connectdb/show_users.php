<?php
error_reporting(0);
session_start();
$user = $_SESSION["user"];
$stat = $_SESSION["auth"];
?>
<?php
/**
 * Created by PhpStorm.
 * User: underherzen
 * Date: 12.06.2016
 * Time: 15:36
 */
require 'connectdb.php';
$mysqli = connectdb::todb();
$result = $mysqli->query("SELECT id,
									 login,
									 password,
									 full_name,
									 date_of_registration
									 FROM users"
);
$rows = $result->fetch_assoc();

if(!empty($rows))
    do {
        echo "<table>";
        if($stat == "ok") {
            echo "<tr><td><button class='btn btn-primary btn-xs' id='delete' name = 'delete' value='".$rows['login']."'>Delete</button> <button id = 'update' class='btn btn-primary btn-xs' name = 'update' value = '".$rows['id']."'>Update</button></tr></td>";
        }
        //echo "Delete user<a href = '?delete=".$rows['login']."'>[x]</a> | <a href = '?update=".$rows['login']." '>Update</a> user";
        echo "<tr><td>Полное имя:</td> <td><input style='width:200px' type = 'text' name = 'full_name' id='".$rows['id']."' value='".$rows['full_name'] . "'/></td></tr>";
        //echo "<p>Полное имя: <b>" . $rows['full_name'] . "</b></p>"	;
        echo "<tr><td>Login:</td> <td><input style='width:200px' type = 'text' name = 'login_user' id='".$rows['id']."' value='".$rows['login'] . "'/></td></tr>";
        //echo "<p>Login: <b>" . $rows['login'] . "</b></p>"	;
        echo "<tr><td>Password:</td> <td><input style='width:200px' type = 'text' name = 'password_user' id='".$rows['id']."' value='".$rows['password'] . "'/></td></tr>";
        echo "<tr><td>Дата регистрации: </td> <td><b>" . $rows['date_of_registration'] . "</b></td></tr></table><br>"	;
        //echo "</hr>";
//	$rows = $result->fetch_assoc();
    }	while($rows = $result->fetch_assoc());