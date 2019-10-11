<?php
require_once('./connection.php');

if(@$_POST['key'] == 31337){
    $timeRightnow = date('Y/m/d H:i:s');
    switch ($_POST['action']) {
        case 0:
            $hashPassword = password_hash($_POST['newPassword'], PASSWORD_ARGON2I);

            $cekEmail = "SELECT COUNT(id) as total FROM members WHERE email = ?";
            $ekseCekEmail = $pdo->prepare($cekEmail);
            $ekseCekEmail->execute([$_POST['newEmail']]);
            $hasil = $ekseCekEmail->fetchColumn();

            if($hasil == 0){
                $queryRegister = "INSERT INTO members (id, nama, password, email, created_at) 
                VALUES (AI_MEMBERS.nextval, ?, ?, ?, TO_DATE('$timeRightnow', 'yyyy/mm/dd hh24:mi:ss'))";
                $ekseQueryRegister = $pdo->prepare($queryRegister);
                $isValid = $ekseQueryRegister->execute([
                    $_POST['newNamaLengkap'],
                    $hashPassword,
                    $_POST['newEmail']
                ]);
                if($isValid){ echo "ok"; }
            }else{
                echo "emailexist";
            }
            break;

        case 1:
            $cekUserPassword = "SELECT * FROM members WHERE email = ?";
            $ekseCekUserPassword = $pdo->prepare($cekUserPassword);
            $ekseCekUserPassword->execute([
                $_POST['logEmail']
            ]);
            $result = $ekseCekUserPassword->fetchAll();
            $countRes = count($result);

            if($countRes == 1){
                $originPassword = $result[0]['PASSWORD'];
                if(password_verify($_POST['logPassword'], $originPassword)){
                    echo "valid";
                }else{
                    echo "wrong";
                }
            }else{
                echo "notregistered";
            }
            break;
    }
}
?>