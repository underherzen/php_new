<?php
if(isset($_POST['exit'])) {
    session_start();
    unset ($_SESSION['auth']);
    unset ($_SESSION['user']);
    session_destroy();
    /**echo '
    <script language="JavaScript">
    window.location.href = "../programming.html"
    </script>';**/
}
?>