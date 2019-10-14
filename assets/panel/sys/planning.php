<?php
session_start();
require_once('../../core/sys/connection.php');
if(!isset($_SESSION['members_id'])){
    header('Location: ../../whatreudoing.php');
}

if(@$_GET['create'] === "event"){
    $queryInsert = "INSERT INTO plansys (id, user_id, title, start_date, end_date, category, review, status) 
    VALUES (AI_PLANSYS.nextval, ?, ?, ?, ?, ?, ?, ?)";
    $ekseQueryInsert = $pdo->prepare($queryInsert);
    $res = $ekseQueryInsert->execute([
        $_SESSION['members_id'],
        $_POST['desc'],
        $_POST['startDate'],
        $_POST['endDate'],
        1, //uncategorized
        6, //unrated
        1 //dalam pengerjaan
    ]);
    if($res){
        echo "ok";
    }
}

if(@$_GET['get'] === "schedule"){
    $arrHelper = [];
    $query = "SELECT ps.ID AS kunci, ps.title, ps.start_date, ps.end_date, c.id AS catid, sr.description, su.id AS suid
    FROM plansys ps
    LEFT JOIN categories c ON ps.CATEGORY = c.ID
    LEFT JOIN stars sr ON ps.REVIEW = sr.ID
    LEFT JOIN status su ON ps.STATUS = su.ID
    WHERE user_id = {$_SESSION['members_id']} 
    ORDER BY ps.ID ASC";
    $data = $pdo->query($query)->fetchAll();
    array_push($arrHelper, $data);

    $query = "SELECT * FROM categories";
    array_push($arrHelper, $pdo->query($query)->fetchAll());

    $query = "SELECT * FROM status";
    array_push($arrHelper, $pdo->query($query)->fetchAll());

    echo json_encode($arrHelper);
}

if(@$_GET['action'] === "delete"){
    $query = "DELETE FROM plansys WHERE id = ?";
    $ekse = $pdo->prepare($query);
    $res = $ekse->execute([
        $_POST['id']
    ]);
    if($res){ echo "ok"; }
}

if(@$_GET['change'] === "stars"){
    $query = "UPDATE plansys SET review = ? WHERE id = ?";
    $ekse = $pdo->prepare($query);
    $res = $ekse->execute([
        $_POST['value'],
        $_POST['id']
    ]);
    if($res){ echo "ok"; }
}

if(@$_GET['change'] === "category"){
    $query = "UPDATE plansys SET category = ? WHERE id = ?";
    $ekse = $pdo->prepare($query);
    $res = $ekse->execute([
        $_POST['category'],
        $_POST['id']
    ]);
    if($res){ echo "ok"; }
}

if(@$_GET['change'] === "status"){
    $query = "UPDATE plansys SET status = ? WHERE id = ?";
    $ekse = $pdo->prepare($query);
    $res = $ekse->execute([
        $_POST['status'],
        $_POST['id']
    ]);
    if($res){ echo "ok"; }
}
?>