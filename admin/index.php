<?php
session_start(); 
include("db.php");
			
$op = NULL;

if (isset($_GET['option'])) $op = $_GET['option'];
if (!isset($_SESSION['username']) || ($_SESSION['username'] != 'admin')) $op = "login";

switch ($op) {
    case "login":
        include("login.php");
        break;
    case "logout":
        include("logout.php");
        break;
    case "home":
        include("home.php");
        break;
    case "rank":
        include("rank.php");
        break;
    case "user_detail":
        include("user_detail.php");
        break;
    case "stock-add":
        include("stock-add.php");
        break;
    case "stock-remove":
        include("stock-remove.php");
        break;
    case "offline":
        include("offline.php");
        break;
    case "view-transaction":
        include("view-transaction.php");
        break;
    case "exchange":
        include("exchange.php");
        break;
    case "exchange-details":
        include("exchange-details.php");
        break;
    case "remove-stock":
        include("remove-stock.php");
        break;
    case "notices":
        include("notices.php");
        break;
    case "rules":
        include("rules.php");
        break;
    case "contacts":
        include("contacts.php");
        break;
    case "offline":
        include("offline.php");
        break;
    default:
        include("login.php");
        break;
}

?>
