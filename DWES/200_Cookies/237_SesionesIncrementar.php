<?php
session_start();
if(!isset($_SESSION['a'])){
    $_SESSION['a'] = 0;
}
$_SESSION['a'] += 1;
echo $_SESSION['a'];
?>