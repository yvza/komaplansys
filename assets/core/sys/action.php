<?php
require_once('./connection.php');

if(@$_POST['key'] == 31337){
    $timeRightnow = date('Y/m/d H:i:s');
    switch ($_POST['action']) {
        case 0:
            $queryRegister = "INSERT INTO members (id, nama, password, email, created_at) 
            VALUES (AI_CATEGORIES.nextval, ?, ?, ?, TO_DATE('$timeRightnow', 'yyyy/mm/dd hh24:mi:ss'))";
            $ekseQueryRegister = $pdo->prepare($queryRegister);
            $isValid = $ekseQueryRegister->execute([
                $_POST['newNamaLengkap'],
                $_POST['newPassword'],
                $_POST['newEmail']
            ]);
            break;

        case 1:
            # code...
            break;
    }
}
?>