<?php
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['usuario'] = NULL;
unset($_SESSION['usuario']);
$_SESSION['id'] = NULL;
unset($_SESSION['id']);
header('Location: index.php');
exit;
?>