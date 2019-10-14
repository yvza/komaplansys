<?php
session_start();
require_once('../../core/sys/connection.php');
if(!isset($_SESSION['members_id'])){
    header('Location: ../../whatreudoing.php');
}
?>