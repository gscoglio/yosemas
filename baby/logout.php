<?php
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['admin'] = NULL;
unset($_SESSION['admin']);
header("Location: login.php");
exit;
?>