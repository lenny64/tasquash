<?php
include_once('../init.php');
include_once('../../classes/User.php');

header('Content-type:application/json');

$User = new User();
$User->id = $_GET['user_id'];
$squashs = $User->getPossibleSquashs();
echo json_encode($squashs);

?>
