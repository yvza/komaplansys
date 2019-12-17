<?php
session_start();
require_once('../../core/sys/connection.php');
if(!isset($_SESSION['members_id'])){
    header('Location: ../../whatreudoing.php');
}

$arrHelper = [];

$query = "SELECT count(id) AS total FROM plansys WHERE review = 3 AND user_id = {$_SESSION['members_id']}";
array_push($arrHelper, $pdo->query($query)->fetch());

$query = "SELECT count(id) AS total FROM plansys WHERE review = 2 AND user_id = {$_SESSION['members_id']}";
array_push($arrHelper, $pdo->query($query)->fetch());

$query = "SELECT count(id) AS total FROM plansys WHERE review = 1 AND user_id = {$_SESSION['members_id']}";
array_push($arrHelper, $pdo->query($query)->fetch());

echo json_encode($arrHelper);
?>