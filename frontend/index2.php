<?php
session_start();
if($_SESSION['test'] != "1")
{
file_put_contents('log.txt', date('Y-m-d H:i:s') . ': Invalid login from: ' . gethostname() ."\n", FILE_APPEND);
header('Location: index.php');
}
else
{
file_put_contents('log.txt', date('Y-m-d H:i:s') . ': Login success from: ' . gethostname() ."\n", FILE_APPEND);
echo $_SESSION['test'];
}
//unset($_SESSION["username"]);
?>
