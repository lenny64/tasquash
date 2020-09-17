<?php
include_once('../init.php');
include_once('../../classes/User.php');
include_once('../../classes/Task.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['task_id'] || $post['task_id'] == NULL) { echo json_encode("Pas de task id"); return false; }
    if (!$post['user_id'] || $post['user_id'] == NULL) { echo json_encode("Pas de user id"); return false; }
    $Task = new Task();
    $Task->id = $post['task_id'];
    $Task->getFromId();
    // $Quasher = new User();
    // $Quasher->id = $post['user_id'];
    // $Quasher->getFromId();
    $Task->quasher = $post['user_id'];
    $Task->acceptOffer();

    echo json_encode($Task);
}

?>
