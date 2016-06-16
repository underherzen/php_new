<?php
require 'connectdb.php';
$mysqli = connectdb::todb();
$mysss = $mysqli;

function returnGlob()
{
    $mysqli_delete =  $GLOBALS['mysss'];
    return $mysqli_delete;
}
if(!empty($_GET['login']))
{
    $login = $_GET['login'];
    deleteUsers($login);
}
function deleteUsers($login){
    if (empty($login)) {
        return false;
    }
    else {
        $mysqli_delete = returnGlob();
        $mysqli_delete->query("DELETE FROM users WHERE login='$login'");
    }
}
