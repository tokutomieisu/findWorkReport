<?php
session_start();
$_SESSION['DAY'] = htmlspecialchars($_GET['day']);
$_SESSION['PLACE'] = htmlspecialchars($_GET['place']);
$active = htmlspecialchars($_GET['active']);
$_SESSION['ACTIVE'] = $active;
$_SESSION['INDUSTRY'] = htmlspecialchars($_GET['industry']);
$_SESSION['OCCUPATION'] = htmlspecialchars($_GET['occupation']);

    if($active == "説明会"){
        header("Location:infoSession.php");
    }else if($active == "試験"){
        header("Location:test.php");
    }else if($active == "面接"){
        header("Location:interview.php");

    }else if($active == "その他"){
        header("Location:others.php");
    }
?>