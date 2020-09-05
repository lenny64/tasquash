<?php
include_once('../init.php');
include_once('../../classes/User.php');

header('Content-type:application/json');

$User = new User();
$users_list = $User->getAll();
echo json_encode($users_list);

?>
