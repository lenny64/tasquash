<?php
include_once('../init.php');
include_once('../../classes/User.php');
include_once('../../classes/Task.php');

header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $post = json_decode(file_get_contents("php://input"), true);
    if (!$post['quasher'] || $post['quasher'] == NULL) { echo json_encode("Pas de quasher id"); return false; }
    if (!$post['task_id'] || $post['task_id'] == NULL) { echo json_encode("Pas de task"); return false; }
    $Task = new Task();
    $Task->quasher = $post['quasher'];
    $Task->id = $post['task_id'];
    $Task->makeSquashApplication();

    echo json_encode($Task);
}

?>
