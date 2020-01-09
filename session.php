<?php
session_start();

if(!isset($_SESSION['adminnummer']) || strlen($_SESSION['adminnummer'])==0)
{
    header("location:index.php");
    exit;
}
?>
