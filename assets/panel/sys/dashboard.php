<?php
session_start();
require_once('../../core/sys/connection.php');
if(!isset($_SESSION['members_id'])){
    header('Location: ../../whatreudoing.php');
}

if(@$_GET['get'] === "allinfo"){
    // 0: info user || 1. schedule
    $arrHelper = [];
    $queryGetUserInfo = "SELECT * FROM members WHERE id = {$_SESSION['members_id']}";
    $ekse = $pdo->query($queryGetUserInfo)->fetch();
    array_push($arrHelper, $ekse);

    $query = "SELECT title, start_date, end_date FROM plansys WHERE user_id = {$_SESSION['members_id']}";
    $ekse = $pdo->query($query)->fetchAll();
    array_push($arrHelper, []);
    foreach ($ekse as $key => $value) {
        $costumArray = [
            'title' => $value['TITLE'],
            'start' => $value['START_DATE'],
            'end' => $value['END_DATE']
        ];
        array_push($arrHelper[1], $costumArray);
    }
    echo json_encode($arrHelper);
}

if(@$_GET['moving'] === "schedule"){
    $query = "UPDATE plansys SET start_date = ?, end_date = ? WHERE title = ?";
    $ekse = $pdo->prepare($query);
    $res = $ekse->execute([
        $_POST['startDate'],
        $_POST['endDate'],
        $_POST['title']
    ]);
    if($res){ echo "ok"; }
}