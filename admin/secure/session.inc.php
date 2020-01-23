<?
session_start();
if(!isset($_SESSION['admin']))
{
    header('Location: loginform.php?ref='. $_SERVER['REQUEST_URI']);
    exit;
}