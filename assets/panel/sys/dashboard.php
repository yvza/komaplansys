<?php
session_start();
require_once('../../core/sys/connection.php');
if(!isset($_SESSION['members_id'])){
    header('Location: ../../whatreudoing.php');
}

if(@$_GET['get'] === "userinfo"){
    $queryGetUserInfo = "SELECT * FROM members WHERE id = {$_SESSION['members_id']}";
    $ekse = $pdo->query($queryGetUserInfo)->fetch();
    echo json_encode($ekse);
}
?>