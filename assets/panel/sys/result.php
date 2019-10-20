<?php
session_start();
require_once('../../core/sys/connection.php');
if(!isset($_SESSION['members_id'])){
    header('Location: ../../whatreudoing.php');
}

$arrHelper = [];

$query = "SELECT count(id) as total FROM plansys WHERE review < 3 AND user_id = {$_SESSION['members_id']} AND status = 2";
array_push($arrHelper, $pdo->query($query)->fetch());

$query = "SELECT count(id) as total FROM plansys WHERE review >= 3 AND review < 5 AND user_id = {$_SESSION['members_id']} AND status = 2";
array_push($arrHelper, $pdo->query($query)->fetch());

$query = "SELECT count(id) as total FROM plansys WHERE review >= 5 AND user_id = {$_SESSION['members_id']} AND status = 2";
array_push($arrHelper, $pdo->query($query)->fetch());

echo json_encode($arrHelper);
?>