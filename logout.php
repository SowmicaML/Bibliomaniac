<?php 
session_start();
if (isset($_SESSION['roll_no']))
{
    unset($_SESSION['roll_no']);
}
if (isset($_SESSION['username']))
{
    unset($_SESSION['username']);
}
header('location:index.php');
?>